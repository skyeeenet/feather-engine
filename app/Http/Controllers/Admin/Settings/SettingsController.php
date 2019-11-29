<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Helpers\Libraries\FileProcessor;
use App\Helpers\Libraries\ImageProcessor;
use App\Http\Controllers\Controller;
use App\Page;
use App\Post;
use App\Role;
use App\Template;
use App\User;
use Illuminate\Http\Request;
use App\Settings;


class SettingsController extends Controller {

  public function index() {

    $title = Settings::getValue('TITLE');
    $description = Settings::getValue('DESCRIPTION');
    $header_text = Settings::getValue('HEADER_TEXT');
    $logo = Settings::getValue('LOGO');
    $image_size = Settings::getValue('IMAGE_SIZE');

    return view('admin.settings.create', compact('title', 'description', 'header_text', 'logo', 'image_size'));
  }

  public function update(Request $request) {

    if ($request->title) {

      Settings::setValue('TITLE', $request->title);
    }

    if ($request->description) {

      Settings::setValue('DESCRIPTION', $request->description);
    }

    if ($request->header_text) {

      Settings::setValue('HEADER_TEXT', $request->header_text);
    }

    if ($request->logo) {

      $fileProcessor = new FileProcessor();
      $imageProcessor = new ImageProcessor();

      $image_size = (int)Settings::getValue('IMAGE_SIZE');

      $path_full_images = $fileProcessor->saveImage($request, 'logo', 'images/', $image_size, $image_size);

      //$imageProcessor->compress('storage' . $path_full_images, $image_size, $image_size);

      Settings::setValue('LOGO', $path_full_images);
    }

    if ($request->image_size) {

      Settings::setValue('IMAGE_SIZE', $request->image_size);
    }

    return redirect()->back();
  }
}