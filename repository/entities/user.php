<?php

// Domain objects To avoid using DB rows 
class User
{
    private ?int $_id;
    private string $_name;
    private string $_email;
    private string $_password;

    public function __construct(
        $id = null, 
        $name, 
        $email, 
        $password
    )
    {
        $this->_id = $id;
        $this->_name = $name;
        $this->_email = $email;
        $this->_password = $password;
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

    public function get_id(): int // No setter because we do not modify the id of a user, only read if from existing user
    {
        return $this->_id;
    }
}
