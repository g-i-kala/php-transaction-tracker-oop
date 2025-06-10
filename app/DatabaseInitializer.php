<?php

declare(strict_types=1);

namespace App;

use PDO;

class DatabaseInitializer
{
    public static function createTable(DB $db)
    {
        $transactions_schema = '
            id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            date DATE, 
            check_no INT,
            description VARCHAR(254),
            amount DECIMAL(8,2) NOT NULL
        ';

        $query = 'SHOW TABLES';
        $tables = $db->query($query)->fetchAll(PDO::FETCH_COLUMN);
        if (!in_array('transactions', $tables)) {
            $stmt = $db->prepare("CREATE TABLE transactions ($transactions_schema)");
            $stmt->execute();
        };

    }
}
