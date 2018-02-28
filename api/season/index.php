<?php
/**
 * Created by PhpStorm.
 * User: rototo
 * Date: 14/02/2018
 * Time: 19:56
 */

// create_product.php <name>
require_once "../../bootstrap.php";

$request_method = $_SERVER["REQUEST_METHOD"];

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers:   content-type,X-Requested-With,x-api-key,X-ACCOUNT-API-KEY,X-USER-API-KEY,account_api_key,user_api_key");
//header("Access-Control-Allow-Methods : POST,GET,OPTIONS,PUT,DELETE");


switch ($request_method) {
	case 'OPTIONS':
		break;
	case 'GET':
		if (isset($_GET['id']) && !empty($_GET['id'])) {
			handleGet();
		}
		break;
	case 'POST':
		//???
		break;
	case 'PUT': // ou PATCH
		//???
		break;
	case 'DELETE':
		//???
		break;
	default:
		// Invalid Request Method
		header("HTTP/1.0 405 Method Not Allowed" . $request_method);
		break;
}
/*
# Get JSON as a string
$json_str = file_get_contents('php://input');
# Get as an object
$json_obj = json_decode($json_str);
*/
// init du repo

function handleGet() {
	global $entityManager;
	$repository = $entityManager->getRepository('Tvtruc\Entities\Season');


	$season = $repository->findOneById($_GET['id']);

	//\Doctrine\Common\Util\Debug::dump($season, 3);

	$jsonArray = [];
	// nouvel object avec la season en cours
	$tmpSeason = (object)[
		"id" => $season->id,
		"name" => $season->seasonNumber,
		"episodes" => []
	];
	$episodes = $season->episodes;
	foreach ($episodes as $episode) {
		$tmpEpisode = (object)[
			"id" => $episode->getId(),
			"name" => $episode->getName()
		];

		array_push($tmpSeason->episodes, $tmpEpisode);
	}

	array_push($jsonArray, $tmpSeason);
	echo json_encode($jsonArray, JSON_PRETTY_PRINT);
}




