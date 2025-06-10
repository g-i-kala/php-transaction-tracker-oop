<?php

declare(strict_types=1);

namespace App\Models;

use PDO;
use App\DB;
use App\App;

class Transaction
{
    protected DB $db;
    private $transactions = [];
    private $errors = [];
    private $transactionHandler = null;

    public function __construct()
    {
        $this->db = App::db();
    }

    public function importTransactions($fileName, $transactionHandler = null)
    {
        if (($handle = fopen($fileName, "r")) !== false) {
            fgetcsv($handle, 1000, ",", '"', '\\');
            while (($data = fgetcsv($handle, 1000, ",", '"', '\\')) !== false) {
                if ($this->transactionHandler !== null) {
                    $this->transactions[] = $this->transactionHandler($data);
                } else {
                    $this->transactions[] = $data;
                }
            }
            fclose($handle);
        }
        return $this->transactions;
    }

    public function insertData($dataRow)
    {
        extract($dataRow);

        $stmt = $this->db->prepare("INSERT INTO transactions (date, check_no, description, amount) VALUES (:date, :check_no, :description, :amount)");
        $stmt->execute([
            'date' => $date,
            'check_no' => $checkNumber,
            'description' => $description,
            'amount' => $amount
        ]);

        return true;
    }

    public function all()
    {
        return $this->db->query("SELECT * FROM transactions")->fetchAll();
    }

    public function calculateBalance()
    {
        return [
            'income' => $this->db->query("SELECT SUM(amount) as balance FROM transactions WHERE amount >= 0")->fetchColumn(),
            'expense' => $this->db->query("SELECT SUM(amount) as balance FROM transactions WHERE amount <= 0")->fetchColumn(),
            'total' => $this->db->query("SELECT SUM(amount) as balance FROM transactions")->fetchColumn(),
        ];
    }

    public function getErrors()
    {
        return $this->errors;
    }
};
