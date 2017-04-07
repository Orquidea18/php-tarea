<?php

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);




// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
//require __DIR__ . '/../src/routes.php';



$app->get('/', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    $strData = file_get_contents('data/employees.json');
    $data = json_decode($strData);
    $token = "";
    return $this->renderer->render($response, 'employees.phtml', array("employees" => $data, "router" => $this->router, "token" => $token));
});
$app->get('/employee/{id}', function ($request, $response, $args) {
    $id = $args["id"];
    $strData = file_get_contents('data/employees.json');
    $data = json_decode($strData);

    foreach ($data as $key => $row):
        if ($row->id == $id) {
            $employee = $row;
            break;
        }
    endforeach;

    return $this->renderer->render($response, 'employee.phtml', array("employee" => $employee, "router" => $this->router));
})->setName("employee");

$app->get('/employee/search/', function ($request, $response, $args) {
    $params = $request->getQueryParams();

    $token = $params["emailSearch"];

    $strData = file_get_contents('data/employees.json');
    $data = json_decode($strData);

    $result = array();

    if ($token) {
        foreach ($data as $key => $row):
            $pos = strpos($row->email, $token);
            if ($pos === false) {
                
            } else {
                $result[] = $row;
            }
        endforeach;
    } else {
        $result = $data;
    }


    return $this->renderer->render($response, 'employees.phtml', array("employees" => $result, "router" => $this->router, "token" => $token));
})->setName("employee-search");

$app->get('/employee/salary/{min}/{max}', function ($request, $response, $args) {


    $min = floatval($args["min"]);
    $max = floatval($args["max"]);

    $strData = file_get_contents('data/employees.json');
    $data = json_decode($strData);

    $result = array();

    foreach ($data as $key => $row):

        $salary = trim($row->salary, "$");
        
        $salary = str_replace(",", "", $salary);
        $salary = floatval($salary);
        
        if ($min <= $salary AND $salary <= $max) {
            $result[] = $row;
        }
    endforeach;
    
    return $this->renderer->render($response, 'xml.phtml', array("employees" => $result));
})->setName("employee-salary");

// Run app
$app->run();
