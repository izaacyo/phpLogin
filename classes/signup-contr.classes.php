<?php

class SignupContr extends Signup
{
    private $uid;
    private $pwd;
    private $pwdRepeat;
    private $email;


    public function __construct($uid, $pwd, $pwdRepeat, $email)
    {
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        $this->email = $email;
    }

    public function signupUser()
    {
        if ($this->emptyInput() === false) {
            //echo empty imput;

            header("location: ../index.php?error=emptyInput");
            exit();
        }
        if ($this->invalidUid() === false) {
            //echo empty username;

            header("location: ../index.php?error=username");
            exit();
        }
        if ($this->invalidEmail() === false) {
            //echo empty email;

            header("location: ../index.php?error=email");
            exit();
        }
        if ($this->pwdMatch() === false) {
            //echo empty email;

            header("location: ../index.php?error=passwordmatch");
            exit();
        }
        if ($this->uidTakenCheck() === false) {
            //echo empty email;

            header("location: ../index.php?error=useroremailtaken");
            exit();
        }

        $this->setUser($this->uid, $this->pwd, $this->email);
    }

    // error handlers 

    private function emptyInput()
    {
        $result = true;

        if ((empty($this->uid)) || empty($this->pwd) || empty($this->pwdRepeat) || empty($this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidUid()
    {
        $result = true;

        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->uid)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidEmail()
    {
        $result = true;

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {

            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function pwdMatch()
    {
        $result = true;

        if ($this->pwd !== $this->pwdRepeat) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function uidTakenCheck()
    {
        $result = true;

        if ($this->checkUser(!$this->uid, $this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
