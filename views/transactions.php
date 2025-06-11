<!DOCTYPE html>
<html>

<head>
    <title>Transactions</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        table tr th,
        table tr td {
            padding: 5px;
            border: 1px #eee solid;
        }

        tfoot tr th,
        tfoot tr td {
            font-size: 20px;
        }

        tfoot tr th {
            text-align: right;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Check #</th>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data)): ?>
            <?php foreach ($data as $transaction): ?>
            <tr>
                <td><?= htmlspecialchars(formatDate($transaction['date'])) ?>
                </td>
                <td><?= htmlspecialchars($transaction['check_no'] == 0 ? '' : $transaction['check_no']) ?>
                </td>
                <td><?= htmlspecialchars($transaction['description']) ?>
                </td>
                <td <?= htmlspecialchars(valueStyle($transaction['amount'])) ?>>
                    <?= htmlspecialchars(formatAmount($transaction['amount'])) ?>
                </td>
            </tr>
            <?php endforeach ?>
            <?php endif ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total Income:</th>
                <td><?= htmlspecialchars($balance['income'] ?? '') ?>
                </td>
            </tr>
            <tr>
                <th colspan="3">Total Expense:</th>
                <td><?= htmlspecialchars($balance['expense'] ?? '') ?>
                </td>
            </tr>
            <tr>
                <th colspan="3">Net Total:</th>
                <td><?= htmlspecialchars($balance['total'] ?? '') ?>
                </td>
            </tr>
        </tfoot>
    </table>
</body>

</html>