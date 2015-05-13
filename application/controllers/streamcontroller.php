<?php
/**
 * Controller to setup a stream to fetch post from Various soical media
 *
 * @date 8 May 2015
 * @author Zainul Abdeen
 * Copyright Slice@position2.com
 */
class StreamController extends Controller {

    CONST TW_API_URL = 'https://api.twitter.com/1.1/search/tweets.json';
    CONST FB_API_URL = 'https://graph.facebook.com/search';
    CONST GP_API_URL = 'https://plus.google.com/search';

    protected $result_count = 100;
    protected $response = 'json';
    protected $callFrequency = array ('tw'=>3600, 'fb'=>3600, 'gp'=>3600);


    function beforeAction(){
        parent::beforeAction();
    }

    function afterAction(){
       $this->set_pageTitle('manage streams');
    }

    public function index(){

    }

    /**
     * AJAX Call
     * save form data to database
     * also create Call URLS and add them to database
     */
    public function addStream(){
        $this->doNotRenderHeader = true;
        if ($_POST && $_POST['formAction'] == 'doAddStream'){

            $data = $_POST;

            if (!isset($data['keyword']) || $data['keyword'] == ''){
                echo json_encode(array('status' => 'error', 'message' => 'No search keyword entered in form.' ));
                exit;
            }

            #check for sources
            #create call urls
            $keywordString = ($data['is_phrase'] == 'y') ? '"'.$data['keyword'].'"' : $data['keyword'];

            #$sources
            //twitter
            if ($data['is_twitter'] == 'y'){
                $kwString = $this->_createKwString($data,'twitter');
                $source['tw'] = $kwString;
            }

            $entity = new Stream($data);
            $model = new StreamRepository('Stream');

            if ($model->save($entity)){
                $id = $model->getLastInsertedId();
                $callData = array('stream_id' => $id, 'source' => $source);

                if ( $this->_saveCallDetails($callData) ){
                    echo json_encode(array('status' => 'success', 'message' => sprintf('Search keyword <b>\'%s\'</b> successfully added.', $data['keyword'])));
                } else {
                    //keywords was saved by
                    echo json_encode(array('status' => 'error', 'message' => sprintf('Search keyword <b>\'%s\'</b> successfully added, but Call Urls not added.', $data['keyword'])));
                }
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Cannot add search keyword to database.'));
            }
        }
        exit;
    }

    /**
     * Function to handle delete request.
     * Delete by Id
     *
     * @return JSON
     */
    public function delete(){
        $this->doNotRenderHeader = true;
        if ($_POST){
            if ($_POST['id']){
                $model = new StreamRepository('Stream');
                if ($model->delete($_POST['id'])){
                    echo json_encode(array('status' => 'success', 'message' => sprintf('Search keyword <b>\'%s\'</b> successfully deleted.', $_POST['name'])));
                    exit;
                }
            } else {
                //error no id present
                echo json_encode(array('status' => 'error', 'message' => 'Cannot delete search keyword.'));
            }
        }
        exit;
    }

    /**
     * Function to handle Change Status request.
     * Update the status in database
     *
     * @return JSON
     */
    public function change_status(){
        $this->doNotRenderHeader = true;
        if ($_POST && $_POST['id'] && $_POST['data']){

            $stream_id = $_POST['id'];
            $oldStatus = $_POST['data'];
            $keyword = $_POST['name'];
            $newStatus = ($oldStatus == 'active') ? 'inactive' : 'active';

            $model = new StreamRepository('Stream');
            $result = $model->updateStatus($stream_id,$newStatus);

            if ( $result === true ){
               echo json_encode(array('status' => 'success', 'message' => sprintf('Search keyword <b>\'%s\'</b> status updated to <b>\'%s\'</b>', $keyword,$newStatus), 'newstatus' => $newStatus));
            } else {
               echo json_encode(array('status' => 'error', 'message' => 'Cannot update search keyword status.'));
            }
            exit;
        }
    }

    /**
     * Method to get list of all added streams
     *
     * @return JSON
     */
    public function streamList(){
        $this->doNotRenderHeader = true;

        #get the list of streams
        $result = Model::getRepository('Stream')->fetchAll();

        if ($result){
            #total keyword count
            $listSize = count($result);

            #get total post count for each stream
            $this->set('count',$listSize);
            $this->set('list',$result);
        } else {
            $this->set('count',0);
        }
        exit;
    }

    /**
     * Method to get count of posts for a given stream
     */
    private function _getPostCount(){
        $post = new Post();
        $counts = $post->getCountByStream();
    }

    /**
     * Method to Create Keyword string
     * based on the source type
     *
     * @param $data
     * @param string $source
     * @return string
     */
    private function _createKwString($data,$source = 'twitter'){

        $keyword = $data['keyword'];
        $is_profile = $data['is_profile'] == 'y' ? true : false;
        $is_phrase = $data['is_phrase'] == 'y' ? true : false;
        $kwString = "";

        switch($source){
            case 'twitter':
                if ($is_profile){
                    $kwString = "from:".$keyword;
                } else if ($is_phrase){
                    $kwString = '"'.$keyword.'"';
                } else {
                    $kwString = $keyword;
                }
                break;
            case 'facebook':
            case 'gplus':
                if ($is_phrase){
                    $kwString = '"'.$keyword.'"';
                } else {
                    $kwString = $keyword;
                }
                break;
        }

        return urlencode($kwString);
    }

    /**
     * Method to save all Call details
     * @param $data
     * @return bool
     */
    private function _saveCallDetails($data){

        $callDetails = array();
        $source = $data['source'];
        foreach($data['source'] as $media => $kw){
            $callEntity = new Call();
            $callEntity->setStreamId($data['stream_id']);
            $callEntity->setSource( ($media == 'tw') ? 'twitter' : (($media == 'fb') ? 'facebook' : 'googleplus') );
            $callEntity->setKeywordString($kw);
            $callEntity->setBaseApiUrl(($media == 'tw') ? self::TW_API_URL : (($media == 'fb') ? self::FB_API_URL : self::GP_API_URL));
            $callEntity->setFrequency($this->callFrequency[$media]);
            $callEntity->setNextCallTime(time());
            $callEntity->setPostCount(25);

            $callDetails[] = $callEntity;
        }

        #save all these to database
        $model = new CallRepository('Call');

        if ( $model->saveAll($callDetails) ) {
           return true;
        } else {
           return false;
        }
    }

}
