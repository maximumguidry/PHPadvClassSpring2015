<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Restaurants</title>
    </head>
    <body>
        
        <?php
        // put your code here
          echo var_dump($scope->util->getPostValues());
         if ( $scope->util->isPostRequest() ) {
             
             if ( isset($scope->view['errors']) ) {
                print_r($scope->view['errors']);
             }
             
             if ( isset($scope->view['saved']) && $scope->view['saved'] ) {
                  echo 'Restaurant Added';
             }
             
             if ( isset($scope->view['deleted']) && $scope->view['deleted'] ) {
                  echo 'Restaurant deleted';
             }
             
         }
        //Will need to set up DO first
         $restaurant_name = $scope->view['model']->getRestaurant_name();
         $location = $scope->view['model']->getLocation();
        
        ?>
        
        
         <h3>Add Restaurant</h3>
        <form action="#" method="post">
            <label>Restaurant Name:</label> 
            <input type="text" name="restaurant_name" value="<?php echo $restaurant_name; ?>" placeholder="" /><br />
            <label>Location</label>
            <input type="text" name="location" value="<?php echo $location; ?>" />
            <input type="hidden" name="action" value="create" /><br />
            <input type="submit" value="Submit" />
        </form>
         <br />
         <br />
         
        <form action="#" method="post">
            <input type="hidden" name="action" value="add" />
            <input type="submit" value="ADD Page" /> 
        </form>
         <?php
         
        
          if ( count($scope->view['Restaurants']) <= 0 ) {
            echo '<p>No Data</p>';
        } else {
            
            
             echo '<table border="1" cellpadding="5"><tr><th>Resaurant Name</th><th>Location</th><th></th><th></th></tr>';
             foreach ($scope->view['Restaurants'] as $value) {
                echo '<tr>';
                echo '<td>', $value->getRestaurant_name(),'</td>';
                echo '<td>', $value->getLocation(),'</td>';
                echo '<td><form action="#" method="post"><input type="hidden"  name="emailtypeid" value="',$value->getRestaurantid(),'" /><input type="hidden" name="action" value="edit" /><input type="submit" value="EDIT" /> </form></td>';
                echo '<td><form action="#" method="post"><input type="hidden"  name="emailtypeid" value="',$value->getRestaurantid(),'" /><input type="hidden" name="action" value="delete" /><input type="submit" value="DELETE" /> </form></td>';
                echo '</tr>' ;
            }
            echo '</table>';
            
        }
         
         
         
         
         
         ?>
    </body>
</html>

