<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="mvc/views/style.css">
        <meta charset="UTF-8">
        <title>Main Page</title>
    </head>
    <body>
        <h1>Welcome!</h1>
        <br />
        <br />
        <h2>What would you like to add or edit?</h2>
        <hr />
        
        <?php
        // Put code here
        if ( !$scope->util->isLoggedin() ) {
               echo("<p>*You are not logged in.*</p>".
                       "<p>*You must be logged in to perform database operations.*</p>");
            } 
            else {
                echo('<p>*You are logged in.*</p>');
                echo('<form action="#" method="post" class="frmAddPg">
            <input type="hidden" name="action" value="sessionDestroy" />
            <input type="submit" value="Log Out" class="sbmtAdd"/> 
            </form>');
            }
            
        ?>
        <br />
        <div id="aMainLinks">
            <span id="spMainlinks">
                <a href="restaurants">Restaurants</a> <br />
                <a href="items">Dishes and Items</a> <br />
                <a href="login.php">Log in</a> <br />
                <a href="signup.php">Sign up</a> <br />
            </span>
        </div>
        
    </body>
</html>
