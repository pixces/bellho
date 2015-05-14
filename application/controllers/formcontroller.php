<?php

/**
 * Created by PhpStorm.
 * User: zainulabdeen
 * Date: 14/05/15
 * Time: 1:18 AM
 */
class FormController extends Controller
{

    protected $_maxLimit = 100;
    protected $_currentPage = 1;

    /**
     * Before Action
     */
    public function beforeAction()
    {
        parent::beforeAction();
    }

    /**
     * After Action only
     */
    public function afterAction()
    {
        $this->set_pageTitle('Moderate Forms');
    }

    public function index()
    {
        #default display only new posts
        $statusList = array('new', 'approved', 'rejected', 'all');
        $status = 'new';

        if (func_num_args()) {
            $arg = func_get_args();
            if (in_array(func_get_arg(0), $statusList)) {
                $status = $arg[0];
                if ($arg[1]) {
                    $this->_currentPage = $arg[1];
                }
            } else {
                $this->_currentPage = $arg[0];
            }
        }

        #get the count of all post status
        #not including the deleted posts

        $model = Model::getRepository('Form');
        $formCount = $model->getFormCount();

        if ($formCount > 0) {

            //set the current offset to get the full list
            $model->setOffset(($this->_currentPage - 1) * $model->getLimit());

            //get the forms for the page;
            $formList = $model->getAll();

            if ($formList){
                $formCollection = array();
                foreach($formList as $entity){
                    $formCollection[$entity->id] = array(
                        'id' => $entity->id,
                        'title' => $entity->title,
                        'details' => json_decode($entity->form_json, true),
                        'date' => $entity->date_created
                    );
                }
            }

            //get total forms
            $totalPages = ceil($formCount / $model->getLimit());
            #map the pagination values
            $pager = array(
                'current' => $this->_currentPage,
                'totalPages' => $totalPages,
                'min_offset' => (($this->_currentPage - 1) * $model->getLimit()) + 1,
                'max_offset' => $this->_currentPage * $model->getLimit(),
                'max_post' => $model->getLimit() * $totalPages,
                'prev' => ($this->_currentPage - 1) <= 0 ? 1 : $this->_currentPage - 1,
                'next' => ($this->_currentPage + 1 > $totalPages) ? $totalPages : $this->_currentPage + 1
            );
            $this->set('pager', $pager);
            $this->set('formCount', $formCount);
            $this->set('formCollection', $formCollection);
        } else {
            $this->set('formCount', 0);
        }
    }

    public function api_post()
    {
        $this->doNotRenderHeader = true;
        try {
            $this->isValidPost($this->_method);

            //format the data
            $data = json_decode(file_get_contents('php://input'), true);

            //resolve this as a simple keyvalue
            $list = array();
            foreach($data as $item){
                $list[$item['name']] = $item['value'];
            }

            if ($this->validate($list)) {
                $form = new Form();
                $form->setTitle(trim($list['title']));

                //remove the title before encoding this
                unset($list['title']);
                $form->setFormJson(json_encode($list));

                $result = Model::getRepository('Form')->save($form);
                if ($result) {
                    $this->set('data', array('code' => 200, 'status' => 'success', 'message' => 'Form data added successfully'));
                } else {
                    $this->set('data', array('code' => 200, 'status' => 'failure', 'message' => 'Cannot add form data'));
                }
            }
        } catch (Exception $e) {
            $this->set('data', array('Code' => 400, 'status' => 'Error', 'message' => $e->getMessage(), 'trace' => var_export($e, true)));
        }
    }

    public function api_get()
    {
        $this->doNotRenderHeader = true;
        try {
            $this->isValidGet($this->_method);

            $callback = isset($this->_request['callback']) ? $this->_request['callback'] : null;

            if (!is_null($callback)){
                $this->set('callback',$callback);
            }

            if (isset($this->_request['params'])){
                //format the data
                $data = json_decode($this->_request['params'], true);

                if (isset($data) && !empty($data)){
                    //resolve this as a simple keyvalue
                    $list = array();
                    foreach($data as $item){
                        $list[$item['name']] = $item['value'];
                    }

                    if ($this->validate($list)) {
                        $form = new Form();
                        $form->setTitle(trim($list['title']));

                        //remove the title before encoding this
                        unset($list['title']);
                        $form->setFormJson(json_encode($list));

                        $result = Model::getRepository('Form')->save($form);
                        if ($result) {
                            $this->set('data', array('code' => '200', 'status' => 'success', 'message' => 'Form data added successfully'));
                        } else {
                            $this->set('data', array('code' => '200', 'status' => 'failure', 'message' => 'Cannot add form data'));
                        }
                    }
                } else {
                    $this->set('data', array('Code' => '400', 'status' => 'Error', 'message' => 'Payload type mismatch. Excepted JSON' ));
                }
            } else {
                $this->set('data', array('Code' => '400', 'status' => 'Error', 'message' => 'Payload missing from the request' ));
            }

        } catch (Exception $e) {
            $this->set('data', array('Code' => '400', 'status' => 'Error', 'message' => $e->getMessage(), 'trace' => var_export($e, true)));
        }
    }

    private function isValidPost($sHeader)
    {
        if ($sHeader != 'POST') {
            throw new Exception('Only POST & PUT request methods allowed');
            return false;
        }
        return true;
    }

    private function isValidGet($sHeader)
    {
        if ($sHeader != 'GET') {
            throw new Exception('Only GET request methods allowed');
            return false;
        }
        return true;
    }

    private function validate(array $aFormData)
    {
        if (trim($aFormData['title'])) {
            return true;
        } else {
            throw new Exception("Mandatory fields 'TITLE' missing");
            return false;
        }
    }

} 