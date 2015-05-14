<?php

Abstract class Controller
{
    protected $_controller;
    protected $_action;
    protected $_template;
    protected $_pageTitle;
    protected $_pageType;
    protected $_level1_sef;
    protected $_method;
    protected $_request;
    protected $_is_api = false;
    public $doNotRenderHeader;
    public $render;

    function __construct($controller, $action)
    {
        /*
        #define request methods and request params
        #to handle CORS
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');
        header("Access-Control-Allow-Headers: X-Requested-With");

        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        }
        */

        if (isset($_REQUEST['request_type']) && $_REQUEST['request_type'] == 'api'){
            //header('content-type: application/json; charset=utf-8');
            $this->_is_api = true;
        }

        $this->_method = $_SERVER['REQUEST_METHOD'];
        if ($this->_method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
            if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
                $this->_method = 'DELETE';
            } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
                $this->_method = 'PUT';
            } else {
                throw new Exception("Unexpected Header");
            }
        }

        if ($this->_method == 'GET'){
            $this->_request = $_REQUEST;
        }


        /*
        switch($this->method) {
            case 'DELETE':
            case 'POST':
            case 'GET':
                $this->request = $this->_cleanInputs($_GET);
                break;
            case 'PUT':
                $this->request = $this->_cleanInputs($_GET);
                $this->file = file_get_contents("php://input");
                break;
            default:
                $this->_response('Invalid Method', 405);
                break;
        }   */


        global $inflect;
        $this->_controller = ucfirst($controller);
        $this->_action = $action;

        $model = ucfirst($inflect->singularize($controller));
        $this->doNotRenderHeader = 0;
        $this->render = 1;

        $this->_loadModel($model);
        $this->_template = new Template($controller, $action);

        //set the default page type to be the controller name
        $this->set_pageType(strtolower($this->_controller));
    }

    function set($name, $value)
    {
        $this->_template->set($name, $value);
    }

    function setTemplate($template){
        $this->_template->setTemplate($template);
    }

    function __destruct()
    {
        if ($this->render) {
            if ($this->_is_api){
                $this->_template->renderJson();
            } else {
                $this->_template->render($this->doNotRenderHeader);
            }
        }
    }

    function _loadModel($model)
    {
        if (file_exists(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($model) . '.php')) {
            $this->$model = new $model;
        }
    }

    public function getNavigation() {
        $navigation = array(
            'stream' => array('url' => SITE_URL . '/stream/', 'name' => 'Social Stream'),
            'post' => array('url' => SITE_URL . '/post/', 'name' => 'Social Posts'),
            'form' => array('url' => SITE_URL . '/form/', 'name' => 'Forms'),
        );
        return $navigation;
    }

    public function beforeAction(){

        if (!$this->_is_api){
            //get user auth details;
            $auth = $this->getAuth();
            Logger::log( var_export($auth, true) );

            /*
            if ( !in_array($this->_action, array('login')) ){
                if (!$auth){
                    //default /index/login
                    header("location: " . SITE_URL );
                    exit;
                }
            }*/

            //set the navigation
            $this->set("navigation", $this->getNavigation());

            //do not render template is it is an ajax call
            if ($this->_request['is_ajax']) {
                $this->doNotRenderHeader = true;
            }
        }

    }

    public function afterAction(){}

    public function set_pageType($type)
    {
        $this->set('pageType',$type);
    }

    public function set_pageTitle($title)
    {
        $this->set('pageTitle',$title);
    }

    public function getAuth(){
        if (isset($_SESSION['auth'])){
            if (!empty($_SESSION['auth']['name']) && isset($_SESSION['auth']['id'])){
                return $_SESSION['auth'];
            }
        } else {
            return false;
        }
    }

}