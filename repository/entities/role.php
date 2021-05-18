<?php

class Role
{
    private ?int $_id;
    private string $_role_type;

    public function __construct(?int $id = null, string $role_type)
    {
        $this->_id = $id;
        $this->_role_type = $role_type;
    }
    
    public function get_id(): int
    {
        return $this->_id;
    }

    public function get_role_type(): string
    {
        return $this->_role_type;
    }
}
