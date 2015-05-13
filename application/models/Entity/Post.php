<?php
/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 09/09/13
 * Time: 9:05 PM
 * To change this template use File | Settings | File Templates.
 */
class Post extends Entity {

    Public $id;
    Public $stream_id;
    Public $source;
    Public $post_id;
    Public $post_hash;
    Public $post_text;
    Public $post_lang;
    Public $post_source;
    Public $post_url;
    Public $post_type;
    Public $post_story_text;
    Public $post_picture;
    Public $post_link;
    Public $post_name;
    Public $post_caption;
    Public $post_description;
    Public $user_category;
    Public $user_profile_image;
    Public $user_name;
    Public $user_screen_name;
    Public $user_id;
    Public $user_lang;
    Public $user_location;
    Public $user_followers_count;
    Public $user_friend_count;
    Public $user_status_count;
    Public $post_likes;
    Public $post_comments;
    Public $user_url;
    Public $post_status;
    Public $date_published;
    Public $date_published_ts;

    /**
     * @return mixed
     */
    public function getDatePublished()
    {
        return $this->date_published;
    }

    /**
     * @return mixed
     */
    public function getDatePublishedTs()
    {
        return $this->date_published_ts;
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
    public function getPostCaption()
    {
        return $this->post_caption;
    }

    /**
     * @return mixed
     */
    public function getPostComments()
    {
        return $this->post_comments;
    }

    /**
     * @return mixed
     */
    public function getPostDescription()
    {
        return $this->post_description;
    }

    /**
     * @return mixed
     */
    public function getPostHash()
    {
        return $this->post_hash;
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->post_id;
    }

    /**
     * @return mixed
     */
    public function getPostLang()
    {
        return $this->post_lang;
    }

    /**
     * @return mixed
     */
    public function getPostLikes()
    {
        return $this->post_likes;
    }

    /**
     * @return mixed
     */
    public function getPostLink()
    {
        return $this->post_link;
    }

    /**
     * @return mixed
     */
    public function getPostName()
    {
        return $this->post_name;
    }

    /**
     * @return mixed
     */
    public function getPostPicture()
    {
        return $this->post_picture;
    }

    /**
     * @return mixed
     */
    public function getPostSource()
    {
        return $this->post_source;
    }

    /**
     * @return mixed
     */
    public function getPostStatus()
    {
        return $this->post_status;
    }

    /**
     * @return mixed
     */
    public function getPostStoryText()
    {
        return $this->post_story_text;
    }

    /**
     * @return mixed
     */
    public function getPostText()
    {
        return $this->post_text;
    }

    /**
     * @return mixed
     */
    public function getPostType()
    {
        return $this->post_type;
    }

    /**
     * @return mixed
     */
    public function getPostUrl()
    {
        return $this->post_url;
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
     * @return mixed
     */
    public function getUserCategory()
    {
        return $this->user_category;
    }

    /**
     * @return mixed
     */
    public function getUserFollowersCount()
    {
        return $this->user_followers_count;
    }

    /**
     * @return mixed
     */
    public function getUserFriendCount()
    {
        return $this->user_friend_count;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function getUserLang()
    {
        return $this->user_lang;
    }

    /**
     * @return mixed
     */
    public function getUserLocation()
    {
        return $this->user_location;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->user_name;
    }

    /**
     * @return mixed
     */
    public function getUserProfileImage()
    {
        return $this->user_profile_image;
    }

    /**
     * @return mixed
     */
    public function getUserScreenName()
    {
        return $this->user_screen_name;
    }

    /**
     * @return mixed
     */
    public function getUserStatusCount()
    {
        return $this->user_status_count;
    }

    /**
     * @return mixed
     */
    public function getUserUrl()
    {
        return $this->user_url;
    }

    /**
     * @param mixed $date_published
     */
    public function setDatePublished($date_published)
    {
        $this->date_published = $date_published;
    }

    /**
     * @param mixed $date_published_ts
     */
    public function setDatePublishedTs($date_published_ts)
    {
        $this->date_published_ts = $date_published_ts;
    }

    /**
     * @param mixed $field
     */
    public function setField($field)
    {
        $this->field = $field;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $post_caption
     */
    public function setPostCaption($post_caption)
    {
        $this->post_caption = $post_caption;
    }

    /**
     * @param mixed $post_comments
     */
    public function setPostComments($post_comments)
    {
        $this->post_comments = $post_comments;
    }

    /**
     * @param mixed $post_description
     */
    public function setPostDescription($post_description)
    {
        $this->post_description = $post_description;
    }

    /**
     * @param mixed $post_hash
     */
    public function setPostHash($post_hash)
    {
        $this->post_hash = $post_hash;
    }

    /**
     * @param mixed $post_id
     */
    public function setPostId($post_id)
    {
        $this->post_id = $post_id;
    }

    /**
     * @param mixed $post_lang
     */
    public function setPostLang($post_lang)
    {
        $this->post_lang = $post_lang;
    }

    /**
     * @param mixed $post_likes
     */
    public function setPostLikes($post_likes)
    {
        $this->post_likes = $post_likes;
    }

    /**
     * @param mixed $post_link
     */
    public function setPostLink($post_link)
    {
        $this->post_link = $post_link;
    }

    /**
     * @param mixed $post_name
     */
    public function setPostName($post_name)
    {
        $this->post_name = $post_name;
    }

    /**
     * @param mixed $post_picture
     */
    public function setPostPicture($post_picture)
    {
        $this->post_picture = $post_picture;
    }

    /**
     * @param mixed $post_source
     */
    public function setPostSource($post_source)
    {
        $this->post_source = $post_source;
    }

    /**
     * @param mixed $post_status
     */
    public function setPostStatus($post_status)
    {
        $this->post_status = $post_status;
    }

    /**
     * @param mixed $post_story_text
     */
    public function setPostStoryText($post_story_text)
    {
        $this->post_story_text = $post_story_text;
    }

    /**
     * @param mixed $post_text
     */
    public function setPostText($post_text)
    {
        $this->post_text = $post_text;
    }

    /**
     * @param mixed $post_type
     */
    public function setPostType($post_type)
    {
        $this->post_type = $post_type;
    }

    /**
     * @param mixed $post_url
     */
    public function setPostUrl($post_url)
    {
        $this->post_url = $post_url;
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

    /**
     * @param mixed $user_category
     */
    public function setUserCategory($user_category)
    {
        $this->user_category = $user_category;
    }

    /**
     * @param mixed $user_followers_count
     */
    public function setUserFollowersCount($user_followers_count)
    {
        $this->user_followers_count = $user_followers_count;
    }

    /**
     * @param mixed $user_friend_count
     */
    public function setUserFriendCount($user_friend_count)
    {
        $this->user_friend_count = $user_friend_count;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @param mixed $user_lang
     */
    public function setUserLang($user_lang)
    {
        $this->user_lang = $user_lang;
    }

    /**
     * @param mixed $user_location
     */
    public function setUserLocation($user_location)
    {
        $this->user_location = $user_location;
    }

    /**
     * @param mixed $user_name
     */
    public function setUserName($user_name)
    {
        $this->user_name = $user_name;
    }

    /**
     * @param mixed $user_profile_image
     */
    public function setUserProfileImage($user_profile_image)
    {
        $this->user_profile_image = $user_profile_image;
    }

    /**
     * @param mixed $user_screen_name
     */
    public function setUserScreenName($user_screen_name)
    {
        $this->user_screen_name = $user_screen_name;
    }

    /**
     * @param mixed $user_status_count
     */
    public function setUserStatusCount($user_status_count)
    {
        $this->user_status_count = $user_status_count;
    }

    /**
     * @param mixed $user_url
     */
    public function setUserUrl($user_url)
    {
        $this->user_url = $user_url;
    }




}
