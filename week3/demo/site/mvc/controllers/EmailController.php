<?php
namespace APP\controller;
//needs these interfaces that ensure all necessary methods are in this class
use App\models\interfaces\IController;
use App\models\interfaces\IService;

class EmailController extends BaseController implements IController
{
    protected $service;
    
    //dependency injection of the emailservice 
    public function __construct( IService $EmailService  ) {                
        $this->service = $EmailService;  
    }
    
    public function execute(IService $scope) {
        //refers to the email view page
        $viewPage = 'email';
        
        //puts the email model into the data 'model' key inherited from the base controller
        $this->data['model'] = $this->service->getNewEmailModel();
        $this->data['model']->reset();
        
        //checks if something is being posted
        if ( $scope->util->isPostRequest() ) {
            //checking the actions sent from the form, then gets values from scope
            
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
        
        //gets all of the data from this and puts it into scope->view
        $scope->view = $this->data;
        //returns the page with all of the stuff in scope
        return $this->view($viewPage,$scope);
    }
    
}

?>

