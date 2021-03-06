<?php

namespace KTU\GalleryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Album
 *
 * @ORM\Table(name="albums")
 * @ORM\Entity
 */
class Album
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="full_description", type="text")
     */
    private $fullDescription;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="KTU\GalleryBundle\Entity\Photo", mappedBy="albums")
     */
    private $photos;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * @ORM\ManyToOne(targetEntity="Photo")
     * @ORM\JoinColumn(name="title_photo", referencedColumnName="id")
     */
    private $titlePhoto;


    /**
     * Creates a Doctrine Collection for photos.
     */
    public function __construct()
    {
        $this->photos = new ArrayCollection();
    }

    /**
     * What is shown in a selection list
     */
    public function __toString()
    {
        return "{$this->getName()}";
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
     * Set name
     *
     * @param string $name
     * @return Album
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
     * Set fullDescription
     *
     * @param string $fullDescription
     * @return Album
     */
    public function setFullDescription($fullDescription)
    {
        $this->fullDescription = $fullDescription;
    
        return $this;
    }

    /**
     * Get fullDescription
     *
     * @return string 
     */
    public function getFullDescription()
    {
        return $this->fullDescription;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Album
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Album
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    
        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set titlePhoto
     *
     * @param integer $titlePhoto
     * @return Album
     */
    public function setTitlePhoto($titlePhoto)
    {
        $this->titlePhoto = $titlePhoto;
    
        return $this;
    }

    /**
     * Get titlePhoto
     *
     * @return integer 
     */
    public function getTitlePhoto()
    {
        return $this->titlePhoto;
    }

    /**
     * Set userId
     *
     * @param \KTU\GalleryBundle\Entity\User $userId
     * @return Album
     */
    public function setUserId(\KTU\GalleryBundle\Entity\User $userId = null)
    {
        $this->userId = $userId;
    
        return $this;
    }

    /**
     * Get userId
     *
     * @return \KTU\GalleryBundle\Entity\User
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Add photos
     *
     * @param \KTU\GalleryBundle\Entity\Photo $photos
     * @return Album
     */
    public function addPhoto(\KTU\GalleryBundle\Entity\Photo $photos)
    {
        $this->photos[] = $photos;

        return $this;
    }

    /**
     * Remove photos
     *
     * @param \KTU\GalleryBundle\Entity\Photo $photos
     */
    public function removePhoto(\KTU\GalleryBundle\Entity\Photo $photos)
    {
        $this->photos->removeElement($photos);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotos()
    {
        return $this->photos;
    }

}
