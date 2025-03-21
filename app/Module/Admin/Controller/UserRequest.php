<?php

declare(strict_types=1);

namespace App\Module\Admin\Controller;

use Air\Crud\Controller\Multiple;

/**
 * @mod-sorting {"createdAt": -1}
 *
 * @mod-export {"title": "Name", "by": "name"}
 * @mod-export {"title": "Email", "by": "email"}
 * @mod-export {"title": "Phone", "by": "phone"}
 *
 * @mod-header {"title": "Ім'я", "by": "name"}
 * @mod-header {"title": "E-mail", "by": "email"}
 * @mod-header {"title": "Телефон", "by": "phone"}
 * @mod-header {"title": "Коли", "by": "createdAt", "type" : "dateTime"}
 *
 * @mod-filter {"type": "search", "by": ["name", "email", "phone"]}
 * @mod-filter {"type": "dateTime", "by": "createdAt"}
 */
class UserRequest extends Multiple
{
}
