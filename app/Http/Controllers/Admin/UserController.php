<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KabupatenOrKotaSumut;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        $users = collect($users);
        $users->map(function($x) {
            if($x->role_user_id == 1) {
                $x->role_badge = '<span class="badge badge-primary">'.$x->role->name.'</span>';
            } else {
                $x->role_badge = '<span class="badge badge-success">'.$x->role->name.'</span>';
            }
        });
        
        return view('admin.pages.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = RoleUser::all();
        $kabKotas = KabupatenOrKotaSumut::all();
        return view('admin.pages.users.create', compact('roles', 'kabKotas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'role' => 'required'
        ]);
    
        // Jika validasi berhasil, simpan data ke database
        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_user_id = $request->role;
        $user->kabkota_id = $request->kabkota_id != "" ? $request->kabkota_id : null;
        $user->save();
    
        // Redirect ke halaman lain dengan pesan sukses
        Alert::success('Berhasil', 'Berhasil membuat user baru');
        return redirect()->route('user.index')->with('success', 'User created successfully!');
    }

    public function show($id)
    {
        //
    }

    public function showProfile() {
        $profileUser = User::find(Auth::id());

        return view('admin.pages.users.profile', compact('profileUser'));
    }

    public function changePassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'password_old' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);
        }

        $user = User::find(Auth::id());

        if (!Hash::check($request->password_old, $user->password)) {
            return redirect()->back()->with('error', 'Kata sandi yang diberikan tidak cocok dengan kata sandi saat ini Anda.');
        }
    
        $user->password = Hash::make($request->password);
        $user->save();
    
        return redirect()->route('user.profile')->with('success', 'Password anda berhasil diubah');
    }

    public function editProfile(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => [
                'required',
                'email',
                    function ($attribute, $value, $fail) {
                        if (!$this->isUniqueEmail($value, Auth::id())) {
                            $fail('Email sudah digunakan.');
                        }
                    }
                ],
            'username' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    if (!$this->isUniqueUsername($value, Auth::id())) {
                        $fail('Username sudah digunakan.');
                    }
                }   
            ]
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $user = User::find(Auth::id());
        $user->name = $request->nama;
        $user->username = $request->username;
        $user->email = $request->email;

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Data Profile anda berhasil diubah');

    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = RoleUser::all();
        $kabKotas = KabupatenOrKotaSumut::all();

        return view('admin.pages.users.edit', compact('user', 'roles', 'kabKotas'));
    }

    private function isUniqueUsername($username, $userId)
    {
        $count = User::where('username', $username)
                    ->where('id', '!=', $userId)
                    ->count();
        return $count === 0;
    }

    private function isUniqueEmail($email, $userId) 
    {
        $count = User::where('email', $email)
                    ->where('id', '!=', $userId)
                    ->count();
        return $count === 0;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'username' => [
                'required', 
                function ($attribute, $value, $fail) use ($id) {
                    if (!$this->isUniqueUsername($value, $id)) {
                        $fail('Username sudah digunakan.');
                    }
                }    
            ],
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) use ($id) {
                    if (!$this->isUniqueEmail($value, $id)) {
                        $fail('Email sudah digunakan.');
                    }
                }  
            ],
            'role' => [
                'required',
                Rule::exists(RoleUser::class, 'id')
            ],
            'password' => 'nullable|min:8|confirmed',
            "kabkota_id" => [
                Rule::requiredIf($request->role == 2)
            ]
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role_user_id = $request->role;
        $user->kabkota_id = $request->kabkota_id;
        if ($request->password){
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'Data user berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
    
        // Redirect ke halaman lain dengan pesan sukses
        Alert::warning('Berhasil', 'Berhasil menghapus User');
        return redirect()->route('user.index')->with('success', 'User deleted successfully!');
    }
}
