<?php
/**
 * Created by PhpStorm.
 * User: zainulabdeen
 * Date: 09/05/15
 * Time: 11:18 PM
 */

class IndexController extends Controller {

    public function index(){
        header("location: " . SITE_URL );
        die();
    }

    public function login() {

        $this->doNotRenderHeader = 1;

        $this->checkIsLoggedIn();

        if ($_POST && $_POST['mm_action'] === 'doLogin') {
            try {
                #first validate posted data
                if ($this->validate($_POST)) {
                    #execute login process
                    $user = Model::getRepository('User')->doLogin($_POST['username'],$_POST['password']);
                    if ($user) {
                        $token = md5($user->username."|".time());

                        $_SESSION['auth'] = array(
                            'id'    => $user->id,
                            'token' => $token,
                            'name'  => $user->name,
                            'email' => $user->email,
                            'role'  => $user->role,
                        );

                        //redirect user
                        header("location: " . SITE_URL );
                        exit;
                    } else {
                        throw new Exception('Invalid login details. Please try again');
                    }
                }
            } catch (Exception $e) {
                Logger::log(__FILE__.":".__LINE__." ".json_encode(var_export($e,true)));
                $this->set('message', $e->getMessage());
            }
        }
    }

    public function logout(){
        unset($_SESSION['auth']);
        //redirect to the login page
        header("location: " . SITE_URL );
        die();
    }

    /**
     * @param $var
     * @return bool
     * @throws Exception
     */
    private function validate($var) {
        if (is_array($var)) {
            if (empty($var['username'])) {
                throw new Exception('Username field is empty');
            } else if (empty($var['password'])) {
                throw new Exception('Password field is empty');
            } else {
                return true;
            }
        } else {
            throw new Exception('Please enter login details');
        }
    }

    public function checkIsLoggedIn(){
        if ($this->getAuth()){
            //return to post url
            header("location: " . SITE_URL."/post/index" );
            die();
        }
    }

} 