<?php
namespace APP\controller;
use App\models\interfaces\Icontroller;
use App\models\interfaces\IService;

class EmailController extends BaseController implements IController
{
    protected $service;
    
    public function __construct( IService $EmailService  ) {                
        $this->service = $EmailService;  
    }
    
    public function execute(IService $scope) {
        //I'll make this later
        $viewPage = 'email';
        
        //I still need to make this in the email model
        $this->data['model'] = $this->service->getNewEmailModel();
        $this->data['model']->reset();
        
        if ( $scope->util->isPostRequest() ) {
            
            
            if ( $scope->util->getAction() == 'create' ) {
                $this->data['model']->map($scope->util->getPostValues());
                $this->data["errors"] = $this->service->validate($this->data['model']);
                $this->data["saved"] = $this->service->create($this->data['model']);
            }
            
            if ( $scope->util->getAction() == 'edit' ) {
                $viewPage .= 'edit';
                $this->data['model'] = $this->service->read($scope->util->getPostParam('emailid'));
                  
            }
            
            if ( $scope->util->getAction() == 'delete' ) {
                //looking for email id from scope if delete button pressed
                $this->data["deleted"] = $this->service->delete($scope->util->getPostParam('emailid'));
            }
            
             if ( $scope->util->getAction() == 'update'  ) {
                 //gets the model when update button is pressed, but first it needs to pass validation before updating
                $this->data['model']->map($scope->util->getPostValues());
                $this->data["errors"] = $this->service->validate($this->data['model']);
                $this->data["updated"] = $this->service->update($this->data['model']);
                 $viewPage .= 'edit';
            }
            
            
        }
        
        //gets all email types
        $this->data['emailTypes'] = $this->service->getAllEmailTypes(); 
        $this->data['emails'] = $this->service->getAllEmails(); 
        
        $scope->view = $this->data;
        return $this->view($viewPage,$scope);
    }
    
}

?>

