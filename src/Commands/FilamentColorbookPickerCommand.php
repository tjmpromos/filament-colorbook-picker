<?php

namespace Dymond\FilamentColorbookPicker\Commands;

use Illuminate\Console\Command;

class FilamentColorbookPickerCommand extends Command
{
    public $signature = 'filament-colorbook-picker';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
