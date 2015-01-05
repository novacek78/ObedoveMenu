<?php

class MFW_Model_UserDao extends MFW_Model_AbstractDao
{


    public function authenticate($login, $pwd, $uid = NULL, $key = NULL)
    {
        $result = false;

        //TODO overenie prihl.dat

        $result = array(
            'login' => 'jano',
            'uid' => 456,
            'key' => '64s6fs654fs654sdf45654as456'
        );

        return $result;
    }

    public function registerNewVisitor()
    {

        //TODO zaregistrovat navstevnika do DB

        $newVisitorId = mt_rand(); //FIXME toto je len docasne - ID budu autoincrement z DB
        return $newVisitorId;
    }
}