<?php

namespace AppBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @UniqueEntity(fields={"email"}, message="It looks like your already have an account!")
 */
class User implements UserInterface
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @Assert\NotBlank()
   * @ORM\Column(type="string")
   */
  private $name;

  /**
   * @Assert\NotBlank()
   * @Assert\Email()
   * @ORM\Column(type="string", unique=true)
   */
  private $email;

  /**
   * @ORM\Column(type="string")
   */
  private $password;

  /**
   * A non-persisted field that's used to create the encoded password.
   *
   * @Assert\NotBlank(groups={"Registration"})
   * @var string
   */
  private $plainPassword;

  /**
   * @ORM\Column(type="json_array")
   */
  private $roles = [];

  public function getId()
  {
    return $this->id;
  }

  public function getUsername()
  {
    return $this->email;
  }

  public function getRoles()
  {
    // Statically give everyone ROLE_USER
    // return ['ROLE_USER'];

    // Make sure everyone is (at least) ROLE_USER
    $roles = $this->roles;
    if (!in_array('ROLE_USER', $roles)) {
      $roles[] = 'ROLE_USER';
    }
    return $roles;
  }

  public function setRoles(array $roles)
  {
    $this->roles = $roles;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function getSalt()
  {
  }

  public function eraseCredentials()
  {
    $this->plainPassword = null;
  }

  public function setUsername($email)
  {
    $this->email = $email;
  }

  public function setPassword($password)
  {
    $this->password = $password;
  }

  public function getPlainPassword()
  {
    return $this->plainPassword;
  }

  public function setPlainPassword($plainPassword)
  {
    $this->plainPassword = $plainPassword;
    // forces the object to look "dirty" to Doctrine. Avoids
    // Doctrine *not* saving this entity, if only plainPassword changes
    $this->password = null;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  public function setEmail($email)
  {
      $this->email = $email;
  }

  public function getEmail()
  {
      return $this->email;
  }
}