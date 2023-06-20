<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GisControllerr extends Controller
{

    private function cleanData($data)
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

    public function testCleanData()
    {
        $inputData = [
            ['IR' => "0.4", 'CFR' => '0.1', 'ABJ' => '90.5'],
            ['IR' => '1.5', 'CFR' => null, 'ABJ' => null],
        ];
        $result = $this->cleanData($inputData);

        return response()->json(["input" => $inputData, "output" => $result], 200);
    }

    function hitungZScore($data)
    {
        // Menghitung rata-rata setiap kolom
        $jumlahData = count($data);
        $jumlahKolom = count($data[0]);

        $rataRata = [];
        for ($j = 0; $j < $jumlahKolom; $j++) {
            $total = 0;
            for ($i = 0; $i < $jumlahData; $i++) {
                $total += $data[$i][$j];
            }
            $rataRata[$j] = $total / $jumlahData;
        }

        // Menghitung standar deviasi setiap kolom
        $standarDeviasi = [];
        for ($j = 0; $j < $jumlahKolom; $j++) {
            $totalKuadratSelisih = 0;
            for ($i = 0; $i < $jumlahData; $i++) {
                $selisih = $data[$i][$j] - $rataRata[$j];
                $totalKuadratSelisih += $selisih * $selisih;
            }
            $standarDeviasi[$j] = sqrt($totalKuadratSelisih / ($jumlahData - 1));
        }

        // Menghitung Z-Score untuk setiap angka dalam setiap kolom
        $zScore = [];
        for ($i = 0; $i < $jumlahData; $i++) {
            for ($j = 0; $j < $jumlahKolom; $j++) {
                $zScore[$i][$j] = ($data[$i][$j] - $rataRata[$j]) / $standarDeviasi[$j];
            }
        }

        return $zScore;
    }

    public function testZscore()
    {
        $inputData = [[2, 6, 4], [3, 4, 4], [3, 8, 6]];

        $outputZscore = $this->hitungZScore($inputData);
        $outputZscore = [
            [-1.154700538379251, 0, -0.577350269189626],
            [0.577350269189626, -1, -0.577350269189626],
            [0.577350269189626, 1, 1.154700538379251]
        ];

        return response()->json(compact('inputData', 'outputZscore'), 200);
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

    public function testChebyshevDistance()
    {
        $inputDataPoint1 = [3, 4, 4];
        $inputDataPoint2 = [5, 9, 5];

        $result = $this->chebyshev_distance($inputDataPoint1, $inputDataPoint2);

        return response()->json(compact("inputDataPoint1", "inputDataPoint2", "result"));
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

        $resultZscore = $this->hitungZScore($resultClean);

        $actualyCluster = $this->pam(3, $resultZscore);

        return $actualyCluster;
    }

    private function testDataMining($data)
    {
        $actualyCluster = $this->pam(3, $data);
        return $actualyCluster;
    }

    public function testCluster()
    {
        $data = [[2, 6, 4], [3, 4, 4], [3, 8, 6], [4, 7, 1]];

        $actualyCluster = $this->testDataMining($data);

        return response()->json($actualyCluster, 200);
    }

    private function getRangeTimeData()
    {
        $minMonthYear = DB::table('data_dbd')
            ->select(DB::raw('MIN(CONCAT(tahun, "-", bulan)) as minMonthYear'))
            ->value('minMonthYear');

        $maxMonthYear = DB::table('data_dbd')
            ->select(DB::raw('MAX(CONCAT(tahun, "-", bulan)) as maxMonthYear'))
            ->value('maxMonthYear');

        // Memecah nilai minMonthYear dan maxMonthYear menjadi bulan dan tahun terpisah
        $minMonth = date('F', strtotime($minMonthYear));
        $minYear = date('Y', strtotime($minMonthYear));
        $maxMonth = date('F', strtotime($maxMonthYear));
        $maxYear = date('Y', strtotime($maxMonthYear));

        return [
            "minMonth" => $minMonth,
            "minYear" => $minYear,
            "maxMonth" => $maxMonth,
            "maxYear" => $maxYear,
        ];
    }

    private function getDataFromDB()
    {
        $results = DB::table('data_dbd as d')
            ->selectRaw("kab.nama as name, kab.file_geojson as file_geojson, AVG(abj) as ABJ, kab.id as kab_kota_id, kab.jmlpddk, (SUM(kasus_total) / kab.jmlpddk * 100000) as IR, (SUM(meninggal_total) / SUM(kasus_total) * 100) as CFR")
            ->join('kabupaten_or_kota_sumut as kab', 'kab.id', '=', 'd.kab_or_kota_id')
            ->groupBy('kab.id', 'kab.jmlpddk', 'kab.nama', "kab.file_geojson")
            ->get();

        return $results;
    }

    private function getDataWantToCluster($results)
    {
        $dataBeforeClaster = [];
        for ($i = 0; $i < count($results); $i++) {
            array_push($dataBeforeClaster, [$results[$i]->IR, $results[$i]->CFR, $results[$i]->ABJ]);
        }

        return $dataBeforeClaster;
    }

    public function petaSebaran()
    {
        $rangeDataDBD = $this->getRangeTimeData();
        // Memecah nilai minMonthYear dan maxMonthYear menjadi bulan dan tahun terpisah
        $minMonth = $rangeDataDBD['minMonth'];
        $minYear = $rangeDataDBD['minYear'];
        $maxMonth = $rangeDataDBD['maxMonth'];
        $maxYear = $rangeDataDBD['maxYear'];

        $dataDBD = $this->getDataFromDB();

        $dataBeforeClaster = $this->getDataWantToCluster($dataDBD);

        $resultCluster = $this->dataMining($dataBeforeClaster);

        for ($i = 0; $i < count($dataDBD); $i++) {
            $dataDBD[$i]->cluster = $resultCluster['label'][$i]['label'];
        }

        $jsonData = json_encode($dataDBD);

        return view('admin.pages.maps.peta_pam', compact('jsonData', 'dataDBD', 'minMonth', 'minYear', 'maxMonth', 'maxYear'));
    }
}
