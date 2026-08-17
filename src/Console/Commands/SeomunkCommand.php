<?php

declare(strict_types=1);

namespace SeoMunk\SeoMunk\Console\Commands;

use Illuminate\Console\Command;

class SeomunkCommand extends Command
{
    /**
     * The command signature.
     */
    protected $signature = 'seomunk:placeholder';

    /**
     * The command description.
     */
    protected $description = 'Placeholder Artisan command shipped by the package seomunk.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->line('Seomunk placeholder command executed.');

        return self::SUCCESS;
    }
}
