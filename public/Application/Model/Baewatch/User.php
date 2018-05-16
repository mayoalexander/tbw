<?php

Namespace Model\Baewatch;

class User extends \Model\Model_Abstract
{
    // Required static keys for database columns
    static protected $_keys;
    // Required table name
    CONST TABLE     = 'users';
    // Required AUTOINC flag
    CONST AUTOINC   = true;
    // Required PRIKEY that is AUTOINC
    CONST PRIKEY    = 'id';
    /*
     * Initialize models table
     */
    public function __construct()
    {
        $this->init();
    }


    public function createNewUser() {

        $request        = \Application::getSingleton('Core\Request');

        $update     = array();
        $sql = "SELECT * from users";
        $pdo = \Application::getConn()->getPDO();
        $statement  = $pdo->prepare($sql);
        $statement->execute(array_values($update));

        \Application::debug($statement);

        // $signupProcess = $this->addData(array(
        //     'firstname'       => $request->getData('first_name'),
        //     'lastname'       => $request->getData('last_name'),
        //     'username'          => $request->getData('user_name'),
        //     'email'         => $request->getData('email')
        //  ))->save();

        // \Application::debug($request);
        // \Application::debug($signupProcess);

        // return 'Okay this shit is working now..';

    }
}
