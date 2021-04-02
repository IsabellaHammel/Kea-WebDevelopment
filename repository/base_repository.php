<?php

class BaseRepository extends PDO
{
    protected array $settings;
    
    public function __construct()
    {
        $this->settings = $this->get_settings();
        
        $user = $this->settings['database']['username'];
        $password = $this->settings['database']['password'];
        $db_options = $this->get_db_options();
        $connection_string = $this->build_pdo_connection_string();

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

    private function build_pdo_connection_string() : string
    {
        $dbtype = self::$settings['database']['driver'];
        $host = ':host=' . self::$settings['database']['host'];
        $port = (!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '';
        $dbschema = ';dbname=' . self::$settings['database']['schema'];

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
