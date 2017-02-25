<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Optimus\FineuploaderServer\Vendor\FineUploader;

/*
 * Hier muss ich mich erst einmal ein wenig durchwurschteln, da es dafür keine
 * Beispiele im Netz zu finden gibt...
 *
 * Aber wie sagt man so schön, selbst ist der Mann!
 */

class FineUploaderController extends Controller
{
    public function endpoint()
    {
        $fu = new FineUploader();
        $destpath = storage_path('app/public/temp');
        if (! file_exists($destpath)) {
            mkdir($destpath);
        }
        $res = $fu->handleUpload(storage_path('app/public/temp'), 'file');

        $res['ext'] = pathinfo($fu->getName(), PATHINFO_EXTENSION);

        return json_encode($res);
    }
}
