<?php

// Domain objects To avoid using DB rows 
class Post
{
    private ?int $_post_id;
    private int $_post_user_id;
    private DateTime $_post_created_on;
    private string $_post_content;

    public function __construct(
        ?int $post_id = null, 
        int $post_user_id,
        DateTime $post_created_on,
        string $post_content
    )
    {
        $this->_post_id = $post_id;
        $this->_post_user_id = $post_user_id;
        $this->_post_created_on = $post_created_on;
        $this->_post_content = $post_content;
    }

    public function get_post_id(): int
    {
        return $this->_post_id;
    }

    public function get_post_user_id(): int
    {
        return $this->_post_user_id;
    }

    public function get_post_created_on(): DateTime
    {
        return $this->_post_created_on;
    }

    public function get_post_created_on_str(): string
    {
        return $this->_post_created_on->format("Y-m-d H:i:s");
    }

    public function get_post_content(): string
    {
        return $this->_post_content;
    }
}