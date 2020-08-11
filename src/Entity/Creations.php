<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CreationsRepository")
 *@Vich\Uploadable
 */
class Creations
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
  
   /**
     * @ORM\Column(type="string")
     */
    private $titre;
  
     /**
     * @ORM\Column(type="text")
     */
    private $description;
  
    /**
     * @ORM\Column(type="text")
     */
    private $image; 
  
    /**
     * @ORM\Column(type="text", options={"default" : NULL})
     */
    private $image2 = null;
  
    /**
     * @ORM\Column(type="text", options={"default" : NULL})
     */
    private $image3 = null;
  
    /**
     * @ORM\Column(type="text", options={"default" : NULL})
     */
    private $image4 = null;
  
     /**
     * @Vich\UploadableField(mapping="project_image", fileNameProperty="image")
     * @var File
     */
    private $imageFile;    
  
    /**
     * @Vich\UploadableField(mapping="project_image", fileNameProperty="image2")
     * @var File
     */
    private $imageFile2;
  
     /**
     * @Vich\UploadableField(mapping="project_image", fileNameProperty="image3")
     * @var File
     */
    private $imageFile3;
  
     /**
     * @Vich\UploadableField(mapping="project_image", fileNameProperty="image4")
     * @var File
     */
    private $imageFile4;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;
  
     /**
     * @var bool
     *
     * @ORM\Column(type="boolean", options={"default" : false})
     */
    private $miseEnAvant = false;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="creation", orphanRemoval=true)
     */
    private $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }
  /**
     * Get the value of active
     *
     * @return  bool
     */ 
    public function getMiseEnAvant()
    {
        return $this->miseEnAvant;
    }

    /**
     * Set the value of active
     *
     * @param  bool  $active
     *
     * @return  self
     */ 
    public function setMiseEnAvant(bool $miseEnAvant)
    {
        $this->miseEnAvant = $miseEnAvant;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
  
    public function getImageFile()
    {
        return $this->imageFile;
    }
  
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile2()
    {
        return $this->imageFile2;
    }
  
    public function setImageFile2(File $image2 = null)
    {
        $this->imageFile2 = $image2;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image2) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }
  
    public function getImageFile3()
    {
        return $this->imageFile3;
    }
  
    public function setImageFile3(File $image3 = null)
    {
        $this->imageFile3 = $image3;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image3) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }
  
    public function getImageFile4()
    {
        return $this->imageFile4;
    }
  
    public function setImageFile4(File $image4 = null)
    {
        $this->imageFile4 = $image4;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image4) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }
  
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }
  
    public function getDescription()
    {
        return $this->description;
    }
  
    public function setDescription($description)
    {
        $this->description = $description;
    }
  
    public function getImage()
    {
        return $this->image;
    }
  
    public function setImage($image)
    {
        $this->image = $image;
    }
  
    public function getImage2()
    {
        return $this->image2;
    }
  
    public function setImage2($image2)
    {
        $this->image2 = $image2;
    }
  
    public function getImage3()
    {
        return $this->image3;
    }
  
    public function setImage3($image3)
    {
        $this->image3 = $image3;
    }
  
    public function getImage4()
    {
        return $this->image4;
    }
  
    public function setImage4($image4)
    {
        $this->image4 = $image4;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setCreation($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getCreation() === $this) {
                $comment->setCreation(null);
            }
        }

        return $this;
    }
}