<?php

class HomeController extends Controller {

    public $url;
    public $model;

    public function __construct() {
        $this->model = $this->loadModel('Home');
        $this->url = Redirect::URL();
        if (!$this->createDataBase()) {
            $this->createDataBase();
        }
        if (!$this->createDBTables()) {
            $this->createDBTables();
        }
        $this->JSONLogic();
    }

    public function index() {
//        View::make('home/index', $data);
    }

    public function myFirstArrayFields($data, $key = NULL) {
        if (!is_array($data)) {
            $array['dbTable'] = $key;
            $array[$key] = $data;
            print_r($array);
            return;
        } else {
            foreach ($data as $kay => $value) {
                $this->myFirstArrayFields($value, $kay);
            }
        }

//        foreach ($data as $kay => $value) {
////            print_r($data);
//            if (is_array($value)) {
////                print_r($value);
////                echo "<br>";
//                $this->myFirstArrayFields($value, $dbTable);
//            } else {
//                $array['dbTable'] = $dbTable;
//                $array[$kay] = $value;
//            }
//        }
////        print_r($value);
////        echo "<br>";
//        print_r($array);
////        return $array;
    }

    public function JSONLogic() {
        if ($results = $this->readFromJSON()) {
            echo "<pre>";
            foreach ($results as $kay => $val) {
                $data['uuid'] = $val['uuid'];
                $data['photo'] = $val['photo'];
                $data['name'] = $val['name'];
                $data['lastName'] = $val['lastName'];
                $data['description'] = $val['description'];
                $query = $this->model->insertDataIntoTable($data);
                $id = $val['uuid'];
                $datas['phoneNumbers'] = $val['phoneNumbers'];
                $datas['emails'] = $val['emails'];
                $query = $this->model->insertDataIntoTableNew($datas, $id);
//                print_r($val['phoneNumbers']);
//                $val['phoneNumbers'];
//                print_r($val['emails']);
//                $val['addersses'];
            }
        }
    }

    public function readFromJSON() {
        $contents = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/files/contacts.json");
        $contents = utf8_encode($contents);
        $latitude = preg_replace('/"latitude":(\s*)(-?)(\s*)([0-9]{1,})(\.[0-9]{1,})?/', '"latitude":"$2$4$5"', $contents);
        $longitude = preg_replace('/"longitude":(\s*)(-?)(\s*)([0-9]{1,})(\.[0-9]{1,})?/', '"longitude":"$2$4$5"', $latitude);
        $results = json_decode($longitude, true);

        $json_errors = array(
            JSON_ERROR_NONE => 'No error has occurred',
            JSON_ERROR_DEPTH => 'The maximum stack depth has been exceeded',
            JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded',
            JSON_ERROR_SYNTAX => 'Syntax error',
        );
        if ($json_errors[json_last_error()] != $json_errors[JSON_ERROR_NONE]) {
            require_once __app_path__ . 'controllers/ErrorController.php';
            $controller = new ErrorController();
            $controller->SyntaxError($json_errors[json_last_error()]);
            return;
        }
        return $results;
    }

    public function createDataBase() {
        $query = $this->model->createNewDatabase(DB_DATABASE);
        if ($query['status']) {
            return $query;
        } else {
            echo $query['massage'];
        }
    }

    public function createDBTables() {
        $sql = "CREATE TABLE IF NOT EXISTS `contacts` (
                `uuid` varchar(100) NOT NULL,
                `photo` varchar(100) DEFAULT NULL,
                `name` varchar(100) DEFAULT NULL,
                `lastName` varchar(100) DEFAULT NULL,
                `description` text
                ) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci; ";
        $sql .= "CREATE TABLE IF NOT EXISTS `phonenumbers` (
                `uuid` varchar(100) DEFAULT NULL,
                `numbers` varchar(100) DEFAULT NULL
                ) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci; ";
        $sql .= "CREATE table IF NOT EXISTS `emails` (
                `uuid` varchar(100) NOT NULL,
                `emails` varchar(100)
                ) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci; ";
        $sql .= "CREATE table IF NOT EXISTS `addersses` (
                `uuid` varchar(100) NOT NULL,
                `name` varchar(100),
                `city` varchar(100),
                `latitude` varchar(100),
                `longitude` varchar(100)
                ) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci; ";
        $sql .= "ALTER TABLE `contacts`  ADD PRIMARY KEY (`uuid`); ";
        $sql .= "ALTER TABLE `phonenumbers`  ADD KEY `uuid` (`uuid`); ";
        $sql .= "ALTER TABLE `emails`  ADD KEY `uuid` (`uuid`); ";
        $sql .= "ALTER TABLE `addersses`  ADD KEY `uuid` (`uuid`); ";
        $sql .= "ALTER TABLE `phonenumbers` ADD CONSTRAINT `phonenumbers_ibfk_1` FOREIGN KEY (`uuid`) REFERENCES `contacts` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE; ";
        $sql .= "ALTER TABLE `emails` ADD CONSTRAINT `emails_ibfk_1` FOREIGN KEY (`uuid`) REFERENCES `contacts` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE; ";
        $sql .= "ALTER TABLE `addersses` ADD CONSTRAINT `addersses_ibfk_1` FOREIGN KEY (`uuid`) REFERENCES `contacts` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE;";
        $query = $this->model->createNewTable($sql);
        if ($query['status']) {
            return $query;
        } else {
            echo $query['massage'];
        }
    }

}
