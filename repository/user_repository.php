<?php
require_once(__DIR__.'/repository/base_repository.php');

class UserRepository extends BaseRepository
{
    private const TABLENAME = 'users';
    public function __construct()
    {
        parent::__construct();
    }

    private function get_users(): array // user
    {
        throw new exception('Not implemented');
    }

    private function get_user($id) // returns some user obj
    {
        throw new exception('Not implemented');
    }

    private function get_user_by_email($email) // returns some user obj
    {
        throw new exception('Not implemented');
    }

    private function update_user($user)
    {
        throw new exception('Not implemented');
    }

    private function create_user($user): int // returns user 
    {
        throw new exception('Not implemented');
    }
    

}