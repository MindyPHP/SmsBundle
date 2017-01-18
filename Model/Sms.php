<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 29/11/2016
 * Time: 20:49
 */

namespace Mindy\Bundle\SmsBundle\Model;

use Mindy\Orm\Fields\CharField;
use Mindy\Orm\Fields\DateTimeField;
use Mindy\Orm\Fields\TextField;
use Mindy\Orm\Model;
use Zelenin\SmsRu\Api;
use Zelenin\SmsRu\Entity\Sms as SmsMessage;

class Sms extends Model
{
    public static function getFields()
    {
        return [
            'to' => [
                'class' => CharField::class,
                'length' => 10
            ],
            'text' => [
                'class' => TextField::class
            ],
            'created_at' => [
                'class' => DateTimeField::class,
                'autoNowAdd' => true,
                'editable' => false
            ]
        ];
    }

    public function smsSend(Api $api)
    {
        return $api->smsSend(new SmsMessage($this->to, $this->text));
    }
}