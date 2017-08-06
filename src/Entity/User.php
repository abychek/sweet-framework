<?php
/**
 * Created by PhpStorm.
 * User: marina
 * Date: 06.08.17
 * Time: 13:43
 */

namespace SweetFramework\Entity;

/**
 * @Entity(repositoryClass="SweetFramework\Repository\UserRepository") @Table(name="users")
 **/class User
{

    /** @Id @Column(type="integer") @GeneratedValue * */
    protected $id;

    /** @Column(type="string") * */
    protected $firstName;

    /** @Column(type="string") * */
    protected $lastName;

    /** @Column(type="string") * */
    protected $email;

    /** @Column(type="string") * */
    protected $password;

    /** @Column(type="string") * */
    protected $hash;

    /**
     * @return $hash
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param $hash
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    }



    /**
     * @return $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return $lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return $firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return $password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}