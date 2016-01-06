<?php
namespace PeriscopeBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\SimpleXMLElement;

class PeriscopeStartCommand extends ContainerAwareCommand
{
protected function configure()
{
$this
->setName('ps:start')
->setDescription('start phpunit tests');
}

protected function execute(InputInterface $input, OutputInterface $output)
{
    $out = shell_exec('./vendor/phpunit/phpunit/phpunit -c app --log-junit src/PeriscopeBundle/phpunit_result.xml src/');
}
}