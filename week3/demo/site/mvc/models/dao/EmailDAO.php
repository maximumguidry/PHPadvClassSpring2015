<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\models\services;

use App\models\interfaces\IDAO;
use App\models\interfaces\IModel;
use App\models\interfaces\ILogging;
use \PDO;

class EmailDAO extends BaseDAO implements IDAO 
{
    public function __construct( PDO $db, IModel $model, ILogging $log ) {        
        $this->setDB($db);
        $this->setModel($model);
        $this->setLog($log);
    }
    //need a function to see if an id exists in table
    public function idExisit($id) {
                
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT emailid FROM email WHERE emailid = :emailid");
         
        if ( $stmt->execute(array(':emailid' => $id)) && $stmt->rowCount() > 0 ) {
            return true;
        }
         return false;
    }
    //Qustion:  where is $id coming from?
    public function read($id) {
         
         $model = clone $this->getModel();
         
         $db = $this->getDB();
         
         $stmt = $db->prepare("SELECT email.emailid, email.email, email.emailtypeid, emailtype.emailtype, emailtype.active as emailtypeactive, email.logged, email.lastupdated, email.active"
                 . " FROM email LEFT JOIN emailtype on email.emailtypeid = emailtype.emailtypeid WHERE emailid = :emailid");
         
        if ( $stmt->execute(array(':emailid' => $id)) && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetch(PDO::FETCH_ASSOC);
             $model->map($results);
        }
         
        return $model;
         
        
    }
    //creates a new row in the email table returning true if successful
    public function create(IModel $model) {

     $db = $this->getDB();
//Question:  What does this do?
     $binds = array( ":email" => $model->getEmail(),
                     ":active" => $model->getActive(),
                     ":emailtypeid" => $model->getEmailtypeid()             
                );

     if ( !$this->idExisit($model->getEmailid()) ) {

         $stmt = $db->prepare("INSERT INTO email SET email = :email, emailtypeid = :emailtypeid, active = :active, logged = now(), lastupdated = now()");

         if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
            return true;
         }
     }


     return false;
}
    //updates a row in table
    public function update(IModel $model) {

             $db = $this->getDB();

            $binds = array( ":email" => $model->getEmail(),
                            ":active" => $model->getActive(),
                            ":emailtypeid" => $model->getEmailtypeid(),
                            ":emailid" => $model->getEmailid()
                        );


             if ( $this->idExisit($model->getEmailid()) ) {

                 $stmt = $db->prepare("UPDATE email SET email = :email, emailtypeid = :emailtypeid,  active = :active, lastupdated = now() WHERE emailid = :emailid");

                 if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
                    return true;
                 } else {
                     $error = implode(",", $db->errorInfo());
                     $this->getLog()->logError($error);
                 }

             } 

             return false;
        }
    //deletes a row matching the id
    public function delete($id) {
          
        $db = $this->getDB();         
        $stmt = $db->prepare("Delete FROM email WHERE emailid = :emailid");

        if ( $stmt->execute(array(':emailid' => $id)) && $stmt->rowCount() > 0 ) {
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
       
        $stmt = $db->prepare("SELECT email.emailid, email.email, email.emailtypeid, emailtype.emailtype, emailtype.active as emailtypeactive, email.logged, email.lastupdated, email.active"
                 . " FROM email LEFT JOIN emailtype on email.emailtypeid = emailtype.emailtypeid");
        
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($results as $value) {
               $model = clone $this->getModel();
               $model->reset()->map($value);
               $values[] = $model;
            }
        }
        
        $stmt->closeCursor();
         return $values;
    }
    
}

