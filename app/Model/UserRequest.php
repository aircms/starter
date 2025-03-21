<?php

declare(strict_types=1);

namespace App\Model;

use Air\Model\ModelAbstract;

/**
 * @collection UserRequest
 *
 * @property string $id
 *
 * @property string $name
 * @property string $phone
 * @property string $email
 *
 * @property integer $createdAt
 */
class UserRequest extends ModelAbstract
{
}