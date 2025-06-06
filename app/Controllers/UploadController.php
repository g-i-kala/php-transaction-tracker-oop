<?php

declare(strict_types=1);

namespace App\Controllers;

use App\App;
use App\View;
use App\FileUploader;
use App\UploadValidator;
use PDO;

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

        if (!$path) {
            $errors = $uploader->getErrors();
            return View::make('index', ['errors' => $errors]);
        }

        $data = $this->getTransactions($path);

        // data sanitization



        $db = App::db();
        // storeDataInDB = Transactions::create($data);

        $transactions_schema = '
            id INT PRIMARY KEY,
            date DATE, 
            check_no INT,
            description VARCHAR(254),
            amount DECIMAL(8,2)
        ';

        $query = 'SHOW TABLES';
        $tables = $db->query($query)->fetchAll(PDO::FETCH_COLUMN);
        if (!in_array('transactions', $tables)) {
            $stmt = $db->prepare("CREATE TABLE transactions ($transactions_schema)");
            $stmt->execute();
        }

        $data = array_map([$this, 'sanitizeData'], $data);
        dd($data);

        foreach ($data as $row) {
            [$date, $check_no, $description, $amount] = $row;

            $stmt = $db->prepare("INSERT INTO transactions (date, check_no, description, amount) VALUES (:date, :check_no, :description, :amount)");
            $stmt->execute([
                'date' => $date,
                'check_no' => $check_no,
                'description' => $description,
                'amount' => $amount
            ]);
            echo('done');
        }
        //return redirect View::make('index');
    }

    public function getTransactions($fileName, ?callable $transactionHandler = null)
    {
        if (($handle = fopen($fileName, "r")) !== false) {
            fgetcsv($handle, 1000, ",", '"', '\\');
            while (($data = fgetcsv($handle, 1000, ",", '"', '\\')) !== false) {
                if ($transactionHandler !== null) {
                    $transactions[] = $transactionHandler($data);
                } else {
                    $transactions[] = $data;
                }

            }
            fclose($handle);
        }
        return $transactions;
    }

    public function sanitizeData($transactionRow)
    {
        [$date, $checkNumber, $description, $amount] = $transactionRow;

        return [
            'date'          => date('Y-m-d', strtotime($date)),
            'checkNumber'   => trim($checkNumber),
            'description'   => trim($description),
            'amount'        => (float)(str_replace(",", "", (str_replace("$", "", $amount))))
        ];
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
