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
            ->setName('nameo:bootstrap')
            ->setDescription('initialise la base et autres')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
      $entityManager = $this->getContainer()->get('doctrine')->getManager();

      $cats = [
      		1 => "Personnes célèbres",
      		2 => "Oeuvres célèbres",
      		3 => "Objets et animaux"
      ];
      
      foreach($cats as $index => $name) {
      	$category = new Category();
      	$category->setName($name);
      	$entityManager->persist($category);
      }
      
      $entityManager->flush();
    }
}
