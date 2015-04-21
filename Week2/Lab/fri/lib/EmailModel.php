<?php
namespace bguidry\week2;

class EmailModel implements IModel {
    
    private $emailid;
    private $email;
    private $emailtypeid;
    private $logged;
    private $lastupdated;
    private $active;
    private $emailtype;
    
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
    
    function getEmailtype() {
        return $this->emailtype;
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

    function setEmailtype($emailtype) {
        $this->emailtype = $emailtype;
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
        $this->setEmailtype('');
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
        if ( array_key_exists('emailtype', $values))
        {
            $this->setEmailtype($values['emailtype']);        
        }
        return $this;
    }


}
