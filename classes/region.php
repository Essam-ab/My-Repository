<?php

class Region extends database
{
    public function __construct()
    {
        //
    }

    public function getAllRegions()
    {
        $query = $this->connect()->query(
            "SELECT *
            FROM region;"
        );
        $query->execute();
        return $query;
    }
}
