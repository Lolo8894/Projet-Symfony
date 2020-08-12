<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 *@ORM\Entity(repositoryClass="App\Repository\UtilisateursRepository")
 *@Vich\Uploadable
 *@UniqueEntity(
 *  fields={"email"},
 *  message="L'email que vous avez indiqué est déjà utilisé."
 * )
 */
class Utilisateurs implements UserInterface, \Serializable, EquatableInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;
    // Assert permet de rajouter une contrainte à l'email.


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="Votre mot de passe doit faire au minimum 8 caractères.")
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Votre mot de passe doit être identique.")
     */
    public $confirm_password;
        // L'annotation @Assert\EqualTo est relié à confirm_password car cette méthode s'assure que le mot de passe saisi dans soit identique

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $avatar;
    // nullable=true, autorise à ce que l'avatar reste vide.


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

    /**
     * @ORM\Column(type="simple_array", nullable=true)
     */
    private $roles = [];
    
    public function __construct() {
        $this->updatedAt=new \DateTime();
    }

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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function eraseCredentials() {         
        
        // TODO: Implement eraseCredentials() method.     
    }

    public function getSalt() {         
        
        return null;
    } // Pas utilisé car algorithm de cryptage mis en md5 dans security.yaml

    public function getRoles() {         
    
        return array_merge($this->roles, ['ROLE_USER']);
    } // Pour définir les rôles admin et simple utilisateur
      // Merge 2 tableaux et donc les fusionnent ensemble

    public function setRoles(?array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function serialize()
    {
        return serialize([
            'id' => $this->id,
            'username' => $this->email,
            'email' => $this->email,
            'avatar' => $this->avatar
        ]);
    }

    public function unserialize($serialized)
    {
        $data = unserialize($serialized);

        $this->id = $data['id'];
        $this->email = $data['email'];
        $this->username = $data['username'];
        $this->avatar = $data['avatar'];
    }

    public function __toString() {

        return $this->email;

    } // Méthode pour transformer un objet en chaîne de caractères

    public function isEqualTo(UserInterface $user) {

        return $this->id === $user->getId();

    } // Méthode pour transformer un objet en chaîne de caractères

}