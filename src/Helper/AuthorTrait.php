<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 28/07/2019
 * Time: 18:19
 */

namespace App\Helper;


trait AuthorTrait
{

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function setAuthor($user)
    {
        $this->author = $user;
        return $this;
    }

    public function getAuthor()
    {
        return $this->getAuthor();
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
