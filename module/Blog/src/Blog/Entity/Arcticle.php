<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Arcticle
 *
 * @ORM\Table(name="arcticle", indexes={@ORM\Index(name="fk_arcticle_1_idx", columns={"category"})})
 * @ORM\Entity
 */
class Arcticle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=200, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="article", type="text", length=65535, nullable=false)
     */
    private $article;

    /**
     * @var string
     *
     * @ORM\Column(name="shot_aricle", type="text", length=65535, nullable=true)
     */
    private $shotAricle;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_public", type="boolean", nullable=false)
     */
    private $isPublic = '0';

    /**
     * @var \Blog\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="Blog\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category", referencedColumnName="id")
     * })
     */
    private $category;



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
     *
     * @return Arcticle
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set article
     *
     * @param string $article
     *
     * @return Arcticle
     */
    public function setArticle($article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return string
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set shotAricle
     *
     * @param string $shotAricle
     *
     * @return Arcticle
     */
    public function setShotAricle($shotAricle)
    {
        $this->shotAricle = $shotAricle;

        return $this;
    }

    /**
     * Get shotAricle
     *
     * @return string
     */
    public function getShotAricle()
    {
        return $this->shotAricle;
    }

    /**
     * Set isPublic
     *
     * @param boolean $isPublic
     *
     * @return Arcticle
     */
    public function setIsPublic($isPublic)
    {
        $this->isPublic = $isPublic;

        return $this;
    }

    /**
     * Get isPublic
     *
     * @return boolean
     */
    public function getIsPublic()
    {
        return $this->isPublic;
    }

    /**
     * Set category
     *
     * @param \Blog\Entity\Category $category
     *
     * @return Arcticle
     */
    public function setCategory(\Blog\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Blog\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
