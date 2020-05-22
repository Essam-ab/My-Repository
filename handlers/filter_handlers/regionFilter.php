<?php
include "config.php";
if (isset($_POST['selected'])) {
    /*
    $countryName = $_POST['countryName'];
    $countryIso = $_POST['countryIso'];
    $dialCode = $_POST['dialCode'];

    $result = $user->searchByRegion(
        $countryName,
        $countryIso,
        $dialCode
    );
    */

    $selected = $_POST['selected'];

    $result = $user->searchByRegion($selected);
    if ($result->rowCount()) {
        $output = '';
        foreach ($result->fetchAll(PDO::FETCH_OBJ) as $val) {
            $output .= '<tr>
                            <th scope=\'row\'>' . $val->use_id . '</th>
                            <td>' . $val->use_username . '</td> 
                            <td>' . $val->use_email . '</td>
                            <td>' . $val->use_country . '</td>
                            <td>' .  $val->use_whatsup . '</td>
                            <td>' . $val->use_niveau . '</td>
                        </tr>';
        }
        echo $output;
    } else {
        echo 0;
    }
} else
    echo -1;
