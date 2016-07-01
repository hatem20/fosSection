<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request as Request;
/**
 * StudentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StudentRepository extends EntityRepository
{
    public function getStudents($sec_id){
        return $this->getEntityManager()->createQuery(
        'SELECT s.studentId From AppBundle:Student s JOIN s.sections S WHERE S.id= :secId')
            ->setParameter('secId', $sec_id)
            ->getResult();
    }
    public function isAvailable($sectionId){
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT count(s.id) From AppBundle:Student s JOIN s.sections S WHERE S.id= :secId'
                )->setParameter('secId', $sectionId);
        $res = $query->getSingleScalarResult();
        return $res < 20 ? true : false;
    }
    public function addStudent($section_id,$stdntId){
        $em = $this->getEntityManager();
        $section = $em->getRepository('AppBundle:Section')->find($section_id);
        $student = $this->findOneBystudentId($stdntId);
        $student->addStudentToSection($section);
        $em->flush();
    }
    public function deleteStudent($secId,$stdId){
        $em = $this->getEntityManager();
        $section = $em->getRepository('AppBundle:Section')->find($secId);
        $student = $this->findOneBystudentId($stdId);
        $student->removeSections($section);
        $em->flush();
    }

    public function getEm() {
        return $this->getEntityManager();
    }
    
    public function addNewStudent($secId,$section,$stdId){
        //$em = $this->getEntityManager();
        //section to remove
        //if returns NULL means not enrolled in another section 
        //else returns section id that enrolled in 
        
        if ($this->isAvailable($secId)) {
            $request = new Request;
            $session = $request->getSession();
            $msg = $section != NULL ? "1":$this->addStudent($secId, $stdId) . $msg="0";
        }
        //more than 20 students enrolled
        else {
            $msg = "2";
        }
        return $msg;
    }

//    public function isAvailable($section_id,$stdntId){
//        $em = $this->getEntityManager();
//        $section = $em->getRepository('AppBundle:Student')->isClosed($section_id);
//        $student = $em->getRepository('AppBundle:Student')->findOneBystudentId($stdntId);
//        $student->addStudentToSection($section);
//        $em->flush();
//        return "successfully enrolled";
//    }
}