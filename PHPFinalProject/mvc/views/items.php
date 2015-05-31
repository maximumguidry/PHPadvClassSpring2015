<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Items</title>
    </head>
    <body>
        <nav>
            <a href="index.php">Index</a>
            <a href="restaurants.php">Restaurants</a>
            <a href="items.php">Items</a>
        </nav>
        <?php
        // put your code here
                
         if ( $scope->util->isPostRequest() ) {
             
             if ( isset($scope->view['errors']) ) {
                print_r($scope->view['errors']);
             }
             
             if ( isset($scope->view['saved']) && $scope->view['saved'] ) {
                  echo 'Dish Added';
             }
             
             if ( isset($scope->view['deleted']) && $scope->view['deleted'] ) {
                  echo 'Dish deleted';
             }
             
         }
        
            $name = $scope->view['model']->getName();
            $type = $scope->view['model']->getType();
            $rating = $scope->view['model']->getRating();
            $comments = $scope->view['model']->getComments();
            $beverage = $scope->view['model']->getBeverage();
            $spicy = $scope->view['model']->getSpicy();
            $restaurantid = $scope->view['model']->getRestaurantid();
            $itemid = $scope->view['model']->getItemid();
            
            
        ?>
        
        <h3>Add Dish</h3>
        
        
        
        <form action="#" method="post" name="frmItems">
            <label>Item:</label>            
            <input type="text" name="name" value="<?php echo $name; ?>" placeholder="" />
            <br /><br />
            
            <label>Type:</label>            
            <input type="text" name="type" value="<?php echo $type; ?>" placeholder="" />
            <br /><br />
            
            <label>Beverage:</label>
            <input type="number" max="1" min="0" name="beverage" value="<?php echo $beverage; ?>" />
            <br /><br />
            
            <label>Spicy:</label>
            <input type="number" max="1" min="0" name="spicy" value="<?php echo $spicy; ?>" />
            <br /><br />
            
            <label>Rating:</label>
            <input type="number" max="5" min="1" name="rating" value="<?php echo $rating; ?>" />
            <br /><br />
            
            <label>Comments:</label><br />            
            <textarea cols="60" rows="4" name="comments"><?php echo $comments; ?></textarea>
            
            
            <br /><br />
            <label>Restaurant:</label>
            <select name="restaurantid">
            <?php 
            
                foreach ($scope->view['restaurants'] as $value) {
                    if ( $value->getRestaurantid() == $restaurantid ) {
                        echo '<option value="',$value->getRestaurantid(),'" selected="selected">',$value->getRestaurant_name(),'</option>';  
                    } else {
                        echo '<option value="',$value->getRestaurantid(),'">',$value->getRestaurant_name(),'</option>';
                    }
                }
            ?>
            </select>
             <br /><br />
            <input type="hidden" name="action" value="create" />
            <input type="submit" value="Submit" />
        </form>

        
         <br />
         <br />
        <form action="#" method="post" >
            <input type="hidden" name="action" value="add" />
            <input type="submit" value="ADD Page" /> 
        </form>
        <br />
        
         <?php 
         
         
         
          if ( count($scope->view['items']) <= 0 ) {
                echo '<p>No Data</p>';
            } else {
                echo '<table border="1" cellpadding="2"><tr><th>Item</th><th>Type</th><th>Beverage</th><th>Spicy</th><th>Rating</th><th>Comments</th><th>Restaurant</th><th></th><th></th></tr>'; 
                 foreach ($scope->view['items'] as $value) {
                    echo '<tr><td>',$value->getName(),'</td>'
                            . '<td>',$value->getType(),'</td>'
                            . '<td>', ( $value->getBeverage() == 1 ? 'Yes' : 'No') ,'</td>'
                            . '<td>',( $value->getSpicy() == 1 ? 'Yes' : 'No'),'</td>';
                    echo  '<td>', $value->getRating(),'</td>'
                             .'<td>',$value->getComments(),'</td>'
                             .'<td>',$value->getRestaurant_name(),'</td>';
                     echo '<td><form action="#" method="post"><input type="hidden"  name="itemid" value="',$value->getItemid(),'" /><input type="hidden" name="action" value="edit" /><input type="submit" value="EDIT" /> </form></td>';
                    echo '<td><form action="#" method="post"><input type="hidden"  name="itemid" value="',$value->getItemid(),'" /><input type="hidden" name="action" value="delete" /><input type="submit" value="DELETE" /> </form></td>';
               
                    echo '</tr>' ;
                }
                echo '</table>';
            }
           //print_r($scope->view['items']);
           //var_dump($scope);

         ?>
            
    </body>
</html>
