<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OthersController
 *
 * @author Hatem_tito
 */
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class OthersController extends Controller{

    /**
     * @Route("/logout",name="logout")
     */
    public function logoutAction(Request $request){
        $session = $request->getSession();
        if($session->has('stdnt_id')){
            $session->remove('stdnt_id');
        }
        return $this->redirectToRoute('Signin');
    }

    /**
    * @Route("/DeleteStudent",name="DeleteStudent")
    */
    Public function DeleteStudentAction(Request $request){
        $session = $request->getSession();
        $sectionId = print_r($_GET['secId'],true);
        $studentID = $session->get('stdnt_id');
        $em = $this->getDoctrine()->getManager();
        $em->getRepository('AppBundle:Student')->deleteStudent($sectionId,$studentID);
        return $this->redirectToRoute('HomePage');
    }

}