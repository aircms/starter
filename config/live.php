<?php

return [
  'env' => 'live',
  'air' => [
    'modules' => '\\App\\Module',
    'exception' => true,
    'phpIni' => [
      'display_errors' => '1',
    ],
    'startup' => [
      'error_reporting' => E_ALL,
      'date_default_timezone_set' => 'Europe/Kyiv',
    ],
    'loader' => [
      'path' => realpath(dirname(__FILE__)) . '/../app',
      'namespace' => 'App',
    ],
    'db' => [
      'driver' => 'mongodb',
      'servers' => [[
        'host' => 'localhost',
        'port' => 27017,
      ]],
      'db' => getenv('AIR_DB_DB')
    ],
    'storage' => [
      'route' => '_storage',
      'url' => getenv('AIR_FS_URL'),
      'key' => getenv('AIR_FS_KEY'),
    ],
    'logs' => [
      'enabled' => true,
      'exception' => true,
      'route' => '_logs',
    ],
    'fontsUi' => 'fontsUi',
    'admin' => [
      'title' => 'Starter',
      'logo' => '/assets/air/logo.png',
      'favicon' => '/assets/air/logo.png',
      'manage' => '_admin',
      'history' => '_adminHistory',
      'system' => '_system',
      'fonts' => '_fonts',
      'faIcon' => '_faIcon',
      'languages' => '_languages',
      'phrases' => '_phrases',
      'codes' => '_codes',
      'robotsTxt' => '_robotsTxt',
      'cache' => '_cache',
      'notAllowed' => '_notAllowed',
      'emailTemplates' => '_emailTemplates',
      'emailSettings' => '_emailSettings',
      'emailQueue' => '_emailQueue',
      'rich-content' => [
        'files', 'text', 'html', 'embed'
      ],
      'auth' => [
        'route' => '_auth',
        'cookieName' => 'authIdentity',
        'source' => 'database',
        'root' => [
          'login' => getenv('AIR_ADMIN_AUTH_ROOT_LOGIN'),
          'password' => getenv('AIR_ADMIN_AUTH_ROOT_PASSWORD'),
        ]
      ],
      'tiny' => getenv('AIR_ADMIN_TINY_KEY'),
      'menu' => require_once 'nav.php',
      'locale' => 'ua'
    ]
  ],
  'router' => [
    'cli' => [
      'module' => 'cli'
    ],
    'admin.*' => [
      'module' => 'admin',
      'air' => [
        'asset' => [
          'underscore' => false,
          'prefix' => '/assets/air',
        ],
      ]
    ],
    '*' => [
      'strict' => true,
      'module' => 'ui',
      'routes' => require_once 'routes.php',
      'air' => [
        'view' => [
          'minify' => false,
        ],
        'asset' => [
          'underscore' => true,
          'prefix' => '/assets/ui',
          'defer' => true,
          'async' => true,
        ],
      ]
    ],
  ],
];
