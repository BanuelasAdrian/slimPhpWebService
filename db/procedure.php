<?php
require_once('connection.php');

class Procedure
{
    public function addPhrase($phrase)
    {
        $db = new Connection();
        $message = $db -> connectDB();

        if(!$message['error'])
        {
            $connection = $message['connection'];

            $sql = "SELECT phrases.BD_F_ADD_PHRASE('%s') result;";
            $sql = sprintf(
                $sql,
                $phrase
            );

            $result = $connection -> query($sql);
            $connection -> close();
            $message = $db -> validateReturn($result);
        }

        return $message;
    }

    public function getPhrase()
    {
        $db = new Connection();
        $message = $db -> connectDB();

        if(!$message['error'])
        {
            $connection = $message['connection'];
            
            $sql = "CALL phrases.BD_F_GET_PHRASES(@result);";
            $data = $connection -> query($sql);
            $result = $connection -> query('SELECT @result');

            $connection -> close();

            $message = $db -> validateReturnWithResult($result, $data);
        }

        return $message;
    }
}