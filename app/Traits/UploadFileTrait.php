<?php

namespace App\Traits;

use Carbon\Carbon;

trait UploadFileTrait
{
    public function uploadFile($pathStore, $file)
    {
        $now = Carbon::now();
        $year = $now->year;
        $month = $now->month;
        $filePath = $file->store($pathStore . '/' . $year . '/' . $month);

        return $filePath;
    }
}
