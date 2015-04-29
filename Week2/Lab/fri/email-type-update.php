<?php 
namespace bguidry\week2;
include './bootstrap.php'; ?>
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
        $emailTypeDAO = new EmailTypeDAO($db);
        $emailTypeModel = new EmailTypeModel();
        
        $emailTypes = $emailTypeDAO->getAllRows();
         
        if ( $util->isPostRequest() ) {
            
            $emailtypeid = filter_input(INPUT_GET, 'id');
            //echo $emailtypeid;
            $emailTypeModel->map(filter_input_array(INPUT_POST));
            $emailTypeModel->setEmailtypeid($emailtypeid);
            
            //echo var_dump($emailTypeModel);
            if($emailTypeDAO->save($emailTypeModel))
            {
                echo "Record updated!";
                
            }
            else
            {
                echo "No record updated.";
            }
                       
        } else {
            
            $emailtypeid = filter_input(INPUT_GET, 'id');
            //echo var_dump($emailid);
            $emailTypeModel = $emailTypeDAO->getById($emailtypeid);
            //echo var_dump($emailModel);
        }
        
        
        $emailType = $emailTypeModel->getEmailtype(); 
        $emailTypeid = $emailTypeModel->getEmailtypeid();
        $active = $emailTypeModel->getActive();
              
        
        $emailTypeService = new EmailTypeService($db, $util, $validator, $emailTypeDAO, $emailTypeModel);
        
        if ( $emailTypeDAO->idExisit($emailTypeModel->getEmailtypeid()) ) {
            $emailTypeService->saveForm();
        }
        
        
        ?>
        
        
         <h3>UPDATE Email Type</h3>
        <form action="#" method="post">
             <input type="hidden" name="id" value="<?php echo $emailtypeid; ?>" />
            <label>Email Type:</label> 
            <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
            <br /><br />
            
            
            
            <input type="submit" value="Submit" />
        </form>
         
         
         <?php         
             
         $emailTypeService->displayEmailsActions();
                          
         ?>
         <a href="email-test.php">Back to Main</a>         
    </body>
</html>