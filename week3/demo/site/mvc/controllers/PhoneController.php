<?php
/**
 * Description of PhoneController
 *
 * @author GFORTI
 */

namespace APP\controller;

use App\models\interfaces\IController;
use App\models\interfaces\IService;

class PhoneController extends BaseController implements IController {
   
    protected $service;
    
    public function __construct( IService $PhoneService  ) {                
        $this->service = $PhoneService;  
    }
    
    public function execute(IService $scope) {
        $viewPage = 'phone';
        
        $this->data['model'] = $this->service->getNewPhoneModel();
        $this->data['model']->reset();
        
        if ( $scope->util->isPostRequest() ) {
            
            
            if ( $scope->util->getAction() == 'create' ) {
                $this->data['model']->map($scope->util->getPostValues());
                $this->data["errors"] = $this->service->validate($this->data['model']);
                $this->data["saved"] = $this->service->create($this->data['model']);
            }
            
            if ( $scope->util->getAction() == 'edit' ) {
                $viewPage .= 'edit';
                $this->data['model'] = $this->service->read($scope->util->getPostParam('phoneid'));
                  
            }
            
            if ( $scope->util->getAction() == 'delete' ) {                
                $this->data["deleted"] = $this->service->delete($scope->util->getPostParam('phoneid'));
            }
            
             if ( $scope->util->getAction() == 'update'  ) {
                $this->data['model']->map($scope->util->getPostValues());
                $this->data["errors"] = $this->service->validate($this->data['model']);
                $this->data["updated"] = $this->service->update($this->data['model']);
                 $viewPage .= 'edit';
            }
            
            
        }
        
        
        $this->data['phoneTypes'] = $this->service->getAllPhoneTypes(); 
        $this->data['phones'] = $this->service->getAllPhones(); 
        
        $scope->view = $this->data;
        return $this->view($viewPage,$scope);
    }
    
}
