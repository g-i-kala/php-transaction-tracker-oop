<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Transaction;
use App\View;

class HomeController
{
    public function index(): View
    {
        $transactions = new Transaction();
        $data = $transactions->all();
        $balance = $transactions->calculateBalance();

        return View::make('index', [
            'data' => $data,
            'balance' => $balance
        ]);
    }
}
