<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @author Vašek Boch <vasek.boch@live.com>
 * @author Jan Klat <jenik@klatys.cz>
 * @ORM\Entity
 * @UniqueEntity(fields="username", message="Tento e-mail je již registrován")
 */
class User implements UserInterface
{

	/**
	 * @var int
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=255, unique=true, name="email")
	 * @Assert\NotBlank()
	 * @Assert\Email()
	 */
	private $username;

	/**
	 * @ORM\Column(type="string", length=64)
	 */
	private $password;

	/**
	 * @Assert\NotBlank()
	 * @Assert\Length(max=4096)
	 */
	private $plainPassword;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $phone;

    /**
     * @ORM\OneToMany(targetEntity="Address", mappedBy="user")
     */
    private $addresses;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
    }

    /**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 * @return self
	 */
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * @param mixed $username
	 * @return self
	 */
	public function setUsername($username)
	{
		$this->username = $username;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @param mixed $password
	 * @return self
	 */
	public function setPassword($password)
	{
		$this->password = $password;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPlainPassword()
	{
		return $this->plainPassword;
	}

	/**
	 * @param mixed $plainPassword
	 * @return self
	 */
	public function setPlainPassword($plainPassword)
	{
		$this->plainPassword = $plainPassword;
		return $this;
	}

	public function getRoles()
	{
		return [];
	}

	public function getSalt()
	{
		return null;
	}

	public function eraseCredentials()
	{
		//nothing to do
		return;
	}


    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
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
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Add address
     *
     * @param \AppBundle\Entity\Address $address
     *
     * @return User
     */
    public function addAddress(\AppBundle\Entity\Address $address)
    {
        $this->addresses[] = $address;

        return $this;
    }

    /**
     * Remove address
     *
     * @param \AppBundle\Entity\Address $address
     */
    public function removeAddress(\AppBundle\Entity\Address $address)
    {
        $this->addresses->removeElement($address);
    }

    /**
     * Get addresses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAddresses()
    {
        return $this->addresses;
    }
}
