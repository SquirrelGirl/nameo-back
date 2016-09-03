<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *
 */
class ImportDataCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('nameo:import')
            ->setDescription('imports card data')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
      $data = file_get_contents("data/Card.json");
      $cards = json_decode($data,true);

      $entityManager = $this->getContainer()->get('doctrine')->getManager();

      foreach ($cards as $value){
        $category = $entityManager->getRepository('AppBundle:Category')->find($value['category_id']);
        if(!$category) {
          $output->writeln("Un problème !");
          dump($value);
          continue;
        }

        $card = $entityManager->getRepository('AppBundle:Card')->findOneBy([
          'title' => $value['title']
        ]);

        if(!$card) {
          $card=new \AppBundle\Entity\Card();
          $card->setTitle($value['title']);
          $card->setAttempts(0);
          $card->setSuccesses(0);
          $entityManager->persist($card);
        }

        $card->setDescription($value['description']);
        $card->setCategory($category);

        $output->writeln("Traitement réussi pour ".$card->getTitle());
      }
      $entityManager->flush();
    }
}
