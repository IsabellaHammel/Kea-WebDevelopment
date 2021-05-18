<?php
require_once(__DIR__.'/base_repository.php');
require_once(__DIR__.'/entities/school.php');

class SchoolRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_school(int $id): ?School
    {
        $query = $this->prepare('SELECT * FROM schools WHERE school_id = :id'); // inherited from Base/PDO
        $query->bindValue(':id', $id);
        $query->execute(); // executes query in DB
        $school_row = $query->fetch(); // retrieves single user
        
        if($school_row == FALSE)
        {
            return null;
        }

        $school = $this->map_row_to_school($school_row);
        return $school;
    }

    public function get_schools(): ?array
    {
        $query = $this->prepare('SELECT * FROM schools');
        $query->execute();
        $rows = $query->fetchAll();

        $schools = array();
        
        foreach ($rows as $row){
            $school = $this->map_row_to_school($row);
            array_push($schools, $school);
        }
        return $schools;
    }

    /* public function get_school_attendees(int $id): ?array
    {
        $query = $this->prepare('SELECT * FROM schools WHERE school_id = :id');
        $query->bindValue(':id', $id);
        $query->execute();
        $school_row = $query->fetch();
        
        if($school_row == FALSE)
        {
            return null;
        }

        $school = $this->map_row_to_school($school_row);
        return $school;
    } */

    private function map_row_to_school($row): School
    {
        return new School(
            $row->school_id,
            $row->school_name
        );
    }
}