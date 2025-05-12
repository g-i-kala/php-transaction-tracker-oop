<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use App\FileUploader;
use App\UploadValidator;

class UploadController
{
    public function store()
    {
        $errors = [];

        $file = $_FILES["myFile"] ?? null;

        $allowedTypes = [
          'text/plain' => 'csv',
          'application/csv' => 'csv',
          'application/vnd.ms-excel/plain' => 'csv',
        ];
        $maxSize = 1024 * 1024 * 3 ;

        $validator = new UploadValidator($file, $maxSize, $allowedTypes);

        if (!$validator->validate()) {
            $errors = $validator->getErrors();
            return View::make('index', ['errors' => $errors]);
        }

        $uploader = new FileUploader($file['tmp_name']);
        $path = $uploader->moveTo(STORAGE_PATH . "/uploads");

        // $data = readFile($file);
        // storeDataInDB = Transactions::create($data);
        //return redirect View::make('index');
    }

    public function handleUpload()
    {
        $filename = basename($filepath);
        $extension = $allowedTypes[$filetype];
        $targetDirectory = STORAGE_PATH . "/uploads";

        $newFilepath = $targetDirectory . "/" . $filename . "." . $extension;

        if (!move_uploaded_file($filepath, $newFilepath)) {
            dd("Can't move file.");
        }

        echo "File uploaded successfully :)";

    }

    public function readFile($file)
    {
        dd('i read the file');
    }
}
