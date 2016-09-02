<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DrawController extends Controller
{
    /**
     * @Route("/draw/{category_id}/{quantity}/{quantile}", name="draw")
     */
    public function drawAction($category_id, $quantity, $quantile, Request $request)
    {
    	$category = $this->getDoctrine()->getManager()->getRepository('AppBundle:Category')->find($category_id);
    	if(!$category) {
    		throw $this->createNotFoundException("unknown category");
    	}
    	
    	$cardsByQuantile = $this->getDoctrine()->getManager()->getRepository('AppBundle:Card')->getCardsByQuantile($category);
    	
    	srand();

    	$cards = [];
    	for($i = 0; $i < $quantity; $i++) {
    		// get a random quantile centered around $quantile
    		$randomQuantile = $this->getProbabilisticInteger(0, 11, $quantile);
    		// get a random card belonging to that quantile
    		$randomIndex = mt_rand(0, count($cardsByQuantile[$randomQuantile]) - 1);
    		// remove the card from the collection to avoid duplicates
    		$removedCards = array_splice($cardsByQuantile[$randomQuantile], $randomIndex, 1);
    		// add the picked card to the result
    		$cards[] = $removedCards[0];
    	}
    	
    	dump($cards);
    	die();
    }
    
    /**
     * This function returns an integer between $min and $max, included
     * with a high probability of being $target or close to $target
     * @param integer $min
     * @param integer $max
     * @param integer $target
     * @return integer
     */
    private function getProbabilisticInteger($min, $max, $target)
    {
    	// random number between -PI/2 and PI/2
    	$rand = M_PI * ( mt_rand() / mt_getrandmax() - 1/2 );
    	
    	// passed through tangent => random between -Infinity and +Infinity, with a strong presence around 0 
    	$rand = tan($rand);
    	
    	// normalized around $target and turned into integer
    	$result = intval(round($rand + $target, 0));
    	
    	// constrained to the boundaries
    	if($result < $min || $result > $max) $result = $target;
    	
    	return $result;
    }
    
    
    
}
