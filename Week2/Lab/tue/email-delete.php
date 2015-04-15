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
       
        $util = new Util();
        $validator = new Validator();
        $emailTypeDAO = new EmailTypeDAO($db);
        $emailTypeModel = new EmailTypeModel();
         
        if ( $util->isPostRequest() ) {
            
            $emailtypeModel->map(filter_input_array(INPUT_POST));
                       
        } else {
            $emailtypeid = filter_input(INPUT_GET, 'emailtypeid');
            $emailtypeModel = $emailTypeDAO->getById($emailtypeid);
        }
        
        
        $emailtypeid = $emailtypeModel->getEmailtypeid();
        $emailType = $emailtypeModel->getEmailtype();
        $active = $emailTypeModel->getActive();  
              
        
        $emailTypeService = new EmailTypeService($db, $util, $validator, $emailTypeDAO, $emailtypeModel);
        
        if ( $emailTypeDAO->idExisit($emailtypeModel->getEmailtypeid()) ) {
            $emailTypeService->saveForm();
        }
        
        
        ?>
        
        
         <h3>Email Delete</h3>
         <?php
            
         ?>
</html>