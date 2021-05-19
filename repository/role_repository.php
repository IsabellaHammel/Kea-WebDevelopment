<?php
require_once(__DIR__.'/base_repository.php');
require_once(__DIR__.'/entities/role.php');

class RoleRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_role(int $id): ?Role
    {
        $query = $this->prepare('SELECT * FROM roles WHERE role_id = :id'); // inherited from Base/PDO
        $query->bindValue(':id', $id);
        $query->execute(); // executes query in DB
        $role_row = $query->fetch(); // retrieves single user
        
        if($role_row == FALSE)
        {
            return null;
        }

        $role = $this->map_row_to_role($role_row);
        return $role;
    }

    public function get_roles(): ?array
    {
        $query = $this->prepare('SELECT * FROM roles');
        $query->execute();
        $rows = $query->fetchAll();

        $roles = array();
        
        foreach ($rows as $row){
            $role = $this->map_row_to_role($row);
            array_push($roles, $role);
        }
        return $roles;
    }

    private function map_row_to_role($row): Role
    {
        return new Role(
            $row->role_id,
            $row->role_type
        );
    }
}