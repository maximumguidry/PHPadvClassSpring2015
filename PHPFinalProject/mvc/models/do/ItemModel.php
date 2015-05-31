<?php
namespace App\models\services;

class ItemModel extends BaseModel{
    
    private $itemid;
    private $name;
    private $type;
    private $rating;
    private $comments;
    private $beverage;
    private $spicy;
    private $restaurantid;
    private $restaurant_name;
    

    function getItemid() {
        return $this->itemid;
    }

    function getName() {
        return $this->name;
    }
    
    function getType() {
        return $this->type;
    }
    
    function getRating() {
        return $this->rating;
    }
    
    function getComments() {
        return $this->comments;
    }
    
    function getBeverage() {
        return $this->beverage;
    }
    
    function getSpicy() {
        return $this->spicy;
    }
    
    function getRestaurantid() {
        return $this->restaurantid;
    }
    
    function getRestaurant_name() {
        return $this->restaurant_name;
    }

    function setItemid($itemid) {
        $this->itemid = $itemid;
    }

    function setName($name) {
        $this->name = $name;
    }
    
    function setType($type) {
        $this->type = $type;
    }
    
    function setRating($rating) {
        $this->rating = $rating;
    }
    
    function setComments($comments) {
        $this->comments = $comments;
    }
    
    function setBeverage($beverage) {
        $this->beverage = $beverage;
    }
    
    function setSpicy($spicy) {
        $this->spicy = $spicy;
    }
    
    function setRestaurantid($restaurantid) {
        $this->restaurantid = $restaurantid;
    }
    
    function setRestaurant_name($restaurant_name) {
        $this->restaurant_name = $restaurant_name;
    }
    
}
