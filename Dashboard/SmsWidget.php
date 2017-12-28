<?php

declare(strict_types=1);

/*
 * This file is part of Mindy Framework.
 * (c) 2017 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\SmsBundle\Dashboard;

use Mindy\Bundle\DashboardBundle\Dashboard\AbstractWidget;
use Zelenin\SmsRu\Api;

class SmsWidget extends AbstractWidget
{
    protected $sms;

    public function __construct(Api $sms)
    {
        $this->sms = $sms;
    }

    public function getTemplate()
    {
        return 'sms/admin/dashboard/sms.html';
    }

    public function getData()
    {
        return [
            'balance' => $this->sms->myBalance(),
            'limit' => $this->sms->myLimit(),
        ];
    }
}
