<?php include './bootstrap.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        $dbConfig = array(
            "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>''
        );
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        $emailType = filter_input(INPUT_POST, 'emailtype');
        $active = filter_input(INPUT_POST, 'active');
        
        $util = new Util();
        $emailTypeDAO = new EmailTypeDAO($db);
        
        
       
            
            if ( $util->isPostRequest() ) {
                $validator = new Validator(); 
                $errors = array();
                if( !$validator->emailTypeIsValid($emailType) ) {
                    $errors[] = 'Email Type is invalid';
                } 
                
                if ( !$validator->activeIsValid($active) ) {
                     $errors[] = 'Active is invalid';
                }
                
                
                
                if ( count($errors) > 0 ) {
                    foreach ($errors as $value) {
                        echo '<p>',$value,'</p>';
                    }
                } else {
                    /*
                    * Fax,Home,Moble,Pager,Work
                    */
                   
                                       
                    $emailtypeModel = new EmailTypeModel();
                    $emailtypeModel->setActive($active);
                    $emailtypeModel->setEmailtype($emailType);
                    
                   // var_dump($phonetypeModel);
                    if ( $emailTypeDAO->save($emailtypeModel) ) {
                        echo 'Email Type Added';
                    }
                    
                               
                    
                }
                
                
            }
        
        ?>
        
        
         <h3>Add email type</h3>
        <form action="#" method="post">
            <label>Email Type:</label> 
            <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
             <br /><br />
            <input type="submit" value="Submit" />
        </form>
         
         
         <?php         
             
            
           /* echo $phoneTypes[0]->getPhonetype();
            echo $phoneTypes[1]->getPhonetype();
            echo $phoneTypes[2]->getPhonetype();
            * 
            * Foreach that displays all of the emailtypes
            */
//            foreach ($emailTypes as $value) {
//                echo '<p>',$value->getEmailtype(),'</p>';
//            }
            
           // var_dump($phoneTypes);
            
            /*
             * 
             * Why do this here when you can create a service class to do this for you
             
            
            if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($phoneTypes as $value) {
                    echo '<p>',$value['phonetype'],'</p>';
                }
            } else {
                echo '<p>No Data</p>';
            }
             * 
             */
            
         ?>
         <table border="1" cellpadding="5">
                <tr>
                    <th>Email</th>
                    <th>Email Type</th>
                    <th>Last updated</th>
                    <th>Logged</th>
                    <th>Active</th>
                    <th></th>
                </tr>
         <?php 
            $emailtypes = $emailtypeDAO->getAllRows(); 
            foreach ($emailtype as $value) {
                echo '<tr><td>',$value->getEmailType(),'</td><td>',$value->getEmailtype(),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLastupdated())),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLogged())),'</td>';
                echo  '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td><td><a href="email-delete.php?id=',$value->getEmailid(),'">Delete</a></td></tr>' ;
                
            }

         ?>
            </table>
         
    </body>
</html>
