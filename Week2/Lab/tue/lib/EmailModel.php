<?php
/**
 * PhoneModel
 * 
 * The idea of the model(Data Object) is to provide an object the reflects your
 * table in your database.  Notice all the private variables are the colums from
 * the table in our database.
 * 
 * One word of advise, keep all table names in your models class lowercase.  When creating 
 * getter and setter functions it will camel case (Java Style) your functions.
 *
 * @author User
 */
class EmailModel implements IModel {
    
    private $emailid;
    private $email;
    private $emailtypeid;
    private $logged;
    private $lastupdated;
    private $active;
    
    function getEmailid() {
        return $this->emailid;
    }

    function getEmail() {
        return $this->email;
    }

    function getEmailtypeid() {
        return $this->emailtypeid;
    }
    
    function getLogged() {
        return $this->logged;
    }
    
    function getLastupdated() {
        return $this->lastupdated;
    }
    
    function getActive() {
        return $this->active;
    }
    
    //-------------------begin sets
    
    function setEmailid($emailid) {
        $this->emailid = $emailid;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setEmailtypeid($emailtypeid) {
        $this->emailtypeid = $emailtypeid;
    }
    
    function setLogged($logged) {
        $this->logged = $logged;
    }
    
    function setLastupdated($lastupdated) {
        $this->lastupdated = $lastupdated;
    }
    
    function setActive($active) {
        $this->active = $active;
    }

    
    
    /*
    * When a class has to implement an interface those functions must be created in the class.
    */
    public function reset() {
        $this->setEmailid('');
        $this->setEmail('');
        $this->setEmailtypeid('');
        $this->setLogged('');
        $this->setLastupdated('');
        $this->setActive('');
        return $this;
    }
    
    
   
    public function map(array $values) {
        
        if ( array_key_exists('emailid', $values) ) {
            $this->setEmailid($values['emailid']);
        }
        
        if ( array_key_exists('email', $values) ) {
            $this->setEmail($values['email']);
        }
        
        if ( array_key_exists('emailtypeid', $values) ) {
            $this->setEmailtypeid($values['emailtypeid']);
        }
        
        if ( array_key_exists('logged', $values) ) {
            $this->setLogged($values['logged']);
        }
        
        if ( array_key_exists('lastupdated', $values) ) {
            $this->setLastupdated($values['lastupdated']);
        }
        
        if ( array_key_exists('active', $values) ) {
            $this->setActive($values['active']);
        }
        return $this;
    }


}
