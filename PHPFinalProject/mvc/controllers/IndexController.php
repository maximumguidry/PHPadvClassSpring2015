<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexController
 *
 * @author User
 */

namespace APP\controller;

use App\models\interfaces\IController;
use App\models\interfaces\IService;

class IndexController extends BaseController implements IController {
   

    public function __construct( ) {        
    }


    public function execute(IService $scope) {                  
        
        
        $viewPage = 'index';
        
        if ($scope->util->isPostRequest() ) {
            if ( $scope->util->getAction() == 'sessionDestroy' ) {                
                session_destroy();
                 $scope->util->redirect('login.php');
            }
            
        }
        $scope->view = $this->data;
        return $this->view($viewPage,$scope);
        
    }
    
    
}
