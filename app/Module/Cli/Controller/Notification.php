<?php

declare(strict_types=1);

namespace App\Module\Cli\Controller;

use Air\Core\Worker;
use Air\Email;

class Notification extends Worker
{
  protected function index(): ?bool
  {
    return Email::consume();
  }
}
