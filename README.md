To activate the admintoolbar in front office the backend user must be logged in and the config/environment.php must define the host as dev env

```PHP
return [

    /*
    |--------------------------------------------------------------------------
    | Environment Multitenancy
    |--------------------------------------------------------------------------
    |
    | You may specify a different environment according to the hostname that
    | is provided with the HTTP request. This is useful if you want to use
    | different configuration, such as database and theme, per hostname.
    |
    */

    'hosts' => [
        'your.dev.domain' => 'dev',
    ],

];
```
