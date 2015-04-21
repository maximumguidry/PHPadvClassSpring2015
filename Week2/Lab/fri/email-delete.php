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
            "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=phpadvclassspring2015',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>''
        );
        
        
        try {
            
            $pdo = new DB($dbConfig);
            $db = $pdo->getDB();
        } 
        
        catch (Exception $ex) {
            
            echo $ex->getMessage();
        }
        
        $id = filter_input(INPUT_GET, 'id');
        //echo var_dump($db);
        
        $emailDAO = new EmailDAO($db);
        
        //echo var_dump($emailDAO);
         
        //$emailTypes = $emailTypeDAO->getAllRows();


?>
        <h3>Email Delete</h3>
        <?php
            if($emailDAO->delete($id))
            {
                echo '<p>Email deleted at record number ',$id,'</p>';
            }
            else
            {
                echo '<p>No records deleted.</p>';
            }
        ?>
        
        
    </body>
    
</html>
          