<?php
require_once(__DIR__.'/base_repository.php');
require_once(__DIR__.'/posts.php'); 

class PostRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_post(string $post_id): ?Post
    {
        $query = $this->prepare('SELECT * FROM posts WHERE post_id = :post_id');
        $query->bindValue(':post_id', $post_id);
        $query->execute();
        $row = $query->fetch();
        
        if($row == false)
        {
            return null;
        }

        $post = $this->map_row_to_posts($row);
        return $post;
    }


    public function get_posts_by_user_id(string $user_id): array
    {
        $query = $this->prepare('SELECT * FROM posts WHERE post_user_id = :user_id');
        $query->bindValue(':user_id', $user_id);
        $query->execute();
        $rows = $query->fetchAll();

        $posts = array();

        foreach($rows as $row){
            $post = $this->map_row_to_posts($row);
            array_push($posts, $post);
        }
        return $posts;
    }

    public function create(Post $post): int
    {
        $sql = "INSERT INTO posts (post_user_id, post_created_on, post_content)
        VALUES ('{$post->get_post_user_id()}', '{$post->get_post_created_on_str()}', '{$post->get_post_content()}')";

        $db_response = $this->query($sql);
        $is_created = $db_response  == TRUE;

        if($is_created)
        {
            return $this->lastInsertId();
        }

        throw new Exception('Unable to create post');
    }

    public function delete($post_id)
    {
        $query = $this->prepare("DELETE FROM posts WHERE post_id = :post_id");
        $query->bindValue(':post_id', $post_id);
        $query->execute();
    }

    private function map_row_to_posts($row): Post
    {
        $created_date = date_create_from_format('Y-m-d H:i:s', $row->post_created_on);
        return new Post(
            $row->post_id,
            $row->post_user_id,
            $created_date,
            $row->post_content
        );
    }
}
