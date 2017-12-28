<?php

declare(strict_types=1);

/*
 * This file is part of Mindy Framework.
 * (c) 2017 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\SmsBundle\Model;

use Mindy\Orm\Fields\CharField;
use Mindy\Orm\Fields\DateTimeField;
use Mindy\Orm\Fields\TextField;
use Mindy\Orm\Model;

/**
 * Class Sms
 *
 * @property string $created_at
 * @property string $text
 * @property string $to
 */
class Sms extends Model
{
    public static function getFields()
    {
        return [
            'to' => [
                'class' => CharField::class,
                'length' => 11,
            ],
            'text' => [
                'class' => TextField::class,
            ],
            'created_at' => [
                'class' => DateTimeField::class,
                'autoNowAdd' => true,
                'editable' => false,
            ],
        ];
    }

    public function __toString()
    {
        return sprintf('%s - %s', $this->to, $this->text);
    }
}
