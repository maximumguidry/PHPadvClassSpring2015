<?php
namespace APP\controller;

use App\models\interfaces\IController;
use App\models\interfaces\IService;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EmailTypeController extends BaseController implements IController {
    
    public function __construct( IService $EmailTypeService ) {                
        $this->service = $EmailTypeService;     
        
    }
    
    public function execute(IService $scope) {
        $viewPage = 'emailtype';
        
        //$this->data['email'] = $this->emailTypeService
        
        return $this->view($viewPage,$scope);
    }
}
?>

