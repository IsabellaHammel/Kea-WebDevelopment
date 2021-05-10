<?php

// Domain objects To avoid using DB rows 
class ForgotPassword
{
    private ?int $_id;
    private int $_user_id;
    private string $_token;
    private DateTime $_created_on;
    private bool $_is_active;

    public function __construct(
        ?int $id, 
        int $user_id,
        string $token,
        DateTime $created_on,
        bool $is_active
    )
    {
        $this->_id = $id;
        $this->_user_id = $user_id;
        $this->_token = $token;
        $this->_created_on = $created_on;
        $this->_is_active = $is_active;
    }

    public function get_id(): int
    {
        return $this->_id;
    }

    public function get_user_id(): int
    {
        return $this->_user_id;
    }

    public function get_token(): string
    {
        return $this->_token;
    }

    public function get_created_on(): DateTime
    {
        return $this->_created_on;
    }

    public function get_is_active(): ?bool
    {
        return $this->_is_active;
    }

    public function set_is_active(bool $is_active)
    {
        $this->_is_active = $is_active;
    }
}