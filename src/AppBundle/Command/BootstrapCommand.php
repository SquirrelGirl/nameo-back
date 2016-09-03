<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
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
            ->setDescription('bootstraps the db')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
      $entityManager = $this->getContainer()->get('doctrine')->getManager();

      $cats = [
      		"Personnes célèbres",
      		"Oeuvres célèbres",
      		"Objets et animaux"
      ];
      
      foreach($cats as $name) {
      	$category = new Category();
      	$category->setName($name);
      	$entityManager->persist($category);
      }
      
      $entityManager->flush();
    }
}
