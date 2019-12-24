<?php

namespace AustenCam\Preset;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\PresetCommand;

class PresetServiceProvider extends ServiceProvider
{
    public function boot()
    {
        PresetCommand::macro('statamic', self::statamic());
        PresetCommand::macro('statamic-preset', self::statamic());
    }

    public function statamic()
    {
        Preset::install();
        $command->info('Your preset has been installed successfully.');
        $command->info('Please run `npm i && npm run dev` to compile assets.');
    }
}
