<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Student
 *
 * @author Hatem_tito
 */

namespace AppBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Entity\Section as Section;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="student")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\StudentRepository")
 */
class Student {
    
    /**
     * @ORM\ManyToMany(targetEntity="Course", mappedBy="students")
     **/
    private $courses;
    
    /**
     * @ORM\ManyToMany(targetEntity="Section", mappedBy="students", cascade={"persist", "remove"})
     */
    private $sections;


    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 8,
     *      max = 11,
     *      minMessage = "Your ID must be at least {{ limit }} characters long",
     *      maxMessage = "Your ID cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="string" , unique=true)
     */
    protected $studentId;
    
    /**
     * @ORM\Id 
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $level;

    /**
     * @Assert\NotBlank() 
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @ORM\Column(type="text")
     */
    protected $name;
    
    public function __construct() {
        $this->courses = new \Doctrine\Common\Collections\ArrayCollection(); 
        $this->sections = new \Doctrine\Common\Collections\ArrayCollection();
         
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
     * Set level
     *
     * @param string $level
     * @return Student
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return string 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Student
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Student
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @Assert\True(message = "The password cannot match your first name")
     */
//    public function isPasswordLegal()
//    {
//        return $this->id !== $this->password;
//    }

    /**
     * Set studentId
     *
     * @param string $studentId
     * @return Student
     */
    public function setStudentId($studentId)
    {
        $this->studentId = $studentId;

        return $this;
    }

    /**
     * Get studentId
     *
     * @return string 
     */
    public function getStudentId()
    {
        return $this->studentId;
    }

    /**
     * Add courses
     *
     * @param \AppBundle\Entity\Course $courses
     * @return Student
     */
    public function addCourse(\AppBundle\Entity\Course $courses)
    {
        $this->courses[] = $courses;

        return $this;
    }

    /**
     * Remove courses
     *
     * @param \AppBundle\Entity\Course $courses
     */
    public function removeCourse(\AppBundle\Entity\Course $courses)
    {
        $this->courses->removeElement($courses);
    }

    /**
     * Get courses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCourses()
    {
        return $this->courses;
    }

    /**
     * Add sections
     *
     * @param \AppBundle\Entity\Section $sections
     * @return Student
     */
    public function addSection(Section $sections)
    {
        $this->sections[] = $sections;

        return $this;
    }
    
    public function addStudentToSection(Section $section)
    {
        $section->addStudent($this);
        $this->sections[] = $section;
    }
    
    /**
     * Remove sections
     *
     * @param \AppBundle\Entity\Section $sections
     */
    public function removeSection(Section $sections)
    {
        $this->sections->removeElement($sections);
    }
    
    public function removeSections(Section $sections)
    {   
        $sections->removeStudent($this);
        $this->sections->removeElement($sections);
    }
    
    

    /**
     * Get sections
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSections()
    {
        return $this->sections;
    }
}
