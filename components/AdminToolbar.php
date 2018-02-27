<?php namespace Davask\AdminToolbar\Components;

use Cms\Classes\ComponentBase;
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
    public function user()
    {
        if (!Auth::check()) {
            return null;
        }

        return Auth::getUser();
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

    /**
     * Executed when this component is initialized
     */
    public function prepareVars()
    {
        $this->page['user'] = $this->user();
        $this->page['backendUser'] = $this->backendUser();
        $this->page['menus'] = $this->menus();
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

        if ($this->page['user']) {
            $menus["user"] = [
                "myaccount" => Backend::url('rainlab/user/users/preview/'. $this->page['user']->id),
            ];
        }
        if ($this->page['backendUser']) {
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
        $this->prepareVars();
    }


}
