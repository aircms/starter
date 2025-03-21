<?php

declare(strict_types=1);

namespace App\Model;

use Air\Crud\Model\Language;
use Air\Model\ModelAbstract;
use Air\Type\Meta;
use Air\Type\RichContent;

/**
 * @collection LegalPrivacyPolicy
 *
 * @property string $id
 *
 * @property string $title
 * @property RichContent[] $richContent
 *
 * @property Meta $meta
 *
 * @property integer $createdAt
 * @property integer $updatedAt
 *
 * @property Language $language
 * @property boolean $enabled
 */
class LegalPrivacyPolicy extends ModelAbstract
{
}