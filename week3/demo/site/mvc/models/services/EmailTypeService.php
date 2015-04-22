<?php
namespace App\models\services;

use App\models\interfaces\IDAO;
use App\models\interfaces\IService;
use App\models\interfaces\IModel;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailTypeService
 *
 * @author 001332825
 */
class EmailTypeService implements IService{
    function getEmail() {
        return 'test@test.com';
    }


}
