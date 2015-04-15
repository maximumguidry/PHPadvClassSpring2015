<?php

    class EmailTypeDB {
        
        


        
// lets get the database values and display them
        public function saveAnEmailType()
        {
            $emailType = filter_input(INPUT_POST, 'txtEmailType');    
            
            $dbConfig = array(
            "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=phpadvclassspring2015',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>''
            );
            $pdo = new DB($dbConfig);
            $db = $pdo->getDB();
            
            $stmt = $db->prepare("INSERT INTO emailtype SET emailtype = :emailtype"); 
            $values = array(":emailtype"=>$emailType);
            if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) {
                echo 'Email type Added';
            }    
            else
            {
                echo 'Email not Added';   
            }
            
        }
        
        public function getAllRows()
        {
            //$emailType = filter_input(INPUT_POST, 'txtEmailType');    
            $dbConfig = array(
            "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=phpadvclassspring2015',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>''
            );
            $pdo = new DB($dbConfig);
            $db = $pdo->getDB();
            $stmt = $db->prepare("SELECT * FROM emailtype");
            if ($stmt->execute() && $stmt->rowCount() > 0) {
                /*
                 * There is fetchAll which gets all the values and
                 * fetch which gets one row.
                 */
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                //results returns as a assoc array
                //you can run the next line to see the variable
                //var_dump($results)

            } else {
                 '<p>No Data</p>';
            }
            return $results;
        }
    }
    ?>
