<?php

class Chat extends database
{
    public function __construct()
    {
        //
    }

    public function getAllMessages($sender, $receiver)
    {
        $query = $this->connect()->prepare(
            "SELECT *
            FROM message_chat
            WHERE (mes_sender_id = ? AND mes_receiver_id = ?)
            OR  (mes_receiver_id = ? AND mes_sender_id = ?)
            ORDER BY mes_id desc
            LIMIT 30;"
        );
        $query->execute([$sender,  $receiver, $sender,  $receiver]);
        return $query;
    }

    public function getLastMessage($sender, $receiver)
    {
        $query = $this->connect()->prepare(
            "SELECT *
            FROM message_chat
            WHERE (mes_sender_id = ? AND mes_receiver_id = ?)
            OR  (mes_receiver_id = ? AND mes_sender_id = ?)
            ORDER BY mes_id desc
            LIMIT 1;"
        );
        $query->execute([$sender,  $receiver, $sender,  $receiver]);
        return $query;
    }

    public function addMessage($id_sender, $id_receiver, $content)
    {
        $query = $this->connect()->prepare(
            "INSERT INTO message_chat
            (mes_sender_id, mes_receiver_id, mes_content)
            VALUES(?, ?, ?);"
        );
        $query->execute([$id_sender,  $id_receiver, $content]);
        return $query;
    }

    public function updateMessageStatus($status, $sender_id, $receiver_id)
    {
        $query = $this->connect()->prepare(
            "UPDATE message_chat
            SET mes_status = ?
            WHERE mes_sender_id = ? AND  mes_receiver_id = ?;"
        );
        $query->execute([$status, $sender_id,  $receiver_id]);
        return $query;
    }

    public function checkForUpdates()
    {
        $query = $this->connect()->prepare(
            "CHECKSUM TABLE message_chat"
        );
        $query->execute();
        return $query;
    }
}
