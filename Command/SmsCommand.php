<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 29/11/2016
 * Time: 20:55
 */

namespace Mindy\Bundle\SmsBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

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

            /** @var \Mindy\Bundle\SmsBundle\Model\Sms $sms */
            if (false == $debug) {
                $sms->smsSend($smsApi);
                $logger->info($logMessage);
            } else {
                $output->writeln($logMessage);
            }
        }
    }

}