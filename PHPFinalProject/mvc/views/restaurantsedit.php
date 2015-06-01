<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="mvc/views/style.css">
        <title>Restaurant Edit</title>
    </head>
    <body>
        <nav>
            <a href="index.php">Index</a>
            <a href="restaurants">Restaurants</a>
            <a href="items">Dishes and Items</a>
        </nav>
        <?php
        // put your code here
        //echo var_dump($scope);
        
         if ( isset($scope->view['updated']) ) {
            if( $scope->view['updated'] ) {        
                 echo 'Restaurant Updated';
            } else {
                 echo 'Restaurant NOT Updated';
            }                 
        }
        
            $restaurantid = $scope->view['model']->getRestaurantid();
            $restaurant_name = $scope->view['model']->getRestaurant_name();
            $location = $scope->view['model']->getLocation();
        ?>
        
        <h3>Edit Restaurant</h3>
        <div class="frmInput">
        <form action="#" method="post">
            <label>Restaurant Name:</label> <br />
            <input type="text" name="restaurant_name" value="<?php echo $restaurant_name; ?>" placeholder="" /><br />
            <label>Location:</label><br />
            <input type="text" name="location" value="<?php echo $location; ?>" />
            <input type="hidden" name="action" value="update" /><br />
            <input type="hidden"  name="restaurantid" value="<?php echo $restaurantid; ?>" />
            <input type="submit" value="Submit" />
        </form>
        </div>
         <br />
         <br />
         
        <form action="#" method="post" class="frmAddPg">
            <input type="hidden" name="action" value="add" />
            <input type="submit" value="Back to Add Page" class="sbmtAdd"/> 
        </form>
        <br />
         <?php
         
        
          if ( count($scope->view['restaurants']) <= 0 ) {
            echo '<p>No Data</p>';
        } else {
            
            
             echo '<table border="1" cellpadding="5"><tr><th>Resaurant Name</th><th>Location</th><th></th><th></th></tr>';
             foreach ($scope->view['restaurants'] as $value) {
                echo '<tr>';
                echo '<td>', $value->getRestaurant_name(),'</td>';
                echo '<td>', $value->getLocation(),'</td>';
                echo '<td><form action="#" method="post"><input type="hidden"  name="restaurantid" value="',$value->getRestaurantid(),'" /><input type="hidden" name="action" value="edit" /><input type="submit" value="EDIT" /> </form></td>';
                echo '<td><form action="#" method="post"><input type="hidden"  name="restaurantid" value="',$value->getRestaurantid(),'" /><input type="hidden" name="action" value="delete" /><input type="submit" value="DELETE" /> </form></td>';
                echo '</tr>' ;
            }
            echo '</table>';
            
        }
           
           
            
         ?>
            
    </body>
</html>