<?php
/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 07/09/13
 * Time: 4:29 PM
 * To change this template use File | Settings | File Templates.
 */ 
class Stream extends Entity {

    public $id;
    public $title;
    public $keyword;
    public $is_phrase = 'n';
    public $is_profile = 'n';
    public $is_twitter = 'n';
    public $is_facebook = 'n';
    public $is_gplus = 'n';
    public $status = 'active';

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getIsFacebook()
    {
        return $this->is_facebook;
    }

    /**
     * @return string
     */
    public function getIsGplus()
    {
        return $this->is_gplus;
    }

    /**
     * @return string
     */
    public function getIsPhrase()
    {
        return $this->is_phrase;
    }

    /**
     * @return string
     */
    public function getIsProfile()
    {
        return $this->is_profile;
    }

    /**
     * @return string
     */
    public function getIsTwitter()
    {
        return $this->is_twitter;
    }

    /**
     * @return mixed
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $is_facebook
     */
    public function setIsFacebook($is_facebook)
    {
        $this->is_facebook = $is_facebook;
    }

    /**
     * @param string $is_gplus
     */
    public function setIsGplus($is_gplus)
    {
        $this->is_gplus = $is_gplus;
    }

    /**
     * @param string $is_phrase
     */
    public function setIsPhrase($is_phrase)
    {
        $this->is_phrase = $is_phrase;
    }

    /**
     * @param string $is_profile
     */
    public function setIsProfile($is_profile)
    {
        $this->is_profile = $is_profile;
    }

    /**
     * @param string $is_twitter
     */
    public function setIsTwitter($is_twitter)
    {
        $this->is_twitter = $is_twitter;
    }

    /**
     * @param mixed $keyword
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

}
