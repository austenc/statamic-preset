<?php

namespace AustenCam\Preset;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\Presets\Preset as BasePreset;

class Preset extends BasePreset
{
    public static function install()
    {
        static::ensureComponentDirectoryExists();
        static::updatePackages();
        static::updateWebpackConfig();
        static::updateCss();
        static::updateJavascript();
        static::updateDotfiles();
        static::removeNodeModules();
        static::addTailwindConfig();
        static::updateViews();
    }

    protected static function path($filename)
    {
        return __DIR__ . '/../' . $filename;
    }

    /**
     * Update the given package array.
     *
     * @param  array  $packages
     * @return array
     */
    protected static function updatePackageArray(array $packages)
    {
        return [
            'hamburgers' => '^1.1.3',
            'laravel-mix-purgecss' => '^4.2.0',
            'postcss-import' => '^12.0.1',
            'postcss-nesting' => '^7.0.1',
            'spotlight.js' => '^0.6.5',
            'tailwindcss' => '^1.1.3',
        ] + $packages;
    }

    /**
     * Update the Webpack configuration.
     *
     * @return void
     */
    protected static function updateWebpackConfig()
    {
        copy(self::path('webpack.mix.js'), base_path('webpack.mix.js'));
    }

    protected static function updateViews()
    {
        tap(new Filesystem, function ($files) {
            $files->copyDirectory(self::path('resources/views'), resource_path('views'));
        });
    }

    /**
     * Update the CSS files and remove extra scss stuff
     */
    protected static function updateCss()
    {
        tap(new Filesystem, function ($files) {
            $files->deleteDirectory(resource_path('sass'));
            $files->delete(public_path('css/app.css'));

            if (!$files->isDirectory($directory = resource_path('css'))) {
                $files->makeDirectory($directory, 0755, true);
            }
            $files->copyDirectory(self::path('resources/css'), resource_path('css'));
        });
    }

    /**
     * Copy in our preset's Javascript files
     */
    protected static function updateJavascript()
    {
        tap(new Filesystem, function ($files) {
            $files->delete(public_path('js/app.js'));
            $files->delete(resource_path('js/site.js'));
            $files->delete(resource_path('js/bootstrap.js'));
            $files->copy(self::path('resources/js/app.js'), resource_path('js/app.js'));
        });
    }

    /**
     * Update the default .gitignore file, add .prettierrc
     */
    protected static function updateDotfiles()
    {
        copy(self::path('new-gitignore'), base_path('.gitignore'));
        copy(self::path('prettierrc'), base_path('.prettierrc'));
    }

    protected static function addTailwindConfig()
    {
        copy(self::path('tailwind.config.js'), base_path('tailwind.config.js'));
    }
}
