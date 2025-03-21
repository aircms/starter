<?php

return [
  [
    'title' => 'Сторінки',
    'icon' => 'bell-concierge',
    'items' => [
      [
        'title' => 'Правила користування сайтом',
        'icon' => 'book',
        'url' => ['controller' => 'legalRules']
      ],
      [
        'title' => 'Політика конфіденційності',
        'icon' => 'book',
        'url' => ['controller' => 'legalPrivacyPolicy']
      ],
    ]
  ],
  [
    'title' => 'Користувачі',
    'icon' => 'users',
    'items' => [
      [
        'title' => 'Звернення користувачів',
        'icon' => 'cogs',
        'url' => ['controller' => 'userRequest']
      ],
    ]
  ],
];