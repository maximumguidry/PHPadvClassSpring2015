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
 * Description of ItemService
 *
 * @author 001332825
 */
//declares the item service class
class ItemService implements IService{
     //needs a Database Access Object, validator, and model
     //plus it needs the restaurant service to get restaurant name instead of just the id
     protected $ItemDAO; 
     protected $restaurantService;
     protected $validator;
     protected $model;
    //getters and setters for the objects         
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
     
     
     function getItemDAO() {
         return $this->ItemDAO;
     }

     function setItemDAO(IDAO $DAO) {
         $this->ItemDAO = $DAO;
     }
     
     function getRestaurantService() {
         return $this->restaurantService;
     }
     
     function setRestaurantService($restaurantService) {
         $this->restaurantService = $restaurantService;
     }

     
    //constructor with the dependancy injection for ItemDAO restaurantService, validator, and model 
    public function __construct(IDAO $ItemDAO, IService $restaurantService, IService $validator, IModel $model  ) {
        $this->setItemDAO($ItemDAO);
        $this->setRestaurantService($restaurantService);
        $this->setValidator($validator);
        $this->setModel($model);
    }
    
    //gets all rows from the restaurant table by using the function in the DAO
    public function getAllRestaurants() {       
        return $this->getRestaurantService()->getAllRows();   
    }
    //gets all rows in the item table by using the function in the DAO
     public function getAllItems() {       
        return $this->getItemDAO()->getAllRows();   
        
    }
    //checks to make sure the id exists by using the function in the DAO
    public function idExist($id) {
        return $this->getItemDAO()->idExisit($id);
    }
    //selects a row by id by using the function in the DAO
    public function read($id) {
        return $this->getItemDAO()->read($id);
    }
    //deletes a row by id by using the function in the DAO
    public function delete($id) {
        return $this->getItemDAO()->delete($id);
    }
    //creates a record row by using the function in the DAO
    public function create(IModel $model) {
        
        if ( count($this->validate($model)) === 0 ) {
            return $this->getItemDAO()->create($model);
        }
        return false;
    }
    
    public function update(IModel $model) {
        
        if ( count($this->validate($model)) === 0 ) {
            return $this->getItemDAO()->update($model);
        }
        return false;
    }
    
    public function validate( IModel $model ) {
        $errors = array();
        //calls the validator functions to make sure the values of the model are valid
        //adding an element to the errors array for any invalid values
        if ( !$this->getValidator()->itemIsValid($model->getName()) ) {
            $errors[] = 'Item name is invalid';
        }       
       if ( !$this->getValidator()->typeIsValid($model->getType()) ) {
            $errors[] = 'Type is invalid';
        }  
        
        if ( !$this->getValidator()->beverageIsValid($model->getBeverage()) ) {
            $errors[] = 'Beverage is invalid';
        }  
        
        if ( !$this->getValidator()->spicyIsValid($model->getSpicy()) ) {
            $errors[] = 'Spicy is invalid';
        }  
        
        if ( !$this->getValidator()->ratingIsValid($model->getRating()) ) {
            $errors[] = 'Rating is invalid';
        }  
        //returns the errors array
        return $errors;
    }
    //creates a clone of the item model
    public function getNewItemModel() {
        return clone $this->getModel();
    }

}
