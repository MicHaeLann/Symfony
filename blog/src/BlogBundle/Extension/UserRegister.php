<?php
namespace BlogBundle\Extension;

use BlogBundle\Entity\User;

/**
* Class Used to Generate User Register Form
*/
class UserRegister extends User
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $confirmPassword;


    /**
    * extends Parameters
    *
    */
    public function __construct()
    {
        $this->id = parent::getId();
        $this->name = parent::getName();
        $this->password = parent::getPassword();
    }

    /**
    * Get Confirm Password
    *
    * @return string
    */
    public function getConfirmPassword()
    {
    	return $this->confirmPassword;
    }

    /**
    * Set Confirm Password
    *
    * @param string $confirmPassword
    *
    * @return UserRegister
    */
    public function setConfirmPassword($confirmPassword)
    {
    	$this->confirmPassword = $confirmPassword;

    	return $this;
    }
}