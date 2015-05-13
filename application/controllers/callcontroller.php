<?php
/**
 * Controller to make calls to social media to fetch new posts
 *
 * Secheduled to run as a Scheduler / Cron Job
 * Frequency of Run 1 min;
 *
 * Fetch Json response from the SocialMedia
 * Paser and save the posts
 *
 *
 * @date 8 May 2015
 * @author Zainul Abdeen
 * Copyright Slice@position2.com
 */

class CallController extends Controller {

    protected $stream_id;

    public function makeCalls(){

        $this->doNotRenderHeader = true;

        //get the list of all calls to be made
        //i.e., nex call time < =  now
        //also update next call to time+frequency
        $callTime = time();
        $model = new CallRepository('Call');
        $callList = $model->getCallList();

        if($callList){

            foreach($callList as $call){
                echo "--- Started making calls ----<br>";
                echo $call->source.": ".urldecode($call->keyword_string)."<br>";

                //processing the call
                $process = $this->processCall($call);

                //update the call details if process is successful
                if ($process){
                    $call->setLastCallTime($callTime);
                    $call->setNextCallTime($callTime+$call->frequency);

                    $model = new CallRepository('Call');

                    //update the details
                    $model->save($call);
                }
                echo "--- End Calls ----<br>";
            }
        }  else {
            echo "No New call to be initiated<br>";
        }
        exit;
    }


    private function processCall($call){

        //set global stream id to be used in other
        //methods calls
        $this->stream_id = $call->stream_id;

        //make call to the respective api
        //to get the latest feeds
        $source = $call->source;

        $sourceObj = Social_Factory::sourceCall_Factory($source);
        $jsonData = $sourceObj->getFeed($call);

        if ($jsonData){

            //parse this json to get postarray for saving to database
            $dataArray = $this->parseJson($jsonData,$call->source);

            if ($dataArray){
                //save all these data to file
                if ($this->savePost($dataArray) ){
                    return true;
                }
            }
        }
        return false;
    }

    private function parseJson($json,$type){

        $parserObj = Social_Factory::parser_factory($type);
        $postsArr = $parserObj->parseJson($json);

        if ($postsArr){
            return $postsArr;
        } else {
            echo "No post found in feed after parsing"."<br>";
            return false;
        }
    }


    private function savePost(array $posts){

        #add other common data to the posts
        if ($posts){
            $postList = array();
            foreach($posts as $post){
                $post['stream_id'] = $this->stream_id;
                $post['post_hash'] = md5($this->stream_id."|".$post['post_id']."|".$post['date_published']);
                $postList[] = new Post($post);
            }
            $model = new PostRepository('Post');
            if ( $model->saveAll($postList) ){
                echo "All posts saved to database"."<br>";
                return true;
            } else {
                echo "Cannot save posts to database"."<br>";
                return false;
            }
        }
    }





}
