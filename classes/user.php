<?php

class User extends database
{
    public function __construct()
    {
        //
    }

    public function getUserAuth()
    {
        $query = $this->connect()->prepare(
            "SELECT use_username, use_auth_password 
            FROM user
            WHERE use_auth = ?;"
        );
        $query->execute(['yes']);
        $auth = [];
        if ($query->rowCount()) {
            foreach ($query->fetchAll(PDO::FETCH_OBJ) as $val) {
                $auth[0]['username'] = $val->use_username;
                $auth[0]['password'] = $val->use_auth_password;
            }
            return $auth;
        } else
            return "error! cant get auth credentials!";
    }

    public function getStreamUrl()
    {
        $query = $this->connect()->prepare(
            "SELECT * 
            FROM conf;"
        );
        $query->execute();
        if ($query->rowCount()) {
            foreach ($query->fetchAll(PDO::FETCH_OBJ) as $val)
                return $val->c_url;
        } else
            return "error! cant get StreamUrl!";
    }

    public function updateStreamUrl($url)
    {
        $query = $this->connect()->prepare(
            "UPDATE conf
            SET c_url = ?
            WHERE c_id = ?;"
        );
        $query->execute([$url, 1]);
        return $query;
    }

    public function searchByUsername($var)
    {
        $query = $this->connect()->prepare(
            "SELECT * 
            FROM user
            WHERE  use_username Like CONCAT('%', ?, '%');"
        );
        $query->execute([$var]);
        return $query;
    }

    public function searchByRegion(
        $var
    ) {
        $query = $this->connect()->prepare(
            "SELECT * 
            FROM user
            WHERE  use_country Like CONCAT(?, '%'); "
        );
        $query->execute([
            $var
        ]);
        return $query;
    }

    public function searchByLevel($var)
    {
        $query = $this->connect()->prepare(
            "SELECT * 
            FROM user
            WHERE  use_niveau = ?;"
        );
        $query->execute([$var]);
        return $query;
    }


    public function getAllUsers()
    {
        $query = $this->connect()->prepare(
            "SELECT *
            FROM user;"
        );
        $query->execute();
        return $query;
    }

    public function fetchUsers($limit, $start)
    {
        $query = $this->connect()->prepare(
            "SELECT *
            FROM user
            ORDER BY use_id
            LIMIT :start, :limit"
        );
        $query->bindParam(':start', $start, PDO::PARAM_INT);
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
        $query->execute();
        return $query;
    }

    public function siteStatus()
    {
        $query = $this->connect()->prepare(
            'SELECT *
            FROM site_status;'
        );
        $query->execute();
        if ($query->rowCount()) {
            foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $val)
                return $val['ss_status'];
        } else
            return "error in siteStatus!";
    }

    public function searchByLastOrFirstName($var, $user_in_session)
    {
        $query = $this->connect()->prepare(
            "SELECT use_id, use_username, user_logged, use_color
            FROM user
            WHERE  use_username Like CONCAT('%', ?, '%') and use_username != ?
            ORDER BY user_logged DESC, use_username ASC"
        );
        $query->execute([$var, $user_in_session]);
        return $query;
    }

    private $UsersWithoutColor = 0;
    public function countUsersWithoutColor()
    {
        $query = $this->connect()->prepare(
            "SELECT count(*) 'nb_user'
            from user
            WHERE use_color is NULL"
        );
        $query->execute();
        if ($query->rowCount()) {
            foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $val)
                $this->UsersWithoutColor = $val['nb_user'];
        } else {
            echo "all users has a color!";
            exit();
        }
        return $this->UsersWithoutColor;
    }

    private $color_count = 0;
    public function generateUserColor($color_count)
    {
        $result = $this->countUsersWithoutColor();
        if ($result > 0 && $color_count <= $result) {
            $color_count++;
            $colors = ['#45cbfe', '#799cf6', '#d858d1', '#fe5a5b', '#586aea', '#5cda53'];
            $color = $colors[rand(0, 5)];
            $query = $this->connect()->prepare(
                "UPDATE user
                SET use_color = ?
                WHERE use_color is NULL
                LIMIT 1;"
            );
            $this->generateUserColor($color_count);
            $query->execute([$color]);
            return $query;
        }
        return;
    }

    public function checkLoginAndPhone($email, $phone_number)
    {
        $query = $this->connect()->prepare(
            "SELECT use_email, use_username
            FROM user
            WHERE use_email = ? and use_whatsup = ?;"
        );
        $query->execute([$email, $phone_number]);
        return $query;
    }

    public function CheckUserAuthorized($email)
    {
        $query = $this->connect()->prepare(
            "SELECT *
            FROM user
            WHERE use_auth = ? and use_email = ?;"
        );
        $query->execute(['yes', $email]);
        return $query;
    }

    public function getTotalUsersNumber()
    {
        $query = $this->connect()->prepare(
            "SELECT count(*) 'user_nb'
            FROM user;"
        );
        $query->execute();
        return $query;
    }

    public function getUserId($username)
    {
        $query = $this->connect()->prepare(
            "SELECT use_id
            FROM user
            WHERE use_username = ?;"
        );
        $query->execute([$username]);
        return $query;
    }

    public function getUsername($user_id)
    {
        $query = $this->connect()->prepare(
            "SELECT use_username
            FROM user
            WHERE use_id = ?;"
        );
        $query->execute([$user_id]);
        return $query;
    }

    public function getUsernameByMail($email)
    {
        $query = $this->connect()->prepare(
            "SELECT use_username
            FROM user
            WHERE use_email = ?;"
        );
        $query->execute([$email]);
        return $query;
    }

    public function getUserMail($username)
    {
        $query = $this->connect()->prepare(
            "SELECT use_email
            FROM user
            WHERE use_username = ?;"
        );
        $query->execute([$username]);
        return $query;
    }

    public function userLoggedIn($username)
    {
        $query = $this->connect()->prepare(
            "UPDATE user
            SET user_logged = ?
            WHERE use_username = ?;"
        );
        $query->execute(['yes', $username]);
        return $query;
    }

    public function userLoggedOut($username)
    {
        $query = $this->connect()->prepare(
            "UPDATE user
            SET user_logged = ?
            WHERE use_username = ?;"
        );
        $query->execute(['no', $username]);
        return $query;
    }

    public function getAllSpokenWithUsers($user_in_session, $user_in_session_id)
    {
        $query = $this->connect()->prepare(
            "SELECT distinct u.*
            from user u join message_chat m 
            on u.use_id = m.mes_sender_id or u.use_id = m.mes_receiver_id
            where use_username != ? and (m.mes_sender_id = ? or m.mes_receiver_id = ?)
            ORDER BY u.user_logged desc;"
        );
        $query->execute([$user_in_session, $user_in_session_id, $user_in_session_id]);
        return $query;
    }

    public function getAllSpokenWithChiefs($user_in_session, $user_in_session_id)
    {
        $query = $this->connect()->prepare(
            "SELECT distinct u.*
            from user u join message_chat m 
            on u.use_id = m.mes_sender_id or u.use_id = m.mes_receiver_id
            where use_username != ? and (m.mes_sender_id = ? or m.mes_receiver_id = ?) and use_auth = ?
            ORDER BY u.user_logged desc;"
        );
        $query->execute([$user_in_session, $user_in_session_id, $user_in_session_id, 'yes']);
        return $query;
    }

    public function addUser($f_name, $phoneNumber, $countryName, $countryIso, $dialCode, $niveau, $email)
    {
        $query = $this->connect()->prepare(
            "INSERT INTO user
            (
                use_username,
                use_whatsup,
                use_country,
                use_country_iso,
                use_dial_code,
                use_niveau,
                use_email
            ) VALUES (?, ?, ?, ?, ?, ?, ?);"
        );
        $query->execute([$f_name, $phoneNumber, $countryName, $countryIso, $dialCode, $niveau, $email]);
        return $query;
    }

    public function checkLogin($email)
    {
        $query = $this->connect()->prepare(
            "SELECT use_email, use_password, use_username
            FROM user
            WHERE use_email = ?;"
        );
        $query->execute([$email]);
        return $query;
    }

    public function getPass($username)
    {
        $query = $this->connect()->prepare(
            "SELECT *
            FROM user
            WHERE use_username = ?;"
        );
        $query->execute([$username]);
        return $query;
    }

    public function fetchUsername($email)
    {
        $query = $this->connect()->prepare(
            "SELECT use_username
            FROM user
            WHERE use_email = ?;"
        );
        $query->execute([$email]);
        return $query;
    }

    public function checkUsernameExist($username)
    {
        $query = $this->connect()->prepare(
            "SELECT use_username
            FROM user
            WHERE use_username = ?;"
        );
        $query->execute([$username]);
        return $query;
    }

    public function checkEmailExist($email)
    {
        $query = $this->connect()->prepare(
            "SELECT use_email
            FROM user
            WHERE use_email = ?;"
        );
        $query->execute([$email]);
        return $query;
    }

    public function getAllOnlineOfflineUsers($user_in_session)
    {
        $query = $this->connect()->prepare(
            "SELECT use_id, use_username, user_logged, use_color
            FROM user
            WHERE use_username != ? and use_auth = ?
            ORDER BY user_logged DESC, use_username ASC"
        );
        $query->execute([$user_in_session, 'yes']);
        return $query;
    }

    public function getAllOnlineOfflineUsersAuth($user_in_session)
    {
        $query = $this->connect()->prepare(
            "SELECT use_id, use_username, user_logged, use_color
            FROM user
            WHERE use_username != ?
            ORDER BY user_logged DESC, use_username ASC"
        );
        $query->execute([$user_in_session]);
        return $query;
    }

    public function  getUserColor($user_username)
    {
        $query = $this->connect()->prepare(
            "SELECT use_color
            FROM user
            WHERE  use_username = ?;"
        );
        $query->execute([$user_username]);
        return $query;
    }

    public function hom_getLastNotReadMessage($user_logged_id)
    {
        $query = $this->connect()->prepare(
            "SELECT distinct user_logged, mes_receiver_id, mes_sender_id, mes_status 
            FROM user u  join message_chat m on m.mes_receiver_id = u.use_id 
            WHERE mes_status != ? AND mes_receiver_id = ?
            ORDER BY use_id;"
        );
        $query->execute(['read', $user_logged_id]);
        return $query;
    }

    public function home_getAllInSiteUsers($user_logged)
    {
        $query = $this->connect()->prepare(
            "SELECT *
            FROM user
            WHERE use_username != ?
            ORDER BY user_logged desc;"
        );
        $query->execute([$user_logged]);
        return $query;
    }

    //links query between user and stand
    public function registerUserInStand($user_id, $stand_id, $status)
    {
        $query = $this->connect()->prepare(
            "INSERT INTO user_stand
            (use_id, sta_id, joined_at, user_logged) VALUES (?, ?, ?, ?);"
        );
        $query->execute([$user_id,  $stand_id, date("Y-m-d"), $status]);
        return $query;
    }

    public function logUserInStand($user_id, $status, $stand_id)
    {
        $query = $this->connect()->prepare(
            "UPDATE user_stand
            SET joined_at=?, user_logged = ?
            WHERE use_id = ? AND sta_id = ?"
        );
        $query->execute([date("Y-m-d"), $status, $user_id, $stand_id]);
        return $query;
    }

    public function removeUserFromStand($user_id, $stand_id)
    {
        $query = $this->connect()->prepare(
            "DELETE *
            FROM user_stand 
            WHERE use_id = ? AND  sta_id = ?;"
        );
        $query->execute([$user_id,  $stand_id]);
        return $query;
    }

    public function logUserOutOfStand($user_id, $status,  $stand_id)
    {
        $query = $this->connect()->prepare(
            "UPDATE user_stand
            SET left_at = ?, user_logged = ?
            WHERE use_id = ? AND sta_id = ?"
        );
        $query->execute([date("Y-m-d"), $status,  $user_id,  $stand_id]);
        return $query;
    }

    public function checkUserExistInStand($user_id, $stand_id)
    {
        $query = $this->connect()->prepare(
            "SELECT *
            FROM user_stand
            WHERE use_id = ? AND sta_id = ?;"
        );
        $query->execute([$user_id,  $stand_id]);
        return $query;
    }

    public function updateStandLoginStatus($status, $user_id, $stand_id)
    {
        $query = $this->connect()->prepare(
            "UPDATE user_stand
            SET user_logged = ?
            WHERE use_id = ? AND sta_id = ?"
        );
        $query->execute([$status,  $user_id,  $stand_id]);
        return $query;
    }

    public function getLastNotReadMessage($stand_id, $user_logged, $user_logged_id)
    {
        /*backup query 
            SELECT distinct us.*, us.user_logged, mes_receiver_id, mes_sender_id, mes_status 
            FROM user u join user_stand us join message_chat m on m.mes_receiver_id = us.use_id 
            WHERE sta_id = 6 AND use_username != 'caity' AND mes_status != 'read' AND mes_sender_id != 33 AND EXISTS(
                SELECT *
                FROM message_chat
                WHERE (mes_sender_id = 33 AND mes_receiver_id = 4) OR (mes_sender_id = 4 AND mes_receiver_id = 33)
            )
            ORDER BY m.mes_id;
        */
        $query = $this->connect()->prepare(
            "SELECT distinct us.*, us.user_logged, mes_receiver_id, mes_sender_id, mes_status 
            FROM user u join user_stand us join message_chat m on m.mes_receiver_id = us.use_id 
            WHERE sta_id = ? AND use_username != ? AND mes_status != ? AND mes_receiver_id = ?
            ORDER BY m.mes_id;"
        );
        $query->execute([$stand_id, $user_logged, 'read', $user_logged_id]);
        return $query;
    }

    public function getAllInStandUsers($stand_id, $user_logged)
    {
        $query = $this->connect()->prepare(
            "SELECT *, user_stand.user_logged
            FROM user join user_stand using(use_id)
            WHERE sta_id = ? AND use_username != ?
            ORDER BY user.user_logged desc;"
        );
        $query->execute([$stand_id, $user_logged]);
        return $query;
    }
}
