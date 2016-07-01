<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Student;
use AppBundle\Entity\Form\Type\StudentType;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PageController extends Controller
{
    /**
    * @Route("/Signin",name="Signin")
    */
    public function SigninAction(Request $request)
    {   
        $session = new Session();
        if($session->has('stdnt_id')){
            return $this->redirectToRoute('HomePage');
        }
        
        $student = new Student();
        $form = $this->createForm(StudentType::class ,$student);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $stdnt = $em->getRepository('AppBundle:Student')->findOneBy(
                array('studentId' => $student->getStudentId(), 'password' => $student->getPassword()));
            if (!$stdnt) {
                throw $this->createNotFoundException('student ID or password is wrong');
            }
            $session->set('stdnt_id', $student->getStudentID());
            $cookie_name = "USERID";
            $cookie_value = $session->get('stdnt_id');
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
            return $this->redirectToRoute('HomePage');
        }
        return $this->render('AppBundle:Pages:signin.html.twig',array('form' => $form->createView()));
    }
    
    /**
    * @Route("/",name="HomePage")
    */
    public function homeAction(Request $request)

    {
        $session = $request->getSession();
            if(!$session->has('stdnt_id')){
                return $this->redirectToRoute('Signin');
        }
            $em = $this->getDoctrine()->getEntityManager();
            $stdntId=$session->get('stdnt_id');
            $subj = $em->getRepository('AppBundle:Course')->getCourses($stdntId);
        return $this->render('AppBundle:Pages:home.html.twig', array('courses'=>$subj));
    }
    
}