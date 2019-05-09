<?php

require_once("Dao.php");
require_once(__DIR__ . "/../obj/Product.php");

class ProductDao implements Dao {
    
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
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Product");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function findByName($name){
        $stmt = $this->__pdo->prepare("SELECT * 
                                       FROM " . $this->__table . " 
                                       WHERE name LIKE :name");
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Product");
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function getCategories(){
        $stmt = $this->__pdo->prepare("SELECT catId, catName 
                                       FROM " . ss_category . " 
                                       ORDER BY catName");
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Category");
        //$stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function findByAmount(){ //"SELECT COUNT(title) AS num FROM `videoGames`";       
        $stmt = $this->__pdo->prepare("SELECT COUNT(id) AS num 
                                      FROM " . $this->__table . " 
                                      ");
        $stmt->execute();
        return $stmt->fetch()["num"];
    }
    
    public function findByAvg(){//"SELECT ROUND(AVG(price),2) AS avg FROM `videoGames`"
        $stmt = $this->__pdo->prepare("SELECT ROUND(AVG(price), 2) 
                                      AS avg FROM " . $this->__table);
        $stmt->execute();
        return $stmt->fetch()["avg"];
    }
    
    public function findByMax(){
        $stmt = $this->__pdo->prepare("SELECT name, MAX(price) AS price
                                      FROM " . $this->__table);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Product");
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function findByPriceASC(){
        $stmt = $this->__pdo->prepare("SELECT * 
                                       FROM " . $this->__table . " 
                                       ORDER BY price ASC");
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Product");
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function findByPriceDESC(){
        $stmt = $this->__pdo->prepare("SELECT * 
                                       FROM " . $this->__table . " 
                                       ORDER BY price DESC");
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Product");
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function findByABC(){
        $stmt = $this->__pdo->prepare("SELECT * 
                                       FROM " . $this->__table . " 
                                       ORDER BY name ASC");
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Product");
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function findByColor(){
        $stmt = $this->__pdo->prepare("SELECT * 
                                       FROM " . $this->__table . " 
                                       ORDER BY color ASC");
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Product");
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function findRecommended(){
        $stmt = $this->__pdo->prepare("SELECT * 
                                       FROM " . $this->__table);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Product");
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function findAllProducts(){
        $stmt = $this->__pdo->prepare("SELECT * 
                                       FROM " . $this->__table);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Product");
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function insert($product){
        $stmt = $this->__pdo->prepare("INSERT INTO " . $this->__table . "(name, color, description, price, thumbnail, catId)
                                       VALUES(:name, :color, :description, :price, :thumbnail,  :catId)");
        $stmt->bindParam(":name", $product->name);
        $stmt->bindParam(":color", $product->color);
        $stmt->bindParam(":description", $product->description);
        $stmt->bindParam(":price", $product->price);
        $stmt->bindParam(":thumbnail", $product->thumbnail);
        $stmt->bindParam(":catId", $product->catId);
        $stmt->execute();
        $product->id = intval($this->__pdo->lastInsertId());
    }
    
    public function update($product){
        $stmt = $this->__pdo->prepare("UPDATE " . $this->__table . 
                                       " SET name = :name,
                                            color = :color,
                                           description = :description,
                                          price = :price,
                                          thumbnail = :thumbnail,
                                           catId = :catId
                                       WHERE id = :id");
        $stmt->bindParam(":id", $product->id, PDO::PARAM_INT);
        $stmt->bindParam(":name", $product->name);
        $stmt->bindParam(":color", $product->color);
        $stmt->bindParam(":description", $product->description);
        $stmt->bindParam(":price", $product->price);
        $stmt->bindParam(":thumbnail", $product->thumbnail);
        $stmt->bindParam(":catId", $product->catId);
        $stmt->execute();
    }
    
    public function delete($product){
        $stmt = $this->__pdo->prepare("DELETE FROM " . $this->__table . 
                                       " WHERE id = :id");
        $stmt->bindParam(":id", $product->id, PDO::PARAM_INT);
        $stmt->execute();
    }
    
    
    
}