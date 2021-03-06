<?php

namespace App\models\services;

use App\models\interfaces\IController;
use App\models\interfaces\ILogging;
use App\models\interfaces\IService;
use Exception;

 final class Index {
     
    
    protected $DI = array();
    protected $log = null;

    //gets the log to be used for error logging and whatnot 
    protected function getLog() {
        return $this->log;
    }

    //sets the log to be used for error logging and whatnot
    public function setLog(ILogging $log) {       
        $this->log = $log;
    }
     
    //a function that gets the name of the controller based on what the 
    public function addDIController($page, $func) {
         $this->DI[$this->getPageController($page)] = $func;
         return $this;
     }
          /**
         * System config.
         */
        public function __construct() {
            // error reporting - all errors for development (ensure you have display_errors = On in your php.ini file)
            error_reporting(E_ALL | E_STRICT);
            mb_internal_encoding('UTF-8');
            set_exception_handler(array($this, 'handleException'));
            spl_autoload_register(array($this, 'loadClass'));
            // session
            session_start();
            session_regenerate_id(true);
            
            $this->DI = array();
        }

        /**
         * Run the application!
         */
        public function run(IService $scope) {  
            $page = $this->getPage();
            if ( !$this->runController($page,$scope) ) {
                throw new ControllerFailedException('Controller for page "' . $page . '" failed');               
            }          
        }
        
        
        protected function runController($page, IService $scope) {
                       
            $class_name = $this->getPageController($page);
            $controller = NULL;
                       
            
            if (array_key_exists($class_name,$this->DI)) {                
                $controller = $this->DI[$class_name]();                
            } else { 
                $class_name = "APP\\controller\\$class_name";
                if (class_exists($class_name)) {
                    $controller = new $class_name();
                    
                }
            }
            
            if ( $controller instanceof IController ) {
                return $controller->execute($scope);
            }
                        
            return false;
        }
               
        /**
         * Exception handler.
         */
        public function handleException(Exception $ex) {     
            
            if ($ex instanceof PageNotFoundException) {  
                $this->getLog()->logException($ex->getMessage());                
            } else {
                // TODO log exception
               $this->getLog()->logException($ex->getMessage());               
            }
             
             $this->redirect('page404',array("error"=>$ex->getMessage()));
            
        }

        /**
         * Class loader.
         */
        public function loadClass($base) {
            //sets the base file path to add files to
            $baseName = explode( '\\', $base );
            $className = end( $baseName );     
            //makes an array of folders where all model and controller files are stored
            $folders = array(   "mvc".DIRECTORY_SEPARATOR."controllers",
                                "mvc".DIRECTORY_SEPARATOR."models".DIRECTORY_SEPARATOR."helpers",
                                "mvc".DIRECTORY_SEPARATOR."models".DIRECTORY_SEPARATOR."dao",
                                "mvc".DIRECTORY_SEPARATOR."models".DIRECTORY_SEPARATOR."do",
                                "mvc".DIRECTORY_SEPARATOR."models".DIRECTORY_SEPARATOR."interfaces",
                                "mvc".DIRECTORY_SEPARATOR."models".DIRECTORY_SEPARATOR."exceptions",
                                "mvc".DIRECTORY_SEPARATOR."models".DIRECTORY_SEPARATOR."services"
                            );
            $classFile = FALSE;
            //adds a class name to each folder in the folders array
            foreach($folders as $folder) {
                $classFile = $folder.DIRECTORY_SEPARATOR.$className.'.php';                
                if ( is_dir($folder) &&  file_exists( $classFile ) ) {
                    require_once $classFile;
                    break;
                } 
            }  
             
        }
              
        //gets the name of the page.  It it's not set, it sets the page to index
        protected function getPage() {
            $page = filter_input(INPUT_GET, 'page');            
            if ( NULL === $page || $page === FALSE ) {
                $page = 'index';
            }
            return $this->checkPage($page);
        }
        
        //gets the controller based on the name of the page
        protected function getPageController($page) {
            return ucfirst(strtolower($page)).'Controller';
        }
        //checks to make sure the page is a valid value
        protected function checkPage($page) {            
            if ( !( is_string($page) && preg_match('/^[a-z0-9-]+$/i', $page) != 0 ) ) {
                // TODO log attempt, redirect attacker, ...
               throw new PageNotFoundException('Unsafe page "' . $page . '" requested');
            }        
            
            return $page;
        }
        
        
        
        
    /**
     * Generate link.
     * @param string $page target page
     * @param array $params page parameters
     */
    public function createLink($page, array $params = array()) {        
        return $page . '?' .http_build_query($params);
    }
    
     /**
     * Redirect to the given page.
     * @param type $page target page
     * @param array $params page parameters
     */
    public function redirect($page, array $params = array()) {
        header('Location: ' . $this->createLink($page, $params));
        die();
    }

}



       
    //http://php.net/manual/en/language.oop5.typehinting.php
    function runPage() {
        $_configURL = '.' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.ini.php';
        $index = new Index();

        /*
         * Functions to use for Dependency Injection
         */
        $_config = new Config($_configURL);
        $_log = new FileLogging();
        $index->setLog($_log);
        $_pdo = new DB($_config->getConfigData('db:dev'), $_log);
        $_scope = new Scope();
        $_scope->util = new Util();
        $_validator = new Validator();
        
        
        $_restaurantmodel = new RestaurantModel();
        $_itemmodel = new ItemModel();
        
        //constructor for the DAO's getting the correct DB, logs, and models for each DAO
        $_restaurantDAO = new RestaurantDAO($_pdo->getDB(), $_restaurantmodel, $_log);
        $_itemDAO = new ItemDAO($_pdo->getDB(), $_itemmodel, $_log);
        
 
        
        $_restaurantService = new RestaurantService($_restaurantDAO, $_validator, $_restaurantmodel);
        $_itemService = new ItemService($_itemDAO, $_restaurantService, $_validator, $_itemmodel);
        
        //http://php.net/manual/en/functions.anonymous.php
        
        $index->addDIController('index', function() {            
            return new \APP\controller\IndexController();
        })
        ->addDIController('restaurants', function()  use ($_restaurantService ){           
            return new \APP\controller\RestaurantController($_restaurantService);
        })
        ->addDIController('items', function()  use ($_itemService ){           
            return new \APP\controller\ItemController($_itemService);
        })
        
        ;
        // run application!
        $index->run($_scope);
    }
    
    runPage();
    