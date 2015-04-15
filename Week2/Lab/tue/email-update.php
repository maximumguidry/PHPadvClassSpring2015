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
        $emailDAO = new EmailDAO($db);
        $emailModel = new EmailModel();
         
        if ( $util->isPostRequest() ) {
            
            $emailModel->map(filter_input_array(INPUT_POST));
                       
        } else {
            
            $emailid = filter_input(INPUT_GET, 'id');
            //echo var_dump($emailid);
            $emailModel = $emailDAO->getById($emailid);
            //echo var_dump($emailModel);
        }
        
        
        $emailid = $emailModel->getEmailid();
        $email = $emailModel->getEmail();
        $emailType = $emailModel->getEmailtype();  
              
        
        $emailService = new EmailService($db, $util, $validator, $emailDAO, $emailModel);
        
        if ( $emailDAO->idExisit($emailModel->getEmailtypeid()) ) {
            $emailService->saveForm();
        }
        
        
        ?>
        
        
         <h3>UPDATE Email</h3>
        <form action="#" method="post">
             <input type="hidden" name="id" value="<?php echo $emailid; ?>" />
            <label>Email:</label> 
            <input type="text" name="email" value="<?php echo $email; ?>" placeholder="" />
            <br /><br />
            <label>Email Type:</label>
            <input type="text" name="emailType" value="<?php echo $emailType; ?>" />
             <br /><br />
            <input type="submit" value="Submit" />
        </form>
         
         
         <?php         
         //need to investigate this method    
         $emailService->displayEmailsActions();
                          
         ?>
                  
    </body>
</html>