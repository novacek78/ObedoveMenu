<?php

class MFW_Model_UserDao extends MFW_Model_AbstractDao
{


    public function authenticate($login, $pwd)
    {
        $result = false;

        //TODO overenie prihl.dat

        $result = array(
            'uid' => 456,
            'key' => '64s6fs654fs654sdf45654as456'
        );

        return $result;
    }

}