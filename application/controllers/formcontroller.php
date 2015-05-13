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
        $this->set_pageTitle('Moderate Forms');
    }

 public function index(){
      #by default get all posts
        #other options
        #   - all new
        #   - all approved

        #default display only new posts
        $statusList = array('new','approved','rejected','all');
        $status = 'new';

        if (func_num_args()){
            $arg = func_get_args();
            if (in_array(func_get_arg(0), $statusList)){
                $status = $arg[0];
                if ($arg[1]){
                    $this->_currentPage = $arg[1];
                }
            } else {
                $this->_currentPage = $arg[0];
            }
        }

        #get the count of all post status
        #not including the deleted posts
        
        $model = new FormRepository('Form');
        $post_summary = $model->getFormCount();
        
        if ($post_summary > 0){
            $model->setOffset(($this->_currentPage - 1) * $model->getLimit() );


            //get the forms for the page;
            $formList = $model->getAll();
            //get total forms
            $totalPages = ceil( $post_summary/$model->getLimit() );
            #map the pagination values
            $pager = array(
                'current'       => $this->_currentPage,
                'totalPages'    => $totalPages,
                'min_offset'    => (($this->_currentPage - 1) * $model->getLimit()) + 1,
                'max_offset'    => $this->_currentPage * $model->getLimit(),
                'max_post'      => $model->getLimit() * $totalPages,
                'prev'          => ($this->_currentPage - 1) <= 0 ? 1 : $this->_currentPage - 1,
                'next'          => ($this->_currentPage + 1 > $totalPages) ? $totalPages : $this->_currentPage + 1
            );
            $this->set('pager',$pager);
            $this->set('post_summary',$post_summary);
            $this->set('postList',$formList);
        } else {
            $this->set('post_summary', 0);
        }
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