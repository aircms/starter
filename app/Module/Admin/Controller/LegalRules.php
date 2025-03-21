<?php

declare(strict_types=1);

namespace App\Module\Admin\Controller;

use Air\Crud\Controller\Multiple;

/**
 * @mod-manageable true
 * @mod-controls {"type": "copy"}
 *
 * @mod-header {"title": "Назва", "by": "title"}
 * @mod-header {"title": "Мова", "by": "language", "type": "model", "field": "title"}
 * @mod-header {"title": "Увімкнено", "by": "enabled", "type": "bool"}
 * @mod-header {"title": "Оновлено", "by": "updatedAt", "type": "dateTime"}
 *
 * @mod-filter {"type": "bool", "by": "enabled", "true": "Увімкнено", "false": "Вимкнено", "value": "true"}
 * @mod-filter {"type": "model", "title": "Мова", "by": "language", "field": "title", "model": "\\Air\\Crud\\Model\\Language"}
 */
class LegalRules extends Multiple
{
}
