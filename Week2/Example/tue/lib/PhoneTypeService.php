<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PhoneTypeService
 *
 * @author User
 */
class PhoneTypeService {
   
    private $_errors = array();
    private $_Util;
    private $_DB;
    private $_Validator;
    private $_PhoneTypeDAO;
    private $_PhonetypeModel;


    public function __construct($db, $util, $validator, $phoneTypeDAO, $phonetypeModel) {
        $this->_DB = $db;    
        $this->_Util = $util;
        $this->_Validator = $validator;
        $this->_PhoneTypeDAO = $phoneTypeDAO;
        $this->_PhoneTypeModel = $phonetypeModel;
    }


    public function saveForm() {        
        if ( !$this->_Util->isPostRequest() ) {
            return false;
        }
        
        $this->validateForm();
        
        if ( $this->hasErrors() ) {
            $this->displayErrors();
        } else {
            
            if (  $this->_PhoneTypeDAO->save($this->_PhoneTypeModel) ) {
                echo 'Phone Added';
            } else {
                echo 'Phone could not be added Added';
            }
           
        }
        
    }
    public function validateForm() {
       
        if ( $this->_Util->isPostRequest() ) {                
            $this->_errors = array();
            if( !$this->_Validator->phoneTypeIsValid($this->_PhoneTypeModel->getPhonetype()) ) {
                 $this->_errors[] = 'Phone Type is invalid';
            } 
            if( !$this->_Validator->activeIsValid($this->_PhoneTypeModel->getActive()) ) {
                 $this->_errors[] = 'Active is invalid';
            } 
        }
         
    }
    
    
    public function displayErrors() {
       
        foreach ($this->_errors as $value) {
            echo '<p>',$value,'</p>';
        }
         
    }
    
    public function hasErrors() {        
        return ( count($this->_errors) > 0 );        
    }


    public function displayPhones() {        
       
        $stmt = $this->_DB->prepare("SELECT * FROM phonetype");

        if ($stmt->execute() && $stmt->rowCount() > 0) {
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
           
            foreach ($results as $value) {
                echo '<p>', $value['phonetype'], '</p>';
            }
        } else {
            echo '<p>No Data</p>';
        }
        
    }
    
    
}
