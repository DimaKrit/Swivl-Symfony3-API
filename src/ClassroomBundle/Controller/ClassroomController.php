<?php

namespace ClassroomBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use ClassroomBundle\Entity\Classroom;

class ClassroomController extends FOSRestController
{
     /**
     * @Rest\Get("/classroom")
     */
     public function getAction()
     {
     	
     	$restresult = $this->getDoctrine()->getRepository('ClassroomBundle:Classroom')->findAll();

     	if ($restresult === null) {
     		return new View("there are no classroom exist", Response::HTTP_NOT_FOUND);
     	}
     	return $restresult;
     }

    /**
	 * @Rest\Get("/classroom/{id}")
	 */
    public function idAction($id)
    {
    	$singleresult = $this->getDoctrine()->getRepository('ClassroomBundle:Classroom')->find($id);

    	if ($singleresult === null) {
    		return new View("classroom not found", Response::HTTP_NOT_FOUND);
    	}

    	return $singleresult;
    }

  	/**
	 * @Rest\Post("/classroom/")
	 */
  	public function postAction(Request $request)
  	{
  		$data = new Classroom;
  		$name = $request->get('name');
  		$date = $request->get('date');
  		$status = $request->get('status');
  		if(empty($name) || empty($status) || empty($date))
  		{
  			return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE); 
  		} 
  		$data->setName($name);
  		$data->setDate(new \DateTime($date));
  		$data->setStatus($status);
  		$em = $this->getDoctrine()->getManager();
  		$em->persist($data);
  		$em->flush();
  		return new View("Classroom Added Successfully", Response::HTTP_OK);
  	}

   	/**
	 * @Rest\Put("/classroom/{id}/")
	 */
   	public function updateAction($id,Request $request)
   	{ 
   		$data = new Classroom;
   		$name = $request->get('name');
   		$date = $request->get('date');
   		$status = $request->get('status');
   		$sn = $this->getDoctrine()->getManager();
   		$classroom = $this->getDoctrine()->getRepository('ClassroomBundle:Classroom')->find($id);
   		if (empty($classroom)) {
   			return new View("Classroom not found", Response::HTTP_NOT_FOUND);
   		} else{
   			if(!empty($name)){
   				$classroom->setName($name);
   			}
   			if(!empty($date)){
   				$classroom->setDate(new \DateTime($date));
   			}

   			if(!empty($status)){
   				$data->setStatus($status);
   			}

   			$sn->flush();

   			return new View("Classroom Updated Successfully", Response::HTTP_OK);
   		}
   	}

	  /**
	 * @Rest\Delete("/classroom/{id}")
	 */
	  public function deleteAction($id)
	  {
	  	$data = new Classroom;
	  	$sn = $this->getDoctrine()->getManager();
	  	$classroom = $this->getDoctrine()->getRepository('ClassroomBundle:Classroom')->find($id);
	  	if (empty($classroom)) {
	  		return new View("Classroom not found", Response::HTTP_NOT_FOUND);
	  	}
	  	else {
	  		$sn->remove($classroom);
	  		$sn->flush();
	  	}
	  	return new View("deleted successfully", Response::HTTP_OK);
	  }  
	}
