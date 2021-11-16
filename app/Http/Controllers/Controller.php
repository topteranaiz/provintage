<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function createFolder($destinationPath){
        if(!is_dir($destinationPath)){
            \File::makeDirectory($destinationPath, $mode = 0777, true, true);
        }
    }

    public function generateFilename($destination , $lang = null){
        $filename = md5( rand(0,99999) . date('Ymd') );
        while ( file_exists($destination . $filename) )
            $filename = md5( rand(0,99999) . date('Ymd') );
        return $filename;
    }
}
