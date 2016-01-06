<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\SimpleXMLElement;

class DeployCommand extends ContainerAwareCommand
{
protected function configure()
{
$this
->setName('deploy')
->setDescription('deploy project on hosting by cron');
}

protected function execute(InputInterface $input, OutputInterface $output)
{
    shell_exec('git pull origin develop');
    shell_exec($this->getContainer()->getParameter('php_console') . ' app/console doctrine:schema:update --force');
    shell_exec($this->getContainer()->getParameter('php_console') . ' app/console cache:clear --env=prod');
    shell_exec($this->getContainer()->getParameter('php_console') . ' app/console ps:start');
}
}