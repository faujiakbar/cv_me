<?php
    /* Handle CORS */

    // Specify domains from which requests are allowed
    header('Access-Control-Allow-Origin: *');

    // Specify which request methods are allowed
    header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');

    // Additional headers which may be sent along with the CORS request
    header('Access-Control-Allow-Headers: X-Requested-With,Authorization,Content-Type');

    // Set the age to 1 day to improve speed/caching.
    header('Access-Control-Max-Age: 86400');

    // Exit early so the page isn't fully loaded for options requests
    if (strtolower($_SERVER['REQUEST_METHOD']) == 'options') {
        exit();
    }

    header('Content-Type', 'application/json');

    try {
        $file = isset($_GET["file"])?$_GET["file"]:null;
        if(!$file) throw new Exception("Parameter salah",401);
        if(!file_exists(getcwd()."/".$file)) throw new Exception("File tidak ditemukan",401);

        $file = getcwd()."/".$file;

        $fl = fopen($file, "r");
        $frd = fread($fl,1000000);

        echo $frd;
    } catch(Exception $e){
        echo json_encode(array("error" => $e->getMessage()));
    }

?>