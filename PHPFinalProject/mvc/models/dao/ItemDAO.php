<?php
namespace App\models\services;

use App\models\interfaces\IDAO;
use App\models\interfaces\IModel;
use App\models\interfaces\ILogging;
use \PDO;

class ItemDAO extends BaseDAO implements IDAO {
    
    public function __construct( PDO $db, IModel $model, ILogging $log ) {        
        $this->setDB($db);
        $this->setModel($model);
        $this->setLog($log);
    }
          
    public function idExisit($id) {
        
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT * FROM items WHERE itemid = :itemid");
         
        if ( $stmt->execute(array(':itemid' => $id)) && $stmt->rowCount() > 0 ) {
            return true;
        }
         return false;
    }
    
    public function read($id) {
         
         $model = clone $this->getModel();
         
         $db = $this->getDB();
         
         $stmt = $db->prepare("SELECT items.itemid, items.name, items.type, items.rating, items.comments, items.beverage, items.spicy, restaurants.restaurant_name as restaurant_name FROM items LEFT JOIN restaurants on items.restaurantid = restaurants.restaurantid where itemid = :itemid;");
         
         if ( $stmt->execute(array(':itemid' => $id)) && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetch(PDO::FETCH_ASSOC);
             $model->reset()->map($results);
         }
         
         return $model;
    }
    
    
    public function create(IModel $model) {
                 
         $db = $this->getDB();
         
         $binds = array( ":name" => $model->getName(),
                          ":type" => $model->getType(),
                          ":rating" => $model->getRating(),
                          ":comments" => $model->getComments(),
                          ":beverage" => $model->getBeverage(),
                          ":spicy" => $model->getSpicy(),
                          ":restaurantid" => $model->getRestaurantid()
                    );         
         if ( !$this->idExisit($model->getItemid()) ) {
             
             $stmt = $db->prepare("INSERT INTO items SET name = :name, type = :type, rating = :rating, comments = :comments, beverage = :beverage, spicy = :spicy, restaurantid = :restaurantid");
             
             if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
                return true;
             }
         }
                  
         
         return false;
    }
    
    
     public function update(IModel $model) {
                 
         $db = $this->getDB();
         
         $binds = array( ":name" => $model->getName(),
                          ":type" => $model->getType(),
                          ":rating" => $model->getRating(),
                          ":comments" => $model->getComments(),
                          ":beverage" => $model->getBeverage(),
                          ":spicy" => $model->getSpicy(),
                          ":restaurantid" => $model->getRestaurantid(),
                          ":itemid" => $model->getId()
                    );
         
                
         if ( $this->idExisit($model->getRestaurantid()) ) {
            
             $stmt = $db->prepare("UPDATE items SET name = :name, type = :type, rating = :rating, comments = :comments, beverage = :beverage, spicy = :spicy, restaurantid = :restaurantid WHERE itemid = :itemid;");
         
             if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
                return true;
             } else {
                 $error = implode(",", $db->errorInfo());
                 $this->getLog()->logError($error);
             }
             
         }
         
         return false;
    }
    
    public function delete($id) {
          
        $db = $this->getDB();         
        $stmt = $db->prepare("Delete FROM items WHERE itemid = :itemid");

        if ( $stmt->execute(array(':itemid' => $id)) && $stmt->rowCount() > 0 ) {
            return true;
        } else {
            $error = implode(",", $db->errorInfo());
            $this->getLog()->logError($error);
        }
         
         return false;
    }
    
    public function getAllRows() {
       $db = $this->getDB();
       $values = array();
       
        $stmt = $db->prepare("SELECT items.itemid, items.name, items.type, items.rating, items.comments, items.beverage, items.spicy, restaurants.restaurant_name as restaurant_name FROM items LEFT JOIN restaurants on items.restaurantid = restaurants.restaurantid");
        
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($results as $value) {
              
               $model = clone $this->getModel();
               $model->reset()->map($value);
               $values[] = $model;
            }
        }
        //Question:  What does closeCursor do?
        $stmt->closeCursor();
         return $values;
    }
}
