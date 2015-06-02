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
        //needs the utility Class to check and set Session['loggedin'] values
         $util = new Util();
            //checks if the request is a post so it can set the model and DAO because it will be handling that kind of data from the form
            if ( $util->isPostRequest() ) {
                //instantiating models
                $db = new DB($dbConfig); 
                $model = new SignupModel();
                $signupDao = new SignupDAO($db->getDB(), $model);            
                //maps the values sent by the post
                $model->map(filter_input_array(INPUT_POST));
                                
                if ( $signupDao->login($model) ) {
                    //verifies a match for email and password by passing the data in model to the login functio of the
                    //SignupDao
                    echo '<h2>Login Sucess</h2>';
                    //sets the session['loggedin'] to true and redirects to the index
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
