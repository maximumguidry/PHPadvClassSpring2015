<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
                
         if ( $scope->util->isPostRequest() ) {
             
             if ( isset($scope->view['errors']) ) {
                print_r($scope->view['errors']);
             }
             
             if ( isset($scope->view['saved']) && $scope->view['saved'] ) {
                  echo 'Phone Added';
             }
             
             if ( isset($scope->view['deleted']) && $scope->view['deleted'] ) {
                  echo 'Phone deleted';
             }
             
         }
        
            $phone = $scope->view['model']->getPhone();
            $active = $scope->view['model']->getActive();
            $phoneTypeid = $scope->view['model']->getPhonetypeid();
        ?>
        
        <h3>Add phone</h3>
        <form action="#" method="post">
            <label>Phone:</label>            
            <input type="text" name="phone" value="<?php echo $phone; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
            
            <br /><br />
            <label>Phone Type:</label>
            <select name="phonetypeid">
            <?php 
                foreach ($scope->view['phoneTypes'] as $value) {
                    if ( $value->getPhonetypeid() == $phoneTypeid ) {
                        echo '<option value="',$value->getPhonetypeid(),'" selected="selected">',$value->getPhonetype(),'</option>';  
                    } else {
                        echo '<option value="',$value->getPhonetypeid(),'">',$value->getPhonetype(),'</option>';
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
         
        <form action="#" method="post">
            <input type="hidden" name="action" value="add" />
            <input type="submit" value="ADD Page" /> 
        </form>
        
         <?php 
         
          if ( count($scope->view['phones']) <= 0 ) {
                echo '<p>No Data</p>';
            } else {
                echo '<table border="1" cellpadding="5"><tr><th>Phone</th><th>Phone Type</th><th>Last updated</th><th>Logged</th><th>Active</th><th></th><th></th></tr>'; 
                 foreach ($scope->view['phones'] as $value) {
                    echo '<tr><td>',$value->getPhone(),'</td><td>',$value->getPhonetype(),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLastupdated())),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLogged())),'</td>';
                    echo  '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td>';
                     echo '<td><form action="#" method="post"><input type="hidden"  name="phoneid" value="',$value->getPhoneid(),'" /><input type="hidden" name="action" value="edit" /><input type="submit" value="EDIT" /> </form></td>';
                    echo '<td><form action="#" method="post"><input type="hidden"  name="phoneid" value="',$value->getPhoneid(),'" /><input type="hidden" name="action" value="delete" /><input type="submit" value="DELETE" /> </form></td>';
               
                    echo '</tr>' ;
                }
                echo '</table>';
            }
           
           

         ?>
            
    </body>
</html>
