<?php

declare(strict_types=1);

namespace App\Controllers;

use App\UploadValidator;
use App\View;

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





        // if (!isset($_FILES["myFile"])) {
        //     dd("There is no file to upload.");
        // }

        // $filepath = $_FILES['myFile']['tmp_name'];
        // $fileSize = filesize($filepath);
        // $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
        // $filetype = finfo_file($fileinfo, $filepath);

        // if ($fileSize === 0) {
        //     dd("The file is empty.");
        // }

        // if ($fileSize > 3145728) { // 3 MB (1 byte * 1024 * 1024 * 3 (for 3 MB))
        //     dd("The file is too large");
        // }



        // if (!in_array($filetype, array_keys($allowedTypes))) {
        //     dd("File not allowed.");
        // }

        // $filename = basename($filepath);
        // $extension = $allowedTypes[$filetype];
        // $targetDirectory = STORAGE_PATH . "/uploads";

        // $newFilepath = $targetDirectory . "/" . $filename . "." . $extension;

        // if (!move_uploaded_file($filepath, $newFilepath)) {
        //     dd("Can't move file.");
        // }

        // echo "File uploaded successfully :)";

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
