<?php
class User {
    public $id;
    public $username;
    public $hashword;
    
    public function isAdmin(){
        return $this->id == 1;
    }
}