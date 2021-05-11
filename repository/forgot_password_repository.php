<?php
require_once(__DIR__.'/base_repository.php');
require_once(__DIR__.'/forgot_password.php'); 

class ForgotPasswordRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_forgot_password_by_token(string $token): ?ForgotPassword
    {
        return null; // TODO
    }

    public function create_forgot_password(ForgotPassword $forgot_password): int
    {
        $sql = "INSERT INTO forgot_password (forgotpwd_user_id, forgotpwd_token, forgotpwd_created_on)
        VALUES ('{$forgot_password->get_user_id()}', '{$forgot_password->get_token()}', '{$forgot_password->get_created_on()}')";

        $db_response = $this->query($sql);
        $is_created = $db_response  == TRUE; // try creates a user in DB and returns if created
        
        if($is_created)
        {
            $created_entity = $this->get_forgot_password_by_token($forgot_password->get_token());
            return $created_entity->get_id();
        }

        throw new Exception('Unable to create user');
    }

    private function map_row_to_forgot_password($row): ForgotPassword
    {
        $created_date = strtotime($row->forgotpwd_created_on);
        return new ForgotPassword(
            $row->forgotpwd_id,
            $row->forgotpwd_user_id,
            $row->forgotpwd_token,
            $row->$created_date,
            $row->forgotpwd_is_active
        );
    }
}
