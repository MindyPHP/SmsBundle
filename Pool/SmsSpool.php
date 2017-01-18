<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 29/11/2016
 * Time: 20:50
 */

namespace Mindy\Bundle\SmsBundle\Pool;

use Mindy\Bundle\SmsBundle\Model\Sms;

class SmsSpool
{
    public function getMessages()
    {
        foreach (Sms::objects()->batch(100) as $messages) {
            foreach ($messages as $sms) {
                yield $sms;

                $sms->delete();
            }
        }
    }

    public function create($to, $text)
    {
        $sms = new Sms(['to' => $to, 'text' => $text]);
        $sms->save();
    }
}