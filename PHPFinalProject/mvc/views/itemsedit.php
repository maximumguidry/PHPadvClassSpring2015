<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Items Edit</title>
        <link rel="stylesheet" type="text/css" href="mvc/views/style.css">
    </head>
    <body>
        <nav>
            <a href="index.php">Index</a>
            <a href="restaurants">Restaurants</a>
            <a href="items">Dishes and Items</a>
        </nav>
        <?php
        // put your code here
        if ( !$scope->util->isLoggedin() ) {
                $scope->util->redirect('login.php');
            } 
            else {
                echo('<form action="#" method="post" class="frmAddPg">
            <input type="hidden" name="action" value="sessionDestroy" />
            <input type="submit" value="Log Out" class="sbmtAdd"/> 
        </form>');
            }
        
                
        if ( isset($scope->view['updated']) ) {
            if( $scope->view['updated'] ) {        
                 echo 'Item Updated';
            } else {
                 echo 'Item NOT Updated';
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
        
        <h3>Edit Dish</h3><hr /><br />

        <div class="frmInput">
        <form action="#" method="post">
            <label>Item:</label><br />         
            <input type="text" name="name" value="<?php echo $name; ?>" placeholder="" />
            <br />
            
            <label>Type:</label>  <br />          
            <input type="text" name="type" value="<?php echo $type; ?>" placeholder="" />
            <br />
            
            <label>Beverage:</label><br />
            <input type="number" max="1" min="0" name="beverage" value="<?php echo $beverage; ?>" />
            <br />
            
            <label>Spicy:</label><br />
            <input type="number" max="1" min="0" name="spicy" value="<?php echo $spicy; ?>" />
            <br />
            
            <label>Rating(1-5):</label><br />
            <input type="number" max="5" min="1" name="rating" value="<?php echo $rating; ?>" />
            <br />
            
            <label>Comments:</label><br />            
            <textarea cols="60" rows="4" name="comments"><?php echo trim($comments); ?></textarea>
            
            
            <br />
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
            <input type="hidden" name="action" value="update" />
            <input type="hidden"  name="itemid" value="<?php echo $itemid; ?>" />
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
