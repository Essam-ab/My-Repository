<?php
include "config.php";

if (isset($_POST['limit'], $_POST['start'])) {
    $limit = (int) $_POST['limit'];
    $start = (int) $_POST['start'];
    $query = $user->fetchUsers($limit, $start);
    if ($query->rowCount()) {
        $output = "";
        foreach ($query->fetchAll(PDO::FETCH_OBJ) as $val)
            $output .= '<tr>
                        <th scope=\'row\'>' . $val->use_id . '</th>
                        <td>' . $val->use_username . '</td> 
                        <td>' . $val->use_email . '</td>
                        <td>' . $val->use_country . '</td>
                        <td>' .  $val->use_whatsup . '</td>
                        <td>' . $val->use_niveau . '</td>
                    </tr>';
        echo $output;
    }
}
