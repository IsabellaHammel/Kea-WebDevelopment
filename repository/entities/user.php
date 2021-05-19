<?php

// Domain objects To avoid using DB rows 
class User
{
    private ?int $_id;
    private string $_name;
    private string $_email;
    private string $_password;
    private ?int $_role_id; // foreign key
    private ?int $_school_id; // foreign key


    public function __construct(
        $id = null, 
        $name, 
        $email, 
        $password,
        $role_id,
        $school_id
    )
    {
        $this->_id = $id;
        $this->_name = $name;
        $this->_email = $email;
        $this->_password = $password;
        $this->_role_id = $role_id;
        $this->_school_id = $school_id;
    }


    public function get_id(): ?int // No setter because we do not modify the id of a user, only read if from existing user
    {
        return $this->_id;
    }

    public function get_name(): string
    {
        return $this->_name;
    }

    public function set_name(string $name)
    {
        $this->_name = $name;
    }

    public function get_email(): string
    {
        return $this->_email;
    }

    public function set_email(string $email)
    {
        $this->_email = $email;
    }

    public function get_password(): string
    {
        return $this->_password;
    }

    public function set_password(string $password)
    {
        $this->_password = $password;
    }

    public function get_role_id(): int
    {
        return $this->_role_id;
    }

    public function get_school_id(): int
    {
        return $this->_school_id;
    }    
}
