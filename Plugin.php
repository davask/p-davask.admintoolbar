<?php namespace Davask\AdminToolbar;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'Davask\AdminToolbar\Components\AdminToolbar' => 'adminToolbar'
        ];
    }

    public function registerSettings()
    {
    }
}
