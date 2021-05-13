<?php

// Domain objects To avoid using DB rows 
class User
{
    private ?int $_id;
    private string $_firstname;
    private string $_lastname;
    private DateTime $_age;
    private string $_phone;
    private string $_email;
    private string $_password;
    private ?bool $_is_active; // ? means nullable thus is active can be true, false or null
    private bool $_is_verified;
    private string $_verify_token;
    private bool $_is_admin;
    private string $_profile_image;

    public function __construct(
        $id = null, 
        $firstname, 
        $lastname, 
        $age, 
        $phone, 
        $email, 
        $password, 
        $is_active = null,
        $is_verified = false,
        $verify_token,
        $is_admin = false,
        $profile_image
    )
    {
        $this->_id = $id;
        $this->_firstname = $firstname;
        $this->_lastname = $lastname;
        $this->_age = $age;
        $this->_phone = $phone;
        $this->_email = $email;
        $this->_password = $password;
        $this->_is_active = $is_active;
        $this->_is_verified = $is_verified;
        $this->_verify_token = $verify_token;
        $this->_is_admin = $is_admin;
        $this->_profile_image = $profile_image;
    }

    public function get_firstname(): string
    {
        return $this->_firstname;
    }

    public function set_firstname(string $firstname)
    {
        $this->_firstname = $firstname;
    }

    public function get_lastname(): string
    {
        return $this->_lastname;
    }

    public function set_lastname(string $lastname)
    {
        $this->_lastname = $lastname;
    }

    public function get_fullname(): string
    {
        return $this->_firstname . ' ' . $this->_lastname;
    }

    public function get_age(): DateTime
    {
        return $this->_age;
    }

    public function get_age_str(): string
    {
        return $this->_age->format("Y-m-d");
    }


    public function set_age(DateTime  $age)
    {
        $this->_age = $age;
    }
    
    public function get_phone(): string
    {
        return $this->_phone;
    }

    public function set_phone(string $phone)
    {
        $this->_phone = $phone;
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

    public function get_is_active(): ?bool
    {
        return $this->_is_active;
    }

    public function set_is_active(bool $is_active)
    {
        $this->_is_active = $is_active;
    }

    public function get_is_verified(): bool
    {
        return $this->_is_verified;
    }

    public function set_is_verified(bool $is_verified)
    {
        $this->_is_verified = $is_verified;
    }

    public function get_verify_token(): string
    {
        return $this->_verify_token;
    }

    public function set_verify_token(string $verify_token)
    {
        $this->_verify_token = $verify_token;
    }

    public function get_is_admin(): bool
    {
        return $this->_is_admin;
    }

    public function set_is_admin(bool $is_admin)
    {
        $this->_is_admin = $is_admin;
    }

    public function get_profile_image(): string
    {
        return $this->_profile_image;
    }

    public function set_profile_image(string $profile_image)
    {
        $this->_profile_image = $profile_image;
    }


}
