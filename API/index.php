<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin");
session_start();

// Test de connexion à la base
$config = parse_ini_file("config.ini");
try {
	$pdo = new \PDO("mysql:host=".$config["host"].";dbname=".$config["database"].";charset=utf8", $config["user"], $config["password"]);
} catch(Exception $e) {
	http_response_code(500);
	header('Content-Type: application/json');
	header("Access-Control-Allow-Origin: *");
	echo '{ "message":"Erreur de connexion à la base de données" }';
	exit;
}

// Chargement des fichiers MVC
require("control/controleur.php");
require("view/vue.php");
require("model/tache.php");

// Routes et méthodes HTTP associées

switch($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		(new controleur)->getTache();
		break;
	case "POST":
		(new controleur)->ajouterTache();
		break;
	case "PUT":
		(new controleur)->modifierTache();
		break;
	case "DELETE":
		(new controleur)->supprimerTache();
		break;
	default:
		(new controleur)->erreur404();
		break;
}
