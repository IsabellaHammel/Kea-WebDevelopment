<?php

class School
{
    private ?int $_id;
    private string $_school_name;
    

    public function __construct(?int $id, string $school_name)
    {
        $this->_id = $id;
        $this->_school_name = $school_name;
    }
    
    public function get_id(): int
    {
        return $this->_id;
    }
    
    public function get_school_name(): string
    {
        return $this->_school_name;
    }
    

}
