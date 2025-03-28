<?php

declare(strict_types=1);

namespace App\Module\Ui\Controller;

use Air\Core\ErrorController;
use Air\Core\Front;
use Air\Form\Exception\Validation;
use Air\Log;

class Error extends ErrorController
{
  public function index()
  {
    $request = $this->getRequest();
    $exception = $this->getException();

    if ($request->isAjax()) {
      $this->getView()->setLayoutEnabled(false);
    }

    $this->getResponse()->setStatusCode($exception->getCode() ?? 500);

    $config = [
      ...['enabled' => false, 'exception' => false, 'route' => '_logs',],
      ...Front::getInstance()->getConfig()['air']['logs'] ?? []
    ];

    if ($exception instanceof Validation) {
      return $exception->getForm()->getErrorFields();
    }

    if ($config['exception'] === true) {
      Log::error($exception->getMessage(), [
        'ip' => $request->getIp(),
        'user-agent' => $request->getUserAgent(),
        'trace' => $exception->getTrace(),
        'code' => $this->getResponse()->getStatusCode(),
        'params' => [
          'get' => $request->getGetAll(),
          'post' => $request->getPostAll(),
        ],
      ]);
    }

    if (Front::getInstance()->getConfig()['air']['exception'] ?? false) {
      return [
        'message' => $exception->getMessage(),
        'trace' => $exception->getTrace()
      ];
    }
  }
}