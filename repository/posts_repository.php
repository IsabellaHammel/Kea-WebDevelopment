<?php
require_once(__DIR__.'/base_repository.php');
require_once(__DIR__.'/posts.php'); 

class PostRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_post_by_token(string $token): ?Post
    {
        $query = $this->prepare('SELECT * FROM posts WHERE post_token = :token');
        $query->bindValue(':token', $token);
        $query->execute();
        $row = $query->fetch();

        if($row == FALSE)
        {
            return null;
        }

        $post = $this->map_row_to_posts($row);
        return $post;
    }

    public function create(Post $post): int
    {
        $sql = "INSERT INTO posts (post_user_id, post_token, post_created_on)
        VALUES ('{$post->get_post_user_id()}', '{$post->get_post_token()}', '{$post->get_post_created_on_str()}')";

        $db_response = $this->query($sql);
        $is_created = $db_response  == TRUE;
        
        if($is_created)
        {
            $created_entity = $this->get_post_by_token($post->get_post_token());
            return $created_entity->get_post_id();
        }

        throw new Exception('Unable to create post');
    }

    private function map_row_to_posts($row): Post
    {
        $created_date = date_create_from_format('Y-m-d H:i:s', $row->post_created_on);
        return new Post(
            $row->post_id,
            $row->post_user_id,
            $row->post_token,
            $created_date
        );
    }
}
