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
        $this->doNotRenderHeader = true;
        $status = $message ='';
        $get = $_POST;
        if (!$get){
            $status = 'error';
            $message = 'Only POST Method allowed for Publish.';
            
        }else{
            
            if(!isset($get['title']) || empty($get['title']) ){
                $status = 'error';
                $message = 'Mandatory Field Title is Missing.';
            }else{
                $form = new Form();
                $form->setTitle($get['title']);
                $params = array();
                foreach ($get as $key =>$data){
                    if($key != 'title'){
                        $params[$key]=$data;
                    }
                }
                $form->setFormJson(json_encode($params));
                #execute login process
                $model = new FormRepository('Form');
                $model->save($form);
                $status = 'success';
                $message = 'Form Data Submitted.';
            }
        
        }
        echo json_encode(array('status' => $status, 'message' => $message));
        exit;

    }

} 