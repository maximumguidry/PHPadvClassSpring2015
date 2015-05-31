<?php
namespace App\models\services;

use App\models\interfaces\IService;

class Validator implements IService {
    

    public function restaurant_nameIsValid($restaurant_name) {
        return ( is_string($restaurant_name) && !empty($restaurant_name) ); 
    }
    
    public function locationIsValid($location) {
        return ( is_string($location) && !empty($location) ); 
    }
   
    public function itemIsValid($item) {
        return ( is_string($item) && !empty($item) ); 
    }
    
    public function typeIsValid($type) {
        return ( is_string($type) && !empty($type) ); 
    }
    
    public function beverageIsValid($beverage) {
        return ( is_string($beverage) && preg_match("/^[0-1]$/", $beverage) );
    }
    
    public function spicyIsValid($spicy) {
        return ( is_string($spicy) && preg_match("/^[0-1]$/", $spicy) );
    }
    
    public function ratingIsValid($rating) {
        return ( is_string($rating) && preg_match("/^[1-5]$/", $rating) );
    }
}
