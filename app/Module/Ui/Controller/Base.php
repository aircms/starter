<?php

declare(strict_types=1);

namespace App\Module\Ui\Controller;

use Air\Core\Controller;
use Air\Crud\Model\Language;
use App\Helper\Route;

abstract class Base extends Controller
{
  public function postRun(): void
  {
    parent::postRun();

    if ($this->getRequest()->isAjax()) {
      $this->getView()->setLayoutEnabled(false);

      $this->getResponse()->setHeader('title', json_encode(
        $this->getView()->getMeta()->getComputedData()['title']
      ));

      $langLink = [];
      foreach (Language::all() as $lang) {
        $langLink[$lang->key] = Route::currentRouteToLanguage($lang);
      }
      $this->getResponse()->setHeader('languages', json_encode($langLink));
    }
  }
}