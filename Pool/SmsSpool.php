<?php

declare(strict_types=1);

/*
 * This file is part of Mindy Framework.
 * (c) 2017 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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
        (new Sms(['to' => $to, 'text' => $text]))->save();
    }
}
