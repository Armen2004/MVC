<?php

class HomeController extends Controller{

    public function index(){
        $name = [];
        $data = array(
            'name' => $name
        );
        View::make('home/index', $data);
    }

    public function create(){
//        $this->model = new Home_Model();
        $this->model->run();
    }

}