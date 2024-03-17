<?php
session_start();

include("libs/maLibSQL.pdo.php");
include_once("libs/modele.php");
include_once("libs/maLibUtils.php");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");

$data = array("version"=>1.3);

$method = $_SERVER["REQUEST_METHOD"];
// debug("method",$method);

if ($method == "OPTIONS") die("ok - OPTIONS");

$data["success"] = false;
$data["status"] = 400; 

// Verif autorisation : il faut un hash
// Il peut être dans le header, ou dans la chaîne de requête

$connected = false; 

// echo $_SERVER['REQUEST_URI'];

if (valider("REQUEST_URI", "SERVER")) {;
    $requestParts = explode('/',$_SERVER['REQUEST_URI']);
    \array_splice($requestParts, 0, 1);
    \array_splice($requestParts, 0, 1);
    \array_splice($requestParts, 0, 1);

    // echo count($requestParts);

	// debug("rewrite-request" ,$_SERVER['REQUEST_URI'] ); 
	// debug("#parts", count($requestParts) ); 

	$entite1 = false;
	$idEntite1 = false;
	$entite2 = false; 
	$idEntite2 = false; 

	if (count($requestParts) >0) {
		$entite1 = $requestParts[0];
		// debug("entite1",$entite1); 
	} 

	if (count($requestParts) >1) {	
		if (is_id($requestParts[1])) {
			$idEntite1 = intval($requestParts[1]);
			// debug("idEntite1",$idEntite1); 
		} else {
			// erreur !
			$method = "error";
			$data["status"] = 400; 
		}
	}

	if (count($requestParts) >2) {
		$entite2 = $requestParts[2];
		// debug("entite2",$entite2); 
	}

	if (count($requestParts) >3) {
		if (is_id($requestParts[3])) {
			$idEntite2 = intval($requestParts[3]);
			// debug("idEntite2",$idEntite2); 
		} else {
			// erreur !
			$method = "error";
			$data["status"] = 400;
		}

	} 
	$action = $method; 
	if ($entite1) $action .= "_$entite1";
	if ($entite2) $action .= "_$entite2";

    switch ($action) {

		case 'POST_movies' :
			$data["title_name"] = valider("title_name");
			$data["status"] = valider("status");
			$data["genre"] = valider("genre");
			$data["order"] = valider("order");
			$data["high"] = valider("high");
			$data["low"] = valider("low");
			$data["movies"] = getMovies($data["title_name"],$data["status"],$data["genre"],$data["order"], $data["high"], $data["low"]);

			$data["success"] = true;
			$data["status"] = 200;

        break;

		case 'POST_remove' :
			$data["title_name"] = valider("title_name");
			if ($data["title_name"]) {
				removeMovie($data["title_name"]);
			}
			$data["success"] = true;
			$data["status"] = 200;
		break;			

        
        case 'POST_add' : 
            $title = $_POST["title"];
            $grade = $_POST["grade"];
            $duration = $_POST["duration"];
			$genre = $_POST["genre"];
            $date = $_POST["date"];
            $picture = $_POST["picture"];
            $synopsis = $_POST["synopsis"];
            $actors = $_POST["actors"];
            $director = $_POST["director"];
            $writer = $_POST["writer"];          

            add_movie($title, $grade, $duration, $date, $genre, $synopsis, $actors, $director, $writer, $picture);

            $data["success"] = true;
            $data["status"] = 202;
			$data["title"] = $title;
			$data["grade"] = $grade;
			$data["duration"] = $duration;
			$data["date"] = $date;
			$data["genre"] = $genre;
			$data["synopsis"] = $synopsis;
			$data["actors"] = $actors;
			$data["director"] = $director;
			$data["writer"] = $writer;
			$data["picture"] = $picture;

			echo "location.reload()";
            
        break;

		case 'POST_seen' :
			$data["title_name"] = valider("title_name");
			if ($data["title_name"]) {
				changeStatus($data["title_name"]);
			}

			$data["success"] = true;
			$data["status"] = 200;

        break;

    } // switch(action)
}

switch($data["status"]) {
	case 200: header("HTTP/1.0 200 OK");	break;
	case 201: header("HTTP/1.0 201 Created");	break; 
	case 202: header("HTTP/1.0 202 Accepted");	break;
	case 204: header("HTTP/1.0 204 No Content");	break;
	case 400: header("HTTP/1.0 400 Bad Request");	break; 
	case 401: header("HTTP/1.0 401 Unauthorized");	break; 
	case 403: header("HTTP/1.0 403 Forbidden");		break; 
	case 404: header("HTTP/1.0 404 Not Found");		break;
	default: header("HTTP/1.0 200 OK");
		
}
echo json_encode($data);

?>

