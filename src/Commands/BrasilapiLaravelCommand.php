<?php

declare(strict_types=1);

namespace BrasilApi\BrasilapiLaravel\Commands;

use Illuminate\Console\Command;

class BrasilapiLaravelCommand extends Command
{
    public $signature = 'brasilapi-laravel';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
