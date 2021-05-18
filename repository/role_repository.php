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
        return null;
    }

    public function get_roles(): ?array
    {
        return null;
    }
}