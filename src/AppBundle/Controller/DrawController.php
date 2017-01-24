<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DrawController extends Controller
{
    /**
     * @Route("/draw", name="draw")
     * @Method({"GET"})
     */
    public function drawAction(Request $request)
    {
        $category_id = $request->query->get('category');
        $quantity = $request->query->get('quantity');
        $quantile = $request->query->get('quantile');
        
    	$category = $this->getDoctrine()->getManager()->getRepository('AppBundle:Category')->find($category_id);
    	if(!$category) {
    		throw $this->createNotFoundException("unknown category");
    	}
    	
    	$cardsByQuantile = $this->getDoctrine()->getManager()->getRepository('AppBundle:Card')->getCardsByQuantile($category);
    	
    	srand();

    	$data = [];
    	for($i = 0; $i < $quantity; $i++) {
    		// get a random quantile centered around $quantile
    		$randomQuantile = $this->getProbabilisticInteger(0, 11, $quantile);
    		// get a random card belonging to that quantile
    		$randomIndex = mt_rand(0, count($cardsByQuantile[$randomQuantile]) - 1);
    		// remove the card from the collection to avoid duplicates
    		$removedCards = array_splice($cardsByQuantile[$randomQuantile], $randomIndex, 1);
    		// add the picked card to the result
    		/* @var $card Card */
    		$card = $removedCards[0];
    		$data[] = [
    				'id' => $card->getId(),
    				'title' => $card->getTitle()
    		];
    	}
    	
        $response = new JsonResponse();
        $response->setData($data);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
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
