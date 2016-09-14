<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Entity\AbstractEntity;

/**
 * artical
 *
 * @ORM\Table(name="artical")
 * @ORM\Entity
 */
class Artical extends AbstractEntity
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="user", type="integer", nullable=true)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=50, nullable=false)
     */
    private $title;
    
    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=50, nullable=false)
     */
    private $text;

    /**
     * Set the id
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * Set title
     *
     * @param string $title
     * @return title
     */
    public function settitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function gettitle()
    {
        return $this->title;
    }
    
    /**
     * Set text
     *
     * @param string $text
     * @return text
     */
    public function settext($text)
    {
    	$this->text = $text;
    
    	return $this;
    }
    
    /**
     * Get text
     *
     * @return string
     */
    public function gettext()
    {
    	return $this->text;
    }

    public function getUser()
    {
    	return $this->user;
    }
    
    public function setUser(\Application\Entity\User $user)
    {
    	$this->user = $user;
    }
}
