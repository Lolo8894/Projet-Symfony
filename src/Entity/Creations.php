<?php

namespace App\Entity;
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
     * @ORM\Column(type="text")
     */
    private $image2;
  
     /**
     * @Vich\UploadableField(mapping="project_image", fileNameProperty="image")
     * @var File
     */
    private $imageFile;    
  
    /**
     * @Vich\UploadableField(mapping="project_image", fileNameProperty="image")
     * @var File
     */
    private $imageFile2;

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

    public function getImageFile()
    {
        return $this->imageFile;
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
}