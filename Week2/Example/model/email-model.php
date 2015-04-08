<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
         include './EmailModel.php';
         
         $emailmodel = new EmailModel();
         $emailmodel->setEmail('test@test.com');
         
         echo $emailmodel->getEmail();
         
        ?>
    </body>
</html>
