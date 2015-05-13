<?php
/**
 * Created by PhpStorm.
 * User: zainulabdeen
 * Date: 08/05/15
 * Time: 1:09 AM
 */

class Form extends Entity {

    public $id;
    public $title;
    public $form_json;

    /**
     * @param mixed $form_json
     */
    public function setFormJson($form_json)
    {
        $this->form_json = $form_json;
    }

    /**
     * @return mixed
     */
    public function getFormJson()
    {
        return $this->form_json;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }



} 