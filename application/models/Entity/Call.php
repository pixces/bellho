<?php
/**
 * Class Call
 */
class Call extends Entity {

    /**
     * @var
     */
    public $id;

    /**
     * @var
     */
    public $stream_id;

    /**
     * @var
     */
    public $source;

    /**
     * @var
     */
    public $keyword_string;

    /**
     * @var
     */
    public $base_api_url;

    /**
     * @var
     */
    public $post_count = 100;

    /**
     * @var
     */
    public $frequency = 3600;

    /**
     * @var
     */
    public $last_call_time;

    /**
     * @var
     */
    public $next_call_time;

    /**
     * @return mixed
     */
    public function getBaseApiUrl()
    {
        return $this->base_api_url;
    }

    /**
     * @return mixed
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getKeywordString()
    {
        return $this->keyword_string;
    }

    /**
     * @return mixed
     */
    public function getLastCallTime()
    {
        return $this->last_call_time;
    }

    /**
     * @return mixed
     */
    public function getNextCallTime()
    {
        return $this->next_call_time;
    }

    /**
     * @return mixed
     */
    public function getPostCount()
    {
        return $this->post_count;
    }

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @return mixed
     */
    public function getStreamId()
    {
        return $this->stream_id;
    }

    /**
     * @param mixed $base_api_url
     */
    public function setBaseApiUrl($base_api_url)
    {
        $this->base_api_url = $base_api_url;
    }

    /**
     * @param mixed $frequency
     */
    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $keyword_string
     */
    public function setKeywordString($keyword_string)
    {
        $this->keyword_string = $keyword_string;
    }

    /**
     * @param mixed $last_call_time
     */
    public function setLastCallTime($last_call_time)
    {
        $this->last_call_time = $last_call_time;
    }

    /**
     * @param mixed $next_call_time
     */
    public function setNextCallTime($next_call_time)
    {
        $this->next_call_time = $next_call_time;
    }

    /**
     * @param mixed $post_count
     */
    public function setPostCount($post_count)
    {
        $this->post_count = $post_count;
    }

    /**
     * @param mixed $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @param mixed $stream_id
     */
    public function setStreamId($stream_id)
    {
        $this->stream_id = $stream_id;
    }



}
