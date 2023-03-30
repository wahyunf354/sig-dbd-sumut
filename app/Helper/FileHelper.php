<?php 

namespace App\Helper;

Interface FileHelper {
  function uploadFile($file, $dest, $filename): string;
}
