<?php

namespace App\Entity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *@ORM\Entity(repositoryClass="App\Repository\UtilisateursRepository")
 *@Vich\Uploadable
 */
class Utilisateurs
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="Votre mot de passe doit faire au minimum 8 caractères.")
     */
    private $motdepasse;

    /**
     * @Assert\EqualTo(propertyPath="motdepasse", message="Votre mot de passe doit être identique.")
     */
    public $confirm_motdepasse;
        // L'annotation @Assert\EqualTo est relié à confirm_motdepasse car cette méthode s'assure que le mot de passe saisi dans
        // mot de passe soit identique à la confirmation de celui-ci.
    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $avatar;

    /**
     * @Vich\UploadableField(mapping="project_image", fileNameProperty="avatar")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;
  
    public function getId(): ?int
    {
        return $this->id;
    }
  
    public function setImageFile(File $avatar = null)
    {
        $this->imageFile = $avatar;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($avatar) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getMotdepasse(): ?string
    {
        return $this->motdepasse;
    }

    public function setMotdepasse(string $motdepasse): self
    {
        $this->motdepasse = $motdepasse;

        return $this;
    }
}