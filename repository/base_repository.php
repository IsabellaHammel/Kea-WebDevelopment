<?php

class BaseRepository extends PDO
{
    protected $settings;

    
    public function __construct($dbschema)
    {
        $this->$settings = get_settings();

        $user = $this->$settings['database']['username'];
        $password = $this->settings['database']['password'];
        $db_options = get_db_options();
        $connection_string = build_pdo_connection_string();

        parent::__construct($connection_string, $user, $password, $db_options); // new PDO(...)
    }

    private function get_settings(): array 
    {
        $config_file = 'dbconfig.ini';
        $parsed_settings = parse_ini_file($config_file, TRUE);
        if (!$parsed_settings)
        {
            throw new exception('Unable to open ' . $config_file);
        }
        return $parsed_settings;
    }

    private function build_pdo_connection_string() : str
    {
        $dbtype = $this -> $settings['database']['driver'];
        $host = ':host=' . $this -> $settings['database']['host'];
        $port = (!empty($this->$settings['database']['port'])) ? (';port=' . $this->$settings['database']['port']) : '';
        $dbschema = ';dbname=' . $this->$settings['database']['schema'];

        $connection_string = $dbtype . $host . $port . $dbschema;
        return $connection_string;
    }

    private function get_db_options() : array
    {
        return array(
            
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ  // [{"id":"1","name":"A","email":"@A","password":"passA"}]
        );
    } 

}
