<?php
require_once(__DIR__.'/repository/base_repository.php');
require_once(__DIR__.'/repository/school_repository.php');
require_once(__DIR__.'/repository/role_repository.php');



class TestRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function test()
    {
        $query = $this->prepare('SELECT u.user_id, u.user_name, s.school_name, r.role_type FROM user_relation AS ur
                                    JOIN users u ON ur.user_id = u.user_id
                                    JOIN schools s ON s.school_id = ur.school_id
                                    JOIN roles r ON r.role_id = ur.role_id');
        $query->execute();
        $user_rows = $query->fetchAll();
    }

    public function get_users()
    {
        $query = $this->prepare('SELECT * FROM users');
        $query->execute();
        $user_rows = $query->fetchAll();
    }

    public function get_user($id) /*: ?User */ 
    {
        $query = $this->prepare('SELECT * FROM users WHERE user_id = :id'); // inherited from Base/PDO
        $query->bindValue(':id', $id);
        $query->execute(); // executes query in DB
        $user_row = $query->fetch(); // retrieves single user
        
      /*   if($user_row == FALSE)
        {
            return null;
        }

        $user = $this->map_row_to_user($user_row);
        return $user; */
    }

    // TRANSACTION FUNCTION 
    public function create_user(User $user)
    {
        try {
            $this->beginTransaction();
            // Create user and retrieve id from DB
                // lastInsertId

            // Create user_relation(user_id, school_id, role_id)
            $query = $this->prepare('');
            $query->execute();
            $user_rows = $query->fetchAll();

            $this->commit();
        } catch (\Throwable $th) {
            $this->rollBack();
        }

        /* ROLLBACK */
        /* Begin a transaction, turning off autocommit */
        /* $dbh->beginTransaction(); */

        /* Change the database schema and data */
        /*  $sth = $dbh->exec("DROP TABLE fruit");
            $sth = $dbh->exec("UPDATE dessert
            SET name = 'hamburger'"); */

        /* Recognize mistake and roll back changes */
        /* $dbh->rollBack(); */

        /* Database connection is now back in autocommit mode */
    }
}



/* $repo = new RoleRepository();
$entity = $repo->get_roles();
echo $entity; */
