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
/*
 * When dealing with forms always collect the data before trying to validate
 * 
 * When getting values from $_POST or $_GET use filter_input
 */
$phoneType = filter_input(INPUT_POST, 'phonetype');
// We use errors to add issues to notify the user
$errors = array();
/*
 * We setup this config to get a standard database setup for the page
 */
$dbConfig = array(
        "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
        "DB_USER"=>'root',
        "DB_PASSWORD"=>''
        );
$pdo = new DB($dbConfig);
$db = $pdo->getDB();
/*
 * we utilize our classes to have less code on the page
 * 
 */
if ( $util->isPostRequest() ) {
    // we validate only if a post has been made
    if ( !$validator->phoneTypeIsValid($phoneType) ) {
        $errors[] = 'Phone type is not valid';
    }
    
    
    
    
    // if there are errors display them
    if ( count($errors) > 0 ) {
        foreach ($errors as $value) {
            echo '<p>',$value,'</p>';
        }
    } else {
        //if no errors, save to to database.
        $stmt = $db->prepare("INSERT INTO emailtype SET phonetype = :phonetype");  
        $values = array(":phonetype"=>$phoneType);
        if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) {
            echo 'Phone Added';
        }       
    }
    
    
}
    
        
        
       
        ?>
        
         <h3>Add phone type</h3>
        <form action="#" method="post">
            <label>Phone Type:</label> 
            <input type="text" name="phonetype" value="<?php echo $phoneType; ?>" placeholder="" />
            <input type="submit" value="Submit" />
        </form>
         
         
    <?php 
       
    // lets get the database values and display them
    $stmt = $db->prepare("SELECT * FROM phonetype where active = 1");
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        /*
         * There is fetchAll which gets all the values and
         * fetch which gets one row.
         */
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // results returns as a assoc array
        // you can run the next line to see the variable
        // var_dump($results)
        foreach ($results as $value) {
            echo '<p>', $value['phonetype'], '</p>';
        }
    } else {
        echo '<p>No Data</p>';
    }
    ?>
         
         
         
    </body>
</html>