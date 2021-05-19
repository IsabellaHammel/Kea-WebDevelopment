<?php
require_once(__DIR__.'/../repository/school_repository.php');
require_once(__DIR__.'/../services/cache_service.php');


function get_all_schools()
{
    try{
        $cache_key = 'get_all_schools_reponse';
        $cache = new CacheService();
        $school_repository = new SchoolRepository();
        
        $jsonResponse = $cache->getCachedValue($cache_key);
        if($jsonResponse != null)
        {
            header("Content-type:application/json");
            echo $jsonResponse;
            exit();
        }

        $schools = $school_repository->get_schools(); // this returns domain obj
        $schools_to_return = array(); // array of dicts
        foreach($schools as $school)
        {
            $school_to_return = array(
                "school_id" => $school->get_id(),
                "school_name" => $school->get_school_name(),
            );
            array_push($schools_to_return, $school_to_return);
        }

        $response = array(
            "schools" => $schools_to_return 
        ); 

        $jsonResponse = json_encode($response);
        $cache->setCacheValue($cache_key, $jsonResponse);

        header("Content-type:application/json");
        echo $jsonResponse;
    }
    catch(Exception $e)
    {
        http_response_code(500);
    }
}