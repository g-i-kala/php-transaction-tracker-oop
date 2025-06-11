<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use App\FileUploader;
use App\UploadValidator;
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

        $uploadValidator = new UploadValidator($file);

        if (!$uploadValidator->validate()) {
            $errors = $uploadValidator->getErrors();
            return View::make('index', ['errors' => $errors]);
        }

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
