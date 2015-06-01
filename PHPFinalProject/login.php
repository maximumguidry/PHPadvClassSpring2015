<?php include './bootstrap.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="mvc/views/style.css">
        <title></title>
    </head>
    <body>
        <?php
         $util = new Util();
            
            if ( $util->isPostRequest() ) {
                $db = new DB($dbConfig); 
                $model = new SignupModel();
                $signupDao = new SignupDAO($db->getDB(), $model);            

                $model->map(filter_input_array(INPUT_POST));
                                
                if ( $signupDao->login($model) ) {
                    echo '<h2>Login Sucess</h2>';
                    $util->setLoggedin(true);
                    $util->redirect('index.php');
                } else {
                    echo '<h2>Login Failed</h2>';
                }
            }
        ?>
        <nav>
            <a href="index.php">Index</a>
            <a href="restaurants">Restaurants</a>
            <a href="items">Dishes and Items</a>
        </nav>
         <h1>Login</h1>
         <p>*You must be logged in to perform database operations*</p>
        <form action="#" method="POST" class="frmInput">
            
            Email : <br /><input type="email" name="email" value="" /> <br />
            Password : <br /><input type="password" name="password" value="" /> <br /> 
            <br />
            <input type="submit" value="Log In" />
            
        </form>
    </body>
</html>
