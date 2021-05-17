<?php
require_once(__DIR__.'/base_repository.php');
require_once(__DIR__.'/forgot_password.php'); 

class ForgotPasswordRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_by_token(string $token): ?ForgotPassword
    {
        $query = $this->prepare('SELECT * FROM forgot_password WHERE forgotpwd_token = :token');
        $query->bindValue(':token', $token);
        $query->execute();
        $row = $query->fetch();

        if($row == FALSE)
        {
            return null;
        }

        $forgot_password = $this->map_row_to_forgot_password($row);
        return $forgot_password;
    }

    public function create(ForgotPassword $forgot_password): int
    {
        $sql = "INSERT INTO forgot_password (forgotpwd_user_id, forgotpwd_token, forgotpwd_created_on)
        VALUES ('{$forgot_password->get_user_id()}', '{$forgot_password->get_token()}', '{$forgot_password->get_created_on_str()}')";

        $db_response = $this->query($sql);
        $is_created = $db_response  == TRUE;
        
        if($is_created)
        {
            $created_entity = $this->get_by_token($forgot_password->get_token());
            return $created_entity->get_id();
        }

        throw new Exception('Unable to create user');
    }

    public function update(ForgotPassword $forgot_password)
    {
        $sql_command = 'UPDATE forgot_password ';
        $sql_condition = " WHERE forgotpwd_id = {$forgot_password->get_id()}";

        // Builds SET column1=value, column2=value2,...
        $sql_set = 'SET '; // split set up to avoid overriding values with null in DB if value is not provided
        $sql_set = $this->add_query_set($sql_set,  'forgotpwd_user_id', $forgot_password->get_user_id());
        $sql_set = $this->add_query_set($sql_set,  'forgotpwd_token', $forgot_password->get_token());
        $sql_set = $this->add_query_set($sql_set,  'forgotpwd_is_active', $forgot_password->get_is_active(), is_last: true);

        
        $sql_query = $sql_command . $sql_set . $sql_condition;
        $this->query($sql_query);
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

    private function map_row_to_forgot_password($row): ForgotPassword
    {
        $created_date = date_create_from_format('Y-m-d H:i:s', $row->forgotpwd_created_on, new DateTimeZone('UTC'));
        return new ForgotPassword(
            $row->forgotpwd_id,
            $row->forgotpwd_user_id,
            $row->forgotpwd_token,
            $created_date,
            $row->forgotpwd_is_active
        );
    }
    
}
