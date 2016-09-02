<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Entity\Category;

/**
 *
 */
class BootstrapCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('nameo:quantiles')
            ->setDescription('computes quantiles')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
      $this->getContainer()->get('doctrine')->getConnection()->executeQuery("UPDATE CARD SET QUANTILE=FLOOR(RAND()*12)");
    }
}
