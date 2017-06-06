<?php namespace Model;

use Kernel\BaseModel;

class User extends BaseModel {

    /**
     * Allows to add a new user to the users table
     * @param $firstName the first name of the new user
     * @param $lastName the last name of the new user
     * @param $email the email of the new user
     * @param $password the password of the new user
     * @return bool true if the request is well executed and false if not
     */
    public function addNewUser($firstName, $lastName, $email, $password) {
        $statement = "INSERT INTO users(first_name, last_name, email, password, subscribed_in) VALUES(?, ?, ?, ?, NOW())";
        return $this->pdo->prepare($statement)->execute([$firstName, $lastName, $email, $password]);
    }
}