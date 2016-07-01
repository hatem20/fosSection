<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection As ArrayCollection;

/**
 * Section
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\SectionRepository")
 */
class Section
{   
    
    /**
     * @ORM\ManyToMany(targetEntity="Instructor", mappedBy="sections") 
     */
    private $instructors;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="sections")
     */
    private $course;
       
    /**
     * @ORM\ManyTOMany(targetEntity="Student",inversedBy="sections" ,cascade={"persist", "remove"})
     */ 
    private $students;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="day", type="string", length=255)
     */
    private $day;

    /**
     * @var string
     *
     * @ORM\Column(name="hour", type="string", length=255)
     */
    private $hour;


    
    public function __construct() {
        $this->instructors = new ArrayCollection();
        $this->students = new ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set day
     *
     * @param string $day
     * @return Section
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return string 
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set hour
     *
     * @param string $hour
     * @return Section
     */
    public function setHour($hour)
    {
        $this->hour = $hour;

        return $this;
    }

    /**
     * Get hour
     *
     * @return string 
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * Add instructors
     *
     * @param \AppBundle\Entity\Instructor $instructors
     * @return Section
     */
    public function addInstructor(\AppBundle\Entity\Instructor $instructors)
    {
        $this->instructors[] = $instructors;

        return $this;
    }

    /**
     * Remove instructors
     *
     * @param \AppBundle\Entity\Instructor $instructors
     */
    public function removeInstructor(\AppBundle\Entity\Instructor $instructors)
    {
        $this->instructors->removeElement($instructors);
    }

    /**
     * Get instructors
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInstructors()
    {
        return $this->instructors;
    }

    /**
     * Set course
     *
     * @param \AppBundle\Entity\Course $course
     * @return Section
     */
    public function setCourse(\AppBundle\Entity\Course $course = null)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course
     *
     * @return \AppBundle\Entity\Course 
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Add students
     *
     * @param \AppBundle\Entity\Student $students
     * @return Section
     */
    public function addStudent(\AppBundle\Entity\Student $students)
    {
        $this->students[] = $students;

        return $this;
    }

    /**
     * Remove students
     *
     * @param \AppBundle\Entity\Student $students
     */
    public function removeStudent(\AppBundle\Entity\Student $students)
    {
        $this->students->removeElement($students);
    }

    /**
     * Get students
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStudents()
    {
        return $this->students;
    }
    
    public function alreadyEnrolled(){
        
        
    }
}
