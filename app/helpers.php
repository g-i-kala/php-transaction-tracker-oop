<?php

declare(strict_types=1);

function formatDate($date)
{
    return date("M j Y", strtotime($date));
}

function valueStyle($value)
{
    $valueStyle = ($value > 0) ? "style='color: red;'" : "style='color: green;'";

    return $valueStyle;
}

function formatAmount($amount)
{
    $isNegative = $amount < 0;

    return ($isNegative ? '-' : '') . '$' . number_format((abs((float)($amount))), 2);
}
