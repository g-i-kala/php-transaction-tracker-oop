<?php

declare(strict_types=1);

namespace App;

class TransactionSanitizer
{
    public static function sanitizeData($transactionRow)
    {

        [$date, $checkNumber, $description, $amount] = $transactionRow;

        return [
            'date'          => date('Y-m-d', strtotime($date)),
            'checkNumber'   => (int)(trim($checkNumber)),
            'description'   => trim($description),
            'amount'        => (float)(str_replace(",", "", (str_replace("$", "", $amount))))
        ];
    }

    public function sanitized(array $data)
    {
        return array_map([self::class, 'sanitizeData'], $data);
    }
}
