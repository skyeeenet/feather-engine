<?php

namespace App\Helpers\Libraries;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileProcessor {

  public function saveImage(Request $request, $fileName, $path, $width, $height) {

    //get filename with extension

    $filenamewithextension = $request->file($fileName)->getClientOriginalName();

    //get filename without extension
    $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

    //get file extension
    $extension = $request->file($fileName)->getClientOriginalExtension();

    //filename to store
    $filenametostore = translit($filename . '_' . $width . '_' . $height . '.' . $extension);

    //Upload File
    //Storage::disk('public')->put($path . $filenametostore, file_get_contents($request->file($fileName)));

    $file = $request->file($fileName);

    $destinationPath = 'storage/images';
    $res = $file->move($destinationPath,$file->getClientOriginalName());

    $url_to_store = $res->getPathname();

    $resultPath = '/' . $url_to_store;

    return $resultPath;
  }

  public function deleteFile($path) {

    try {

      unlink($path);

    } catch (\Exception $exception) {

      info('deleteFileException --- ' . $exception . '-----END');
    }

    return true;

  }
}
