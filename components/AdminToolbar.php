<?php namespace Davask\AdminToolbar\Components;

use System\Classes\CombineAssets;
use Cms\Classes\ComponentBase;
use Url;
use Auth;
use Backend;
use BackendAuth;

class AdminToolbar extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Admin Toolbar',
            'description' => 'Displays an admin toolbar in front end.'
        ];
    }

    /**
     * Returns the logged in user, if available
     */
    public function adminLogo()
    {
        return Url::asset('modules/backend/assets/images/dashboard-icon.svg');
    }

    /**
     * Returns the logged in user, if available
     */
    public function user()
    {
        if (!Auth::check()) {
            return null;
        }

        $user = Auth::getUser();

        return $user;
    }

    /**
     * Returns the logged in user, if available
     */
    public function backendUser()
    {
        if (!BackendAuth::check()) {
            return null;
        }

        return BackendAuth::getUser();
    }

    public function menus()
    {
        $menus = [
            "global" => [
                "backend" => Backend::url('backend'),
            ],
            "menu" => [
                "cms" => Backend::url('cms'),
                "plugins" => Backend::url('system/updates'),
                "menu" => Backend::url('benfreke/menumanager/menus'),
                "users" => Backend::url('rainlab/user/users'),
            ],
        ];

        if ($user = $this->user()) {
            $menus["user"] = [
                "myaccount" => Backend::url('rainlab/user/users/preview/'. $user->id),
            ];
        }
        if ($this->backendUser()) {
            $menus["backendUser"] = [
                "myaccount" => Backend::url('backend/users/myaccount'),
            ];
        }

        return $menus;

    }

    /**
     * Executed when this component is bound to a page or layout.
     */
    public function onRun()
    {
        $addCsss = [
            'davask/admintoolbar/assets/scss/toolbar.scss',
        ];
        if (\Config::get('app.debug', false)) {
            for ($i=0; $i < count($addCsss); $i++) {
                $this->addCss(CombineAssets::combine([
                    $addCsss[$i]
                ], plugins_path()).'.css?p='.urlencode(str_replace(['assets/', '/'], ['', '-'],$addCsss[$i])));
            }
        } else {
            $this->addCss(CombineAssets::combine($addCsss, plugins_path()).'.css');
        }
    }


}
