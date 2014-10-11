<?php

namespace KTU\GalleryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Photo
 *
 * @ORM\Table(name="photos")
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Photo
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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="KTU\GalleryBundle\Entity\Album", inversedBy="photos")
     * @ORM\JoinTable(name="albums_photos")
     */
    private $albums;

    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var datetime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * @var string
     *
     * @ORM\Column(name="short_description", type="string", length=255)
     */
    private $shortDescription;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="photo_date", type="datetime")
     */
    private $photoDate;

    /**
     * @Assert\Image
     * @Vich\UploadableField(mapping="photo", fileNameProperty="photoUrl")
     *
     * @var File $photo
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_url", type="string", length=255)
     */
    private $photoUrl;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="KTU\GalleryBundle\Entity\Like", mappedBy="photoId")
     */
    private $likes;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="KTU\GalleryBundle\Entity\Comment", mappedBy="photoId")
     */
    private $comments;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="KTU\GalleryBundle\Entity\Tag", mappedBy="photo", cascade={"persist"})
     */
    private $tags;

    /**
     * Creates a Doctrine Collection for albums.
     */
    public function __construct()
    {
        $this->albums = new \Doctrine\Common\Collections\ArrayCollection();
        $this->likes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Photo
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
     * Add albums
     *
     * @param \KTU\GalleryBundle\Entity\Album $albums
     * @return Photo
     */
    public function addAlbum(\KTU\GalleryBundle\Entity\Album $albums)
    {
        $this->albums[] = $albums;

        return $this;
    }

    /**
     * Get albums
     *
     * @return \KTU\GalleryBundle\Entity\Album
     */
    public function getAlbums()
    {
        return $this->albums;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Photo
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
     * @return Photo
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
     * Set shortDescription
     *
     * @param string $shortDescription
     * @return Photo
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;
    
        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string 
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set photoDate
     *
     * @param \DateTime $photoDate
     * @return Photo
     */
    public function setPhotoDate($photoDate)
    {
        $this->photoDate = $photoDate;
    
        return $this;
    }

    /**
     * Get photoDate
     *
     * @return \DateTime 
     */
    public function getPhotoDate()
    {
        return $this->photoDate;
    }

    /**
     * Set userId
     *
     * @param \KTU\GalleryBundle\Entity\User $userId
     * @return Photo
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
     * @param \Symfony\Component\HttpFoundation\File\File $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\File\File
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photoUrl
     */
    public function setPhotoUrl($photoUrl)
    {
        $this->photoUrl = $photoUrl;
    }

    /**
     * @return string
     */
    public function getPhotoUrl()
    {
        return $this->photoUrl;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $likes
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $tags
     */
    public function setTags(\Doctrine\Common\Collections\Collection $tags){
        $this->tags = $tags;
        foreach ($tags as $tag){
            $tag->setPhoto($this);
        }
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param Tag $tag
     */
    public function addTags(Tag $tag)
    {
        $this->tags[] = $tag;
        $tag->setPhoto($this);
    }

    /**
     * @param Tag $tag
     */
    public function removeTags(Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

}