<?php
require_once(__DIR__.'/base_repository.php');
require_once(__DIR__.'/entities/user.php');

class UserRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_users(): array 
    {
        $query = $this->prepare('SELECT * FROM users');
        $query->execute();
        $user_rows = $query->fetchAll();

        //Convert user-rows to users
        $users = array();
        
        foreach ($user_rows as $user_row){
            $user = $this->map_row_to_user($user_row);
            array_push($users, $user);
        }
        return $users;
    }

    public function get_user($id): ?User // returns some user obj
    {
        $query = $this->prepare('SELECT * FROM users WHERE user_id = :id'); // inherited from Base/PDO
        $query->bindValue(':id', $id);
        $query->execute(); // executes query in DB
        $user_row = $query->fetch(); // retrieves single user
        
        if($user_row == FALSE)
        {
            return null;
        }

        $user = $this->map_row_to_user($user_row);
        return $user;
    }

    public function get_user_by_email(string $email): ?User // returns some user obj
    {
        $query = $this->prepare('SELECT * FROM users WHERE user_email = :email');
        $query->bindValue(':email', $email);
        $query->execute();
        $user_row = $query->fetch();
        
        if($user_row == FALSE)
        {
            return null;
        }

        $user = $this->map_row_to_user($user_row);
        return $user;
    }

    public function update_user(User $user)
    {
        $sql_command = 'UPDATE users ';
        $sql_condition = " WHERE user_id = {$user->get_id()}";

        // Builds SET column1=value, column2=value2,...
        $sql_set = 'SET '; // split set up to avoid overriding values with null in DB if value is not provided
        $sql_set = $this->add_query_set($sql_set,  'user_email', $user->get_email());
        $sql_set = $this->add_query_set($sql_set,  'user_password', $user->get_password(), is_last: true);

        $sql_query = $sql_command . $sql_set . $sql_condition;
        $this->query($sql_query);
    }

    public function create_user(User $user): int // returns user 
    {
        return 0;
        // $sql = "INSERT INTO users (user_email, user_password)
        // VALUES ('{$user->get_email()}', '{$user->get_password()}')";

        // $db_response = $this->query($sql);
        // $is_created = $db_response  == TRUE; // try creates a user in DB and returns if created
        
        // if($is_created)
        // {
        //     $created_user = $this->get_user_by_email($user->get_email());
        //     return $created_user->get_id();
        // }

        // throw new Exception('Unable to create user');
    }

    private function add_query_set(string $set_query, string $column, $value, bool $is_last = false): string
    {        
        if($value === '' || $value === null)
        {
            return $set_query;
        }
        if(gettype($value) === 'boolean')
        {
            $value = $value ? 1 : 0;
        }

        $seperator = $is_last ? '' : ',';
        return $set_query . "{$column}=\"{$value}\"{$seperator}"; // TODO CHECK IF LAST COMMA BREAKS
    }

    private function map_row_to_user($row): User
    {
        return new User(
            $row->user_id,
            $row->user_name,
            $row->user_email,
            $row->user_password
        );
    }
    

}