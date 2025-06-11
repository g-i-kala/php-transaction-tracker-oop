<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Exceptions\UploadValidationException;
use App\View;
use App\FileUploader;
use App\Forms\UploadForm;
use App\Models\Transaction;
use App\TransactionSanitizer;

class TransactionsController
{
    public function index()
    {
        $transactions = new Transaction();
        $data = $transactions->all();
        $balance = $transactions->calculateBalance();

        return View::make('transactions', [
            'data' => $data,
            'balance' => $balance
        ]);
    }

    public function store()
    {
        $errors = [];

        $file = $_FILES["myFile"] ?? null;

        try {
            $uploadForm = UploadForm::validate($_FILES["myFile"] ?? null);
            $file = $uploadForm->file();
        } catch (UploadValidationException $e) {
            return View::make('index', ['errors' => $e->getErrors()]);
        };

        // $uploadValidator = new UploadValidator($file);

        // if (!$uploadValidator->validate()) {
        //     $errors = $uploadValidator->getErrors();
        //     return View::make('index', ['errors' => $errors]);
        // }

        $uploader = new FileUploader($file['tmp_name']);
        $path = $uploader->moveTo(STORAGE_PATH . "/uploads");

        if (!$path) {
            $errors = $uploader->getErrors();
            return View::make('index', ['errors' => $errors]);
        }

        $transactions = new Transaction();
        $data = $transactions->importTransactions($path);

        foreach ($data as $transaction) {
            $transaction = TransactionSanitizer::sanitizeData($transaction);
            $transactions->insertData($transaction);
        };

        header("Location: /");
        exit();
    }
}
