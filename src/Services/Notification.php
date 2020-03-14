<?php

namespace App\Services;

class Notification {

    private $email;

    public function __construct($email, UploadUserFile $uploadUserFile)
    {

        dump($email, $uploadUserFile); die;
        $this->email = $email;

    }

    public function sendNotification()
    {

    }

}
