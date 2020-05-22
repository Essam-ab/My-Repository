<?php
class Videotheque extends database
{
    public function __construct()
    {
        //
    }
    public function getVideotheque($id)
    {
        $query = $this->connect()->prepare(
            "SELECT *
            FROM videotheque
            where sta_id = ?;"
        );
        $query->execute([$id]);
        return $query;
    }
    public function getAllVideotheque()
    {
        $query = $this->connect()->prepare(
            "SELECT *
            FROM videotheque;"
        );
        $query->execute();
        return $query;
    }

    public function getAllVideothequeInStand($stand_id)
    {
        $query = $this->connect()->prepare(
            "SELECT *
            FROM videotheque
            WHERE sta_id = ?;"
        );
        $query->execute([$stand_id]);
        return $query;
    }

    public function updateVideotheque($art_lib, $art_desc, $art_brefDesc, $art_ref, $isActive, $art_id)
    {
        $query = $this->connect()->prepare(
            "UPDATE videotheque
            SET art_lib = ?, art_desc = ?, art_brefDesc = ?, art_ref = ?, art_active = ?
            WHERE art_id = ?;"
        );
        $query->execute([$art_lib, $art_desc, $art_brefDesc, $art_ref, $isActive, $art_id]);
        return $query;
    }

    public function addVideotheque(
        $Videotheque_name,
        $path
    ) {
        $query = $this->connect()->prepare(
            "INSERT INTO videotheque
            (vie_nom, vie_video) 
            VALUES (?,?);"
        );

        $query->execute([
            $Videotheque_name,
            $path
        ]);
        return $query;
    }

    public function getLastAddedVideotheque()
    {
        $query = $this->connect()->prepare(
            "SELECT *
            FROM videotheque
            ORDER BY vie_id desc
            LIMIT 1;"
        );
        $query->execute();
        return $query;
    }

    public function updateVideothequeVideo($id, $video)
    {
        $query = $this->connect()->prepare(
            "UPDATE videotheque
            SET vie_video=?
            WHERE vie_id = ?;"
        );
        $query->execute([$video, $id]);
        return $query;
    }


    //links here
    public function getAllLiveStreams()
    {
        $query = $this->connect()->prepare(
            "SELECT *
            FROM live_stream;"
        );
        $query->execute();
        return $query;
    }
}
