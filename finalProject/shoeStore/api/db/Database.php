<?php

require_once("DatabaseConfig.php");
require_once('dao/UserDao.php');
require_once('dao/ProductDao.php');

class Database {
    
    private static $_inst = null;
    private $userDao, $productDao;
    private $pdo;
    
    public function __construct(){
        global $DB_CONFIG;
        $dsn = "mysql:dbname={$DB_CONFIG['database']};
                        host={$DB_CONFIG['host']};
                        port={$DB_CONFIG['port']};
                        charset=utf8";
        $pdo = new PDO($dsn, $DB_CONFIG["username"], $DB_CONFIG["password"]);
        $this->userDao = new UserDao("ss_user", $pdo);
        $this->productDao = new ProductDao("ss_product", $pdo);
    }
    
    public static function getUserDao(){
        return self::__getSelf()->userDao;
    }
    
    public static function getProductDao(){
        return self::__getSelf()->productDao;
    }
    
    public static function __getSelf(){
        if($_inst == null)
            $_inst = new Database();
        return $_inst;
    }
    
}