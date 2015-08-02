<?php

class InstallController extends Controller {

    public $model;

    public function __construct() {
        $this->model = $this->loadModel('Install');
        if (!$this->createDataBase()) {
            $this->createDataBase();
        }
        if (!$this->createDBTables()) {
            $this->createDBTables();
        }
        $this->JSONLogic();
    }

    public function index() {
        View::installMake('install/index');
    }

    public function JSONLogic() {
        if ($results = $this->readFromJSON()) {
            $i = 1;
            foreach ($results as $kay => $val) {
                $data['uuid'] = $val['uuid'];
                $data['photo'] = $val['photo'];
                $data['name'] = $val['name'];
                $data['lastName'] = $val['lastName'];
                $data['description'] = $val['description'];
                $id = $val['uuid'];
                $array['phoneNumbers'] = $val['phoneNumbers'];
                $array['emails'] = $val['emails'];
                $this->model->insertDataIntoTable($data);
                $this->model->insertDataIntoTableArray($array, $id);
                foreach($val['addersses'] as $key => $val){
                    $newArray['addersses'] = $val;
                    $this->model->insertDataIntoTableNewArray($newArray, $id);
                }
                if(count($results) == $i) {
                    Session::set('max_row_count', true);
                }
                $i++;

            }
        }
    }

    public function readFromJSON() {
        $contents = file_get_contents(__file_path__ . "/files/contacts.json");
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
        if (Session::get('massage-db')) {
            return true;
        } else {
            Session::set('error-massage-table', $query['massage']);
        }
    }

    public function createDBTables() {
        $sql = "CREATE TABLE IF NOT EXISTS `contacts` (
                `id` int(11) NOT NULL,
                  `uuid` varchar(100) NOT NULL,
                  `photo` varchar(100) NOT NULL,
                  `name` varchar(100) NOT NULL,
                  `lastName` varchar(100) NOT NULL,
                  `description` text NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8; ";
            $sql .= "CREATE TABLE IF NOT EXISTS `phonenumbers` (
                    `id` int(11) NOT NULL,
                      `uuid` varchar(100) NOT NULL,
                      `numbers` varchar(100) NOT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8; ";
        $sql .= "CREATE TABLE IF NOT EXISTS `emails` (
                    `id` int(11) NOT NULL,
                      `uuid` varchar(100) NOT NULL,
                      `emails` varchar(100) NOT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8; ";
        $sql .= "CREATE TABLE IF NOT EXISTS `addersses` (
                    `id` int(11) NOT NULL,
                      `uuid` varchar(100) NOT NULL,
                      `name` varchar(100) NOT NULL,
                      `city` varchar(100) NOT NULL,
                      `latitude` varchar(100) NOT NULL,
                      `longitude` varchar(100) NOT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8; ";
        $sql .= "ALTER TABLE `contacts` ADD PRIMARY KEY (`id`), ADD KEY `uuid` (`uuid`); ";
        $sql .= "ALTER TABLE `phonenumbers` ADD PRIMARY KEY (`id`), ADD KEY `uuid` (`uuid`); ";
        $sql .= "ALTER TABLE `emails` ADD PRIMARY KEY (`id`), ADD KEY `uuid` (`uuid`); ";
        $sql .= "ALTER TABLE `addersses` ADD PRIMARY KEY (`id`), ADD KEY `uuid` (`uuid`); ";

        $sql .= "ALTER TABLE `contacts` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT; ";
        $sql .= "ALTER TABLE `phonenumbers` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT; ";
        $sql .= "ALTER TABLE `emails` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT; ";
        $sql .= "ALTER TABLE `addersses` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT; ";

        $sql .= "ALTER TABLE `addersses` ADD CONSTRAINT `addersses_ibfk_1` FOREIGN KEY (`uuid`) REFERENCES `contacts` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE; ";
        $sql .= "ALTER TABLE `emails` ADD CONSTRAINT `emails_ibfk_1` FOREIGN KEY (`uuid`) REFERENCES `contacts` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE; ";
        $sql .= "ALTER TABLE `phonenumbers` ADD CONSTRAINT `phonenumbers_ibfk_1` FOREIGN KEY (`uuid`) REFERENCES `contacts` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE; ";

        $query = $this->model->createNewTable($sql);
        if (Session::get('massage-db')) {
            return true;
        } else {
            Session::set('error-massage-db', $query['massage']);
        }
    }

    public function __destruct(){

    }

}
