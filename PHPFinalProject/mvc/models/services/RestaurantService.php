<?php
namespace App\models\services;

use App\models\interfaces\IDAO;
use App\models\interfaces\IService;
use App\models\interfaces\IModel;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailTypeService
 *
 * @author 001332825
 */
class RestaurantService implements IService{
     
    //service needs a DAO, validator and model to be used
     protected $DAO;
     protected $validator;
     protected $model;
     
     //getters and setters for validator, model, and DAO
     function getValidator() {
         return $this->validator;
     }

     function setValidator($validator) {
         $this->validator = $validator;
     }

     function getModel() {
         return $this->model;
     }

     function setModel(IModel $model) {
         $this->model = $model;
     }
     
     
     function getDAO() {
         return $this->DAO;
     }

     function setDAO(IDAO $DAO) {
         $this->DAO = $DAO;
     }

    //dependency injection that requires the corresponding DAO, validator, and model interface
    public function __construct(IDAO $RestaurantDAO, IService $validator, IModel $model  ) {
        $this->setDAO($RestaurantDAO);
        $this->setValidator($validator);
        $this->setModel($model);
    }
    
    //gets all the rows by using the function in the DAO
    public function getAllRows($limit = "", $offset = "") {
        return $this->getDAO()->getAllRows($limit, $offset);
    }
    //makes sure and id exists by using the function in the DAO
    public function idExist($id) {
        return $this->getDAO()->idExisit($id);
    }
    //gets a row based on id by using the function in the DAO
    public function read($id) {
        return $this->getDAO()->read($id);
    }
    //deletes a record by id by using the function in the DAO
    public function delete($id) {
        return $this->getDAO()->delete($id);
    }
    //creates a row in the table by using the function in the DAO
    public function create(IModel $model) {
        //only creates if the data passes validation
        if ( count($this->validate($model)) === 0 ) {
            return $this->getDAO()->create($model);
        }
        return false;
    }
    //updates a record by id by using the function in the DAO
    public function update(IModel $model) {
        
        if ( count($this->validate($model)) === 0 ) {
            return $this->getDAO()->update($model);
        }
        return false;
    }
    //validation for fields in the restaurant table
    public function validate( IModel $model ) {
        $errors = array();
        //NOTE:  Need to get validator stuff done
        if ( !$this->getValidator()->restaurant_nameIsValid($model->getRestaurant_name()) ) {
            $errors[] = 'Restaurant name is invalid';
        }
               
       if ( !$this->getValidator()->locationIsValid($model->getLocation()) ) {
            $errors[] = 'Location is invalid';
        }
        
        return $errors;
    }
    //makes a clone of a restaurant model
    public function getNewRestaurantModel() {
        return clone $this->getModel();
    }

}
