<?php

class PurchasesDao {
    
    private $__table;
    private $__pdo;

    public function __construct($table, $pdo){
        $this->__table = $table;
        $this->__pdo = $pdo;
    }
    
    public function insert($amount){
        $stmt = $this->__pdo->prepare("INSERT INTO ss_purchase (unitPrice) VALUES (:amount)");
        $stmt->bindParam(":amount", intval($amount));
        $stmt->execute();
    }
    
    public function findByAvg(){
        $stmt = $this->__pdo->prepare("SELECT ROUND(AVG(unitPrice), 2) 
                                      AS avg FROM " . $this->__table);
        $stmt->execute();
        return $stmt->fetch()["avg"];
    }
    
}