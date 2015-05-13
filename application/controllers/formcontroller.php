<?php
/**
 * Created by PhpStorm.
 * User: zainulabdeen
 * Date: 14/05/15
 * Time: 1:18 AM
 */

class FormController extends Controller {

    protected $_maxLimit = 100;
    protected $_currentPage = 1;

    /**
     * Before Action
     */
    public function beforeAction(){
        parent::beforeAction();
    }

    /**
     * After Action only
     */
    public function afterAction(){
        $this->set_pageTitle('Moderate Posts');
    }

    public function api_form(){
        
    }

} 