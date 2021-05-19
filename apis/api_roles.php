<?php
require_once(__DIR__.'/../repository/role_repository.php');
require_once(__DIR__.'/../services/cache_service.php');

function get_all_roles()
{
    try{
        $cache_key = 'get_all_roles_response';
        $cache_roles = new CacheService();
        $role_repository = new RoleRepository();

        $cached = $cache_roles->getCachedValue($cache_key);
        if($cached != null)
        {
            header("Content-type:application/json");
            echo $cached;
            exit();
        }

        $roles = $role_repository->get_roles(); // this returns domain obj
        
        $roles_to_return = array(); // array of dicts
        foreach($roles as $role)
        {
            $role_to_return = array(
                "role_id" => $role->get_id(),
                "role_type" => $role->get_role_type(),
            );
            array_push($roles_to_return, $role_to_return);
        }

        $response = array(
            "roles" => $roles_to_return 
        ); 
        
        $jsonResponse = json_encode($response);
        $cache_roles->setCacheValue($cache_key, $jsonResponse); 

        header("Content-type:application/json");
        echo $jsonResponse;
    }
    catch(Exception $e)
    {
        http_response_code(500);
    }
}