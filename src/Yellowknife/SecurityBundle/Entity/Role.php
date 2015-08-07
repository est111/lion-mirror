<?php
// src/Yellowknife/SecurityBundle/Entity/Role.php
namespace Yellowknife\SecurityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;

/**
 * Role class
 *
 * @ORM\Entity()
 */
class Role implements RoleInterface
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
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255)
     */
    private $role;
	
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
	
    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="userRoles")
     */
    private $users;

    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Role
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
     * Set role
     *
     * @param string $Role
     * @return Role
     */
    public function setRole($role)
    {
		
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole()
    {
        return $this->role;
    }
    

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
	
	 	
    public function __toString()
    {
            return $this->getName();
    }
        
     

    /**
     * Add users
     *
     * @param \Yellowknife\SecurityBundle\Entity\User $users
     * @return Role
     */
    public function addUser(\Yellowknife\SecurityBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \Yellowknife\SecurityBundle\Entity\User $users
     */
    public function removeUser(\Yellowknife\SecurityBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }
}
