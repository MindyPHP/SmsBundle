<?php

declare(strict_types=1);

/*
 * This file is part of Mindy Framework.
 * (c) 2017 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\SmsBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Zelenin\SmsRu\Entity\Sms;

class SmsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('sms:send_spool')
            ->setDescription('Send sms messages from spool')
            ->addOption('debug', 'd', InputOption::VALUE_OPTIONAL, '', false);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();

        $logger = $container->get('logger');
        $smsApi = $container->get('sms');
        $spool = $container->get('sms_spool');

        $debug = $input->getOption('debug');

        foreach ($spool->getMessages() as $sms) {
            $logMessage = sprintf("Send '%s' to '%s'", $sms->text, $sms->to);

            /* @var \Mindy\Bundle\SmsBundle\Model\Sms $sms */
            $message = new Sms($sms->to, $sms->text);
            $message->test = $debug;
            $message->translit = false;
            $message->partner_id = $container->getParameter('sms_partner_id');

            $smsApi->smsSend($message);

            $logger->info($logMessage);
        }
    }
}
