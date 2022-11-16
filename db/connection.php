<?php

class Connection
{
    public function connectDB()
    {
        $mysqli = new mysqli('localhost', 'BD_PHRASES_API', '40404300Mm@');
        $mysqli -> set_charset('utf8');

        if($error = mysqli_connect_errno($mysqli))
        {
            return array(
                'error',
                true,
                'message',
                'Error in the db connection'
            );
        }

        return array(
            'error' => false,
            'connection' => $mysqli
        );
    }

    public function validateReturn($result)
    {
        if($result)
        {
            while($register = $result -> fetch_assoc())
            {
                return json_decode($register['result'], true);
            }
        }

        return array('message' => 'Error to call procedure/function.', 'error' => true);
    }

    public function validateReturnWithResult($result, $data)
    {
        // We've one result, that means that we have one error
        if($result)
        {
            while($register = $result -> fetch_assoc())
            {
                return json_decode($register['@result'], true);
            }
        }

        if($data) 
        {
            $registers = array();
            while($register = $data -> fetch_assoc())
            {
                array_push($registers, $register);
            }

            return array('error', false, 'data', $registers);
        }

        return array('error', true, 'message', 'Error to call procedure');
    }
}