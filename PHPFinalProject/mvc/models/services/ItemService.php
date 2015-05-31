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
class ItemService implements IService{
    protected $ItemDAO; 
    protected $restaurantService;
     protected $validator;
     protected $model;
             
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

     
     
    public function __construct(IDAO $ItemDAO, IService $restaurantService, IService $validator, IModel $model  ) {
        $this->setItemDAO($ItemDAO);
        $this->setRestaurantService($restaurantService);
        $this->setValidator($validator);
        $this->setModel($model);
    }
    
    
    public function getAllRestaurants() {       
        return $this->getRestaurantService()->getAllRows();   
    }
    
     public function getAllItems() {       
        return $this->getItemDAO()->getAllRows();   
        
    }
    
    public function idExist($id) {
        return $this->getItemDAO()->idExisit($id);
    }
    
    public function read($id) {
        return $this->getItemDAO()->read($id);
    }
    
    public function delete($id) {
        return $this->getItemDAO()->delete($id);
    }
    
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
        //NOTE:  Need to get validator stuff done
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
        
        return $errors;
    }
    
    public function getNewItemModel() {
        return clone $this->getModel();
    }

}
