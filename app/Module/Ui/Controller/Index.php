<?php

declare(strict_types=1);

namespace App\Module\Ui\Controller;

use Air\Type\Meta;

class Index extends Base
{
  public function index(): void
  {
    $this->getView()->setMeta(new Meta([
      'title' => 'Index::index'
    ]));
  }

  public function page2(): void
  {
    $this->getView()->setMeta(new Meta([
      'title' => 'Index::page2'
    ]));
  }
}