<?php

require_once("Dao.php");
require_once(__DIR__ . "/../obj/User.php");

class UserDao implements Dao {
    
    private $__table;
    private $__pdo;

    public function __construct($table, $pdo){
        $this->__table = $table;
        $this->__pdo = $pdo;
    }
    
    public function findById($id){
        $stmt = $this->__pdo->prepare("SELECT * 
                                       FROM " . $this->__table . " 
                                       WHERE id = :id");
        $stmt->setFetchMode(PDO::FETCH_CLASS, "User");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function findByName($name){
        $stmt = $this->__pdo->prepare("SELECT * 
                                       FROM " . $this->__table . "
                                       WHERE username = :username");
        $stmt->setFetchMode(PDO::FETCH_CLASS, "User");
        $stmt->bindParam(":username", $name, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function insert($user){
        $stmt = $this->__pdo->prepare("INSERT INTO $__table (username, hashword)
                                       VALUES(:username, :hashword)");
        $stmt->bindParam(":username", $user->username);
        $stmt->bindParam(":hashword", $user->hashword);
        $stmt->execute();
        $user->id = intval($this->__pdo->lastInsertId());
    }
    
    public function update($user){
        $stmt = $this->__pdo->prepare("UPDATE $__table
                                       SET username = :username, 
                                           hashword = :hashword,
                                       WHERE id = :id");
        $stmt->bindParam(":id", $user->id);
        $stmt->bindParam(":username", $user->username);
        $stmt->bindParam(":hashword", $user->hashword);
        $stmt->execute();
    }
    
    public function delete($user){
        $stmt = $this->__pdo->prepare("DELETE FROM $__table
                                       WHERE id = :id");
        $stmt->bindParam(":id", $user->id, PDO::PARAM_INT);
        $stmt->execute();
    }
    
}