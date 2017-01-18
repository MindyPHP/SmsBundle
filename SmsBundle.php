<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 29/11/16
 * Time: 15:16
 */

namespace Mindy\Bundle\SmsBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SmsBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->setParameter('sms_api_token', '');
    }
}