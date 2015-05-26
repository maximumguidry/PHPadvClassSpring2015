<?php
namespace App\models\services;

class RestaurantModel extends BaseModel{
    
    private $restaurantid;
    private $restaurant_name;
    private $location;
    
    
    function getRestaurantid() {
        return $this->restaurantid;
    }

    function getRestaurant_name() {
        return $this->restaurant_name;
    }

    function getLocation() {
        return $this->location;
    }

    function setRestaurantid($restaurantid) {
        $this->restaurantid = $restaurantid;
    }

    function setRestaurant_name($restaurant_name) {
        $this->restaurant_name = $restaurant_name;
    }

    function setLocation($location) {
        $this->location = $location;
    }
    
}
