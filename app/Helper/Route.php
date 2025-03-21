<?php

declare(strict_types=1);

namespace App\Helper;

class Route extends \Air\Core\Route
{
  public static function tel(string $phone): string
  {
    return "tel:" . $phone;
  }

  public static function email(string $email): string
  {
    return "mailto:" . $email;
  }
}