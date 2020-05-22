<?php
class Stand extends database
{
    public function __construct()
    {
        //
    }


    public function getStandAudio($id)
    {
        $query = $this->connect()->prepare(
            "SELECT sta_audio
            FROM stand
            WHERE sta_id = ?;"
        );
        $query->execute([$id]);
        return $query;
    }

    public function getUserStatus($user_id, $stand_id, $status)
    {
        $query = $this->connect()->prepare(
            "SELECT *
            FROM user_stand
            WHERE use_id = ? and sta_id = ? and user_logged = ?"
        );
        $query->execute([$user_id, $stand_id, $status]);
        return $query;
    }


    public function getNbStands()
    {
        $query = $this->connect()->prepare(
            "SELECT count(*) 'stand_nb'
            FROM stand;"
        );
        $query->execute();
        return $query;
    }

    public function getStand($id)
    {
        $query = $this->connect()->prepare(
            "SELECT *
            FROM stand
            WHERE sta_id = ?;"
        );
        $query->execute([$id]);
        return $query;
    }

    public function getAllStand()
    {
        $query = $this->connect()->prepare(
            "SELECT *
            FROM stand
            WHERE sta_id != ?"
        );
        $query->execute([1]);
        return $query;
    }
    public function updateStand($art_lib, $art_desc, $art_brefDesc, $art_ref, $isActive, $art_id)
    {
        $query = $this->connect()->prepare(
            "UPDATE stand
            SET art_lib = ?, art_desc = ?, art_brefDesc = ?, art_ref = ?, art_active = ?
            WHERE art_id = ?;"
        );
        $query->execute([$art_lib, $art_desc, $art_brefDesc, $art_ref, $isActive, $art_id]);
        return $query;
    }

    public function addStand(
        $sta_name,
        $sta_desc,
        $sta_image,
        $sta_logo
    ) {
        $query = $this->connect()->prepare(
            "INSERT INTO stand
            (sta_nom,sta_description,sta_image,sta_logo) 
            VALUES (?,?,?,?);"
        );

        $query->execute([
            $sta_name, $sta_desc, $sta_image, $sta_logo
        ]);
        return $query;
    }

    public function getStandName($stand_id)
    {
        $query = $this->connect()->prepare(
            "SELECT sta_nom
            FROM stand
            WHERE sta_id = ?;"
        );
        $query->execute([$stand_id]);
        return $query;
    }

    //links between stand + its documentation + its videotheque = video_library
    public function getAllStandDocumentation($stand_id)
    {
        $query = $this->connect()->prepare(
            "SELECT * 
            FROM stand_documentation
            WHERE sta_id = ?;"
        );
        $query->execute([$stand_id]);
        return $query;
    }

    public function getAllStandVideos($stand_id)
    {
        $query = $this->connect()->prepare(
            "SELECT * 
            FROM videotheque
            WHERE sta_id = ?;"
        );
        $query->execute([$stand_id]);
        return $query;
    }

    public function getAllStandChiefs($stand_id, $username)
    {
        $query = $this->connect()->prepare(
            "SELECT * 
            FROM stand_cheif s 
            JOIN user u 
            ON s.use_username = u.use_username 
            WHERE sta_id = ?; and use_username != ?"
        );
        $query->execute([$stand_id, $username]);
        return $query;
    }

    public function getStandChief($username)
    {
        $query = $this->connect()->prepare(
            "SELECT *
            FROM stand_cheif
            WHERE use_username = ?;"
        );
        $query->execute([$username]);
        return $query;
    }
}
