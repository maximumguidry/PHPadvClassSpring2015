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
            "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=phpadvancedclass2015',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>''
        );
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        $id = $_GET['id'];

        $emailTypeDAO = new EmailTypeDAO($db);
        $emailDAO = new EmailDAO($db);
         
         
         
         
         //$emailTypes = $emailTypeDAO->getAllRows();
        
         $util = new Util();
         
          if ( $util->isGetRequest() ) {
                            
              $isDeleted = $emailDAO->delete($id);
              echo(var_dump($isDeleted));
                    
          }
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
          