<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 29/11/16
 * Time: 15:29
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
            'limit' => $this->sms->myLimit()
        ];
    }
}