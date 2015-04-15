<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php include './bootstrap.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        
        <?php
       
        /* Start by creating the classes and files you need
         * 
         */
$util = new Util();
$validator = new Validator();
//instance of emailTypeDB class
$emailTypeDB = new EmailTypeDB();


$emailType = filter_input(INPUT_POST, 'txtEmailType');
// We use errors to add issues to notify the user
$errors = array();
/*
 * We setup this config to get a standard database setup for the page
 */
//Now I am using the correct database name
$dbConfig = array(
        "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=phpadvclassspring2015',
        "DB_USER"=>'root',
        "DB_PASSWORD"=>''
        );
$pdo = new DB($dbConfig);
$db = $pdo->getDB();
//var_dump($db);
/*
 * we utilize our classes to have less code on the page
 * 
 */
if ( $util->isPostRequest() ) {
    // we validate only if a post has been made
    if ( !$validator->emailTypeIsValid($emailType) ) {
        $errors[] = 'Email type is not valid';
    }
    
    
    
    
    // if there are errors display them
    if ( count($errors) > 0 ) {
        foreach ($errors as $value) {
            echo '<p>',$value,'</p>';
        }
    } else {
        //if no errors, save to to database.
        //calling the saveAnEmailType function
        $emailTypeDB->saveAnEmailType($emailType);
        
        
    }
    
    
}
    
       
        ?>
        
         <h3>Add Email type</h3>
        <form action="#" method="post">
            <label>Email Type:</label> 
            <input type="text" name="txtEmailType" value="<?php echo $emailType; ?>" placeholder="" />
            <input type="submit" value="Submit" />
        </form>
         
         
    <?php 
        //here is my reference to the class-based function
       $results = $emailTypeDB->getAllRows();
       //outputs the rows in the database
    foreach ($results as $value) 
        {
            //only displays the email types in bold if active
            if($value['active']== "1")
            {
                echo '<p><strong>', $value['emailtype'], '</strong></p>';
            }
            else
            {
                echo '<p>', $value['emailtype'], '</p>';  
            }
        }
//        echo(var_dump($results));
    
//    // lets get the database values and display them
//    $stmt = $db->prepare("SELECT * FROM emailtype where active = 1");
//    if ($stmt->execute() && $stmt->rowCount() > 0) {
//        /*
//         * There is fetchAll which gets all the values and
//         * fetch which gets one row.
//         */
//        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//        //results returns as a assoc array
//        //you can run the next line to see the variable
//        //var_dump($results)
//        
//    } else {
//        echo '<p>No Data</p>';
//    }
    ?>
         
         
         
    </body>
</html>