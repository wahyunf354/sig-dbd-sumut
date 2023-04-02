<?php 

namespace App\Helper\Impl;

use App\Helper\FileHelper;
use Carbon\Carbon;

class FileHelperImpl implements FileHelper {
  public function uploadFile($file, $dest, $filename): string
  {
    $extention = $file->getClientOriginalExtension();
    $filename = ($filename != "" ? $filename : Carbon::now()->timestamp) . '.' . $extention;
    $file->move($dest, $filename);

    return $filename;
  }

  public function deleteFile($fileDest): bool
  {
    if (file_exists($fileDest)) {
      $result = unlink($fileDest);
      if($result) {
        return true;
      } 
    }
    return false;
  }
}
