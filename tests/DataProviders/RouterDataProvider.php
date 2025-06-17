<?php

declare(strict_types=1);

namespace Tests\DataProviders;

class RouterDataProvider
{
    public static function routeNotFoundCases(): array
    {
        return [
          ['/users', 'put'],
          ['/invoices', 'get'],
          ['/users', 'get'],
          ['/users', 'post']
        ];
    }
}
