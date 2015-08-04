<?php

class ContactController extends Controller{
    
    
    public $url;
    public $model;
    public $params;

    public function __construct() {
        $this->model = $this->loadModel('Contact');
        $this->params = $this->getParams();
        $this->url = Redirect::URL();
    }

    public function index(){
        $allData = $this->model->getAllData();
        $data = array(
            'title' => 'Contact Form',
            'allData' => $allData,
            'URL' => $this->url
        );
        View::make('contact/index', $data);
    }
}
