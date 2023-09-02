<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    function cleanData($data)
    {
        foreach ($data as &$row) {
            foreach ($row as &$value) {
                if ($value === null) {
                    $value = 0;
                } elseif (is_string($value)) {
                    $value = floatval($value);
                }
            }
        }

        return $data;
    }

    private function zScoreNormalization($data)
    {
        $n = count($data);
        $dim = count($data[0]);

        // Menghitung mean dan standar deviasi setiap dimensi
        $mean = [];
        $stdDev = [];
        for ($i = 0; $i < $dim; $i++) {
            $sum = 0;
            for ($j = 0; $j < $n; $j++) {
                $sum += $data[$j][$i];
            }
            $mean[$i] = $sum / $n;

            $sumSquares = 0;
            for ($j = 0; $j < $n; $j++) {
                $sumSquares += pow($data[$j][$i] - $mean[$i], 2);
            }
            $stdDev[$i] = sqrt($sumSquares / $n);
        }

        // Normalisasi Z-Score
        $normalizedData = [];
        for ($i = 0; $i < $n; $i++) {
            $normalizedRow = [];
            for ($j = 0; $j < $dim; $j++) {
                $normalizedValue = ($data[$i][$j] - $mean[$j]) / $stdDev[$j];
                $normalizedRow[] = $normalizedValue;
            }
            $normalizedData[] = $normalizedRow;
        }

        return $normalizedData;
    }


    private function chebyshev_distance($point1, $point2)
    {
        if (count($point1) !== count($point2)) {
            throw new Exception("Dimensi kedua titik harus sama");
        }

        $distance = 0;
        $dimensions = count($point1);
        for ($i = 0; $i < $dimensions; $i++) {
            $currentDistance = abs($point1[$i] - $point2[$i]);
            if ($currentDistance > $distance) {
                $distance = $currentDistance;
            }
        }

        return $distance;
    }

    private function pam($n_cluster, $data)
    {
        $next = true;
        $beforeCost = 0;
        $beforeLabel = [];
        $x = 0;
        while ($next) {
            $centroidIndex = [];
            $sizeData = count($data);
            $i = 0;
            while ($i < $n_cluster) {
                $randomNum = random_int(0, $sizeData - 1);
                $isContainCentroid = array_search($randomNum, $centroidIndex);
                if ($isContainCentroid === false) {
                    array_push($centroidIndex, $randomNum);
                    $i++;
                }
            }

            $resultDistanceArr = [];
            for ($i = 0; $i < count($centroidIndex); $i++) {
                $tmp = [];
                for ($j = 0; $j < count($data); $j++) {
                    $resultDistance = self::chebyshev_distance($data[$centroidIndex[$i]], $data[$j]);
                    array_push($tmp, $resultDistance);
                }
                array_push($resultDistanceArr, $tmp);
            }


            $costTmp = 0;
            $resultClusterLabel = [];

            for ($i = 0; $i < count($data); $i++) {
                $tmpArr = [];
                for ($j = 0; $j < count($resultDistanceArr); $j++) {
                    array_push($tmpArr, $resultDistanceArr[$j][$i]);
                }


                $minIndex = array_search(min($tmpArr), $tmpArr);
                array_push($resultClusterLabel, ['label' => $minIndex, 'data' => $data[$i]]); // Simpan indeks yang ditemukan
                $costTmp += min($tmpArr);
            }

            if ($x > 0) {
                if ($beforeCost > $costTmp) {
                    $next = true;
                    $beforeCost = $costTmp;
                    $beforeLabel = $resultClusterLabel;
                } else {
                    $next = false;
                }
            } else {
                $beforeCost = $costTmp;
                $beforeLabel = $resultClusterLabel;
            }
            $x++;
        }

        $result = [];
        $result['label'] = $beforeLabel;
        $result['cost'] = $beforeCost;
        $result['n_cluster'] = $n_cluster;
        // $result['data'] = $data;

        return $result;
    }

    private function dataMining($data)
    {
        $resultClean = $this->cleanData($data);
        $resultZscore = $this->zScoreNormalization($resultClean);

        $actualyCluster = $this->pam(3, $resultZscore);

        return $actualyCluster;
    }


    public function index()
    {
        return view('pages.index');
    }

    public function peta_sebaran()
    {

        // $results = DB::table('data_dbd as d')
        //     ->selectRaw('kab.name as name, AVG(abj) as ABJ, (SUM(kasus_total) / kab.jmlpddk * 100000) as IR, (SUM(meninggal_total) / SUM(kasus_total) * 100) as CFR, kab.jmlpddk as jmlpddk, kab.file_geojson as file_geojson')
        //     ->join('kabupaten_or_kota_sumut as kab', 'kab.id', '=', 'd.kab_or_kota_id')
        //     ->groupBy('kab_or_kota_id')
        //     ->get()->toArray();

        $results = DB::table('data_dbd as d')
            ->selectRaw("kab.nama as name, kab.file_geojson as file_geojson, AVG(abj) as ABJ, kab.id as kab_kota_id, kab.jmlpddk, (SUM(kasus_total) / kab.jmlpddk * 100000) as IR, (SUM(meninggal_total) / SUM(kasus_total) * 100) as CFR")
            ->join('kabupaten_or_kota_sumut as kab', 'kab.id', '=', 'd.kab_or_kota_id')
            ->groupBy('kab.id', 'kab.jmlpddk', 'kab.nama', "kab.file_geojson")
            ->get();

        $minMonthYear = DB::table('data_dbd')
            ->select(DB::raw('MIN(CONCAT(tahun, "-", bulan)) as minMonthYear'))
            ->value('minMonthYear');

        $maxMonthYear = DB::table('data_dbd')
            ->select(DB::raw('MAX(CONCAT(tahun, "-", bulan)) as maxMonthYear'))
            ->value('maxMonthYear');

        $minYear = DB::table('data_dbd')
            ->select(DB::raw('MIN(CONCAT(tahun)) as minYear'))
            ->value('minYear');

        $maxYear = DB::table('data_dbd')
            ->select(DB::raw('MAX(CONCAT(tahun)) as maxYear'))
            ->value('maxYear');

        $minYear = $minYear > (date('Y') - 5) ? $minYear : (date('Y') - 5);

        $dataCards = DB::table('data_dbd as d')
            ->selectRaw('(SUM(kasus_total) / (SELECT SUM(jmlpddk) FROM kabupaten_or_kota_sumut) * 100000) as IR, (SUM(d.meninggal_total) / SUM(d.kasus_total) * 100) as CFR, SUM(d.kasus_total) as kasus_total, SUM(d.meninggal_total) as meninggal_total, AVG(abj) as ABJ, (SELECT SUM(jmlpddk) FROM kabupaten_or_kota_sumut) as jmlpddk')->whereBetween(
                'tahun',
                [$minYear, $maxYear]
            )
            ->get()[0];

        // Memecah nilai minMonthYear dan maxMonthYear menjadi bulan dan tahun terpisah
        $minMonth = date('F', strtotime($minMonthYear));
        $minYear = date('Y', strtotime($minMonthYear));
        $maxMonth = date('F', strtotime($maxMonthYear));
        $maxYear = date('Y', strtotime($maxMonthYear));


        $dataBeforeClaster = [];
        for ($i = 0; $i < count($results); $i++) {
            array_push($dataBeforeClaster, [$results[$i]->IR, $results[$i]->CFR, $results[$i]->ABJ]);
        }


        $resultCluster = $this->dataMining($dataBeforeClaster);

        for ($i = 0; $i < count($results); $i++) {
            $results[$i]->cluster = $resultCluster['label'][$i]['label'];
        }


        $jsonData = json_encode($results);

        // dd($dataCards);

        return view('pages.peta_sebaran', compact('jsonData', 'results', 'minMonth', 'minYear', 'maxMonth', 'maxYear', 'dataCards'));
    }


    public function testCluster()
    {
        $data = [[2, 6, 4], [3, 4, 4], [3, 8, 6], [4, 7, 1], [6, 2, 2], [6, 4, 9], [7, 3, 8], [7, 4, 3], [8, 5, 1], [7, 6, 2]];

        $actualyCluster = $this->dataMining($data);

        return response()->json($actualyCluster, 200);
    }

    private function euclidean_distance($point1, $point2)
    {
        if (count($point1) !== count($point2)) {
            throw new Exception("Dimensi kedua titik harus sama");
        }

        $sumOfSquares = 0;
        $dimensions = count($point1);

        for ($i = 0; $i < $dimensions; $i++) {
            $difference = $point1[$i] - $point2[$i];
            $sumOfSquares += pow($difference, 2);
        }

        $distance = sqrt($sumOfSquares);
        return $distance;
    }
}
