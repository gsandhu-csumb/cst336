<?php

interface Dao {
    
    public function findById($id);
    
    public function findByName($id);
    
    public function insert($obj);
    
    public function update($obj);
    
    public function delete($obj);
    
}