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


switch($request_method) {
	case 'OPTIONS':
		break;
	case 'GET':
		if (isset($_GET['keyword']) && !empty($_GET['keyword'])){
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
		header("HTTP/1.0 405 Method Not Allowed". $request_method);
		break;
}
/*
# Get JSON as a string
$json_str = file_get_contents('php://input');
# Get as an object
$json_obj = json_decode($json_str);
*/
// init du repo

function handleGet(){
	global $entityManager;
	$repository = $entityManager->getRepository('Tvtruc\Entities\Serie');

	// recherche
	$dqlSeriesNameSearchPattern = $_GET['keyword'];

	$query = $repository->createQueryBuilder('s')
		->where('s.serieName LIKE :name') // les contraintes
		->setParameter('name', '%'. $dqlSeriesNameSearchPattern .'%') // remplacer :name par l'expression '%88%'
		->setMaxResults( 9 )
		->getQuery();
	$foundSeries = $query->getResult();

	$jsonArray = [];
	foreach($foundSeries as $serie){
		// nouvel object avec la serie en cours
		$tmpSerie = (object)[
				"id" => $serie->getId(),
				"name" => $serie->getName(),
				"translation" => $serie->getTranslation(),
				"banner" => $serie->getBanner(),
				"fanart" => $serie->getFanart(),
				"seasons" => []
			];
		$seasons = $serie->seasons;
		foreach ($seasons as $season) {
			$epCount = count($season->episodes);
			$tmpSeason = (object)[
				"id" => $season->id,
				"name" => $season->seasonNumber,
				"episodes_count" => $epCount
			];

			array_push($tmpSerie->seasons, $tmpSeason);
				}

		/*		$episodes = $serie->getEpisodes();
		foreach($episodes as $episode){
			$tmpEpisode = (object)[
				"id" => $episode->getId(),
				"name" => $episode->getName()
			];

			array_push($tmpSerie->episodes, $tmpEpisode);
		}*/
		array_push($jsonArray, $tmpSerie);
	}
	echo json_encode($jsonArray, JSON_PRETTY_PRINT);
}
/*
echo "-----------------------\r\n";
echo "DQL result + DUMP \r\n";
echo "-----------------------\r\n";
// je cherche ceux avec "88" dedans
$dqlSeriesNameSearchPattern = "88";
$query = $repository->createQueryBuilder('s')
	->where('s.serieName LIKE :name') // les contraintes
	->setParameter('name', '%'. $dqlSeriesNameSearchPattern .'%') // remplacer :name par l'expression '%88%'
	->getQuery();
$dqlSeries = $query->getResult();

\Doctrine\Common\Util\Debug::dump($dqlSeries, 3);


echo "-----------------------\r\n";
echo "findAll result DUMP \r\n";
echo "-----------------------\r\n";
// retourne les tous
$series = $repository->findAll();
// alternativement
// $seriesList = $repository->findAll('Tvtruc\Entities\Series');


// affiche la version "lisible"
 \Doctrine\Common\Util\Debug::dump($series,4);

 // traitement en direct
//foreach ($series as $serie) {
//	echo sprintf("-%s\n", $serie->getName());
//	foreach ($serie->episodes as $episode) {
//		echo sprintf("- - - %s\n", $episode->getName());
//	}
//}

echo "-----------------------\r\n";
echo "findAll result EXPORT + print_r \r\n";
echo "-----------------------\r\n";
 // retourne la version "lisible"
$exportedSeries = \Doctrine\Common\Util\Debug::export($series,4);
print_r($exportedSeries);

echo "-----------------------\r\n";
echo "findAll result EXPORT + JSON_ENCODE \r\n";
echo "-----------------------\r\n";
echo json_encode($exportedSeries, JSON_PRETTY_PRINT);
*/



