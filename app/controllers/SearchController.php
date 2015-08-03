<?php

class SearchController extends Controller{

    public $url;
    public $model;
    public $params;

    public function __construct() {
        $this->model = $this->loadModel('Search');
        $this->params = $this->getParams();
        $this->url = Redirect::URL();
    }

    public function index(){
        $tables = $this->model->getAllTables();
        $tableNames = [];
        foreach($tables as $key => $val){
            $tableNames[$val] = $this->model->getTableRowNames($val);
        }
//        echo "<pre>";
//        print_r($tableNames);
//        return;
        $data = array(
            'title' => 'Search',
            'tables' => $tableNames,
            'URL' => $this->url
        );
        View::make('search/index', $data);
    }

    public function searchData(){
        if(!$_POST){
            require_once __app_path__ . 'controllers/ErrorController.php';
            $controller = new ErrorController();
            $controller->Request(400);
            return false;
        }
        parse_str($_POST['data'], $data);
        $data['table'] = htmlentities(stripslashes($_POST['table']));
        if(!$data['field'] || !$data['search']){
            echo json_encode([
                'massage' => 'Required Fields Can\'t Be Empty.' ,
                'status' => false
            ]);
            return;
        }
        if(!$data['table']){
            echo json_encode([
                'massage' => 'Something Was Wrong...' ,
                'status' => false
            ]);
            return;
        }
        $query = $this->model->search($data);
        $data = json_encode([
            'massage' => $query['massage'],
            'status' => $query['status'],
            'result' => $query['data']
        ]);
        print_r($data);
    }

    public function __destruct(){

    }
}

