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

    public function api_post(){

        $this->doNotRenderHeader = true;

        try{
            $this->isValidPost($this->_method);

            //format the data
            $data = json_decode(file_get_contents('php://input'),true);


            if ($this->validate($data)){
                $form = new Form();
                $form->setTitle(trim($data['title']));
                $form->setFormJson(json_encode($data));

                $result = Model::getRepository('Form')->save($form);
                if ($result){
                    $this->set('data',array('code'=>200, 'status'=>'success','message'=>'Form data added successfully'));
                } else {
                    $this->set('data',array('code'=>200, 'status'=>'failure','message'=>'Cannot add form data'));
                }
            }
        } catch (Exception $e){
            $this->set('data',array('Code'=>400, 'status'=>'Error','message'=>$e->getMessage(),'trace'=>var_export($e,true)));
        }
    }

    private function isValidPost($sHeader){
        if ($sHeader != 'POST'){
            throw new Exception('Only POST & PUT request methods allowed');
            return false;
        }
        return true;
    }

    private function validate(array $aFormData){
        if (trim($aFormData['title'])){
            return true;
        } else {
            throw new Exception("Mandatory fields 'TITLE' missing");
            return false;
        }
    }

} 