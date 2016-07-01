<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * SectionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SectionRepository extends EntityRepository
{
    public function getSections($course_code){
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT s.day,s.hour,s.id FROM AppBundle:Section s JOIN s.course c WHERE c.code = :code')
                    ->setParameter('code', $course_code);
        return $query->getResult();
    }
    
    public function getSectionsByCourseId($course_Id,$stdntId){
        $em = $this->getEntityManager();
        $qb = $em->createQuery(
        'SELECT s FROM AppBundle:Section s JOIN s.course c JOIN s.students std WHERE c.id = ?1 AND std.studentId = ?3')
            ->setParameters([1 => $course_Id  , 3 => $stdntId ]);
        return $qb->getOneOrNullResult();
    }
}