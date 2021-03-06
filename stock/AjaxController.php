<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AjaxController
 *
 * @author Hatem_tito
 */

namespace Blogger\sectionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request as Request;

class AjaxController extends Controller{
    
    function addCourseAction(){        
        $course_code=filter_input(INPUT_POST, 'code');
        $em = $this->getDoctrine()->getManager();
        $sections = $em->getRepository('BloggersectionBundle:Section')->getSections($course_code);
        return new Response(json_encode($sections));
    }
    
    function getSectionsAction(){
        $ids = $_POST['section'];
        $em = $this->getDoctrine()->getManager();
        $result = array();
        foreach ($ids as $section_id){
            $students = $em->getRepository('BloggersectionBundle:Student')->getStudents($section_id);
            array_push($result, $students);
        }
        $res = print_r(json_encode($result),true);
        return new Response($res);
    }
    
    Public function EnrollStudentAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $stdntId = $session->get('stdnt_id');
        $section_id = $_POST['sectionid'];
        
        $course = $em->getRepository('BloggersectionBundle:Course')->getCourseBysecId($section_id);
        $course_id = $course->getId();
        $section = $em->getRepository('BloggersectionBundle:Section')->getSectionsByCourseId($course_id,$stdntId);
        
        if(isset($_POST['granted'])){
            $em->getRepository('BloggersectionBundle:Student')->deleteStudent($section->getId(),$stdntId);
            $em->getRepository('BloggersectionBundle:Student')->addStudent($section_id, $stdntId);
            return new Response("deleted and added");
        }
        else{
            $msg = $em->getRepository('BloggersectionBundle:Student')->addNewStudent($section_id,$section,$stdntId);
            return new Response($msg);
        }
    }
}
