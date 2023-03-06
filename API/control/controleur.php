<?php
class controleur {
	
	public function erreur404() {
		http_response_code(404);
		(new vue)->erreur404();
	}

	public function verifierAttributsJson($objetJson, $listeDesAttributs) {
		$verifier = true;
		foreach($listeDesAttributs as $unAttribut) {
			if(!isset($objetJson->$unAttribut)) {
				$verifier = false;
			}
		}
		return $verifier;
	}

	public function getMachines() {
		$donnees = null;

		if(isset($_GET["id"])) {
			if((new machine)->exists($_GET["id"])) {
				http_response_code(200);
				$donnees = (new machine)->get($_GET["id"]);
			}
			else {
				http_response_code(404);
				$donnees = array("message" => "Machine introuvable");
			}
		}
		else {
			http_response_code(200);
			$donnees = (new machine)->getAll();
		}
		
		(new vue)->transformerJson($donnees);
	}

	public function ajouterMachine() {
		$donnees = json_decode(file_get_contents("php://input"));
		$renvoi = null;
		if($donnees === null) {
			http_response_code(400);
			$renvoi = array("message" => "JSON envoyé incorrect");
		}
		else {
			$attributsRequis = array("nom", "fabriquant");
			if($this->verifierAttributsJson($donnees, $attributsRequis)) {
				if((new fabriquant)->exists($donnees->fabriquant)) {
					$resultat = (new machine)->insert($donnees->nom, $donnees->fabriquant);
					
					if($resultat != false) {
						http_response_code(201);
						$renvoi = array("message" => "Ajout effectué avec succès", "idMachine" => $resultat);
					}
					else {
						http_response_code(500);
						$renvoi = array("message" => "Une erreur interne est survenue");
					}
				}
				else {
					http_response_code(400);
					$renvoi = array("message" => "Le fabriquant spécifié n'existe pas");
				}
			}
			else {
				http_response_code(400);
				$renvoi = array("message" => "Données manquantes");
			}
		}

		(new vue)->transformerJson($renvoi);
	}

	public function modifierMachine() {
		$donnees = json_decode(file_get_contents("php://input"));
		$renvoi = null;
		if($donnees === null) {
			http_response_code(400);
			$renvoi = array("message" => "JSON envoyé incorrect");
		}
		else {
			$attributsRequis = array("id", "nom", "fabriquant");
			if($this->verifierAttributsJson($donnees, $attributsRequis)) {
				if((new fabriquant)->exists($donnees->fabriquant)) {
					$resultat = (new machine)->update($donnees->id, $donnees->nom, $donnees->fabriquant);
					
					if($resultat != false) {
						http_response_code(200);
						$renvoi = array("message" => "Modification effectuée avec succès");
					}
					else {
						http_response_code(500);
						$renvoi = array("message" => "Une erreur interne est survenue");
					}
				}
				else {
					http_response_code(400);
					$renvoi = array("message" => "Le fabriquant spécifié n'existe pas");
				}
			}
			else {
				http_response_code(400);
				$renvoi = array("message" => "Données manquantes");
			}
		}

		(new vue)->transformerJson($renvoi);
	}

	public function miseEnServiceMachine() {
		$donnees = json_decode(file_get_contents("php://input"));
		$renvoi = null;
		if($donnees === null) {
			http_response_code(400);
			$renvoi = array("message" => "JSON envoyé incorrect");
		}
		else {
			$attributsRequis = array("id", "etat");
			if($this->verifierAttributsJson($donnees, $attributsRequis)) {
				if($donnees->etat == 0 || $donnees->etat == 1) {
					$resultat = (new machine)->changeState($donnees->id, $donnees->etat);

					if($resultat != false) {
						http_response_code(200);
						$renvoi = array("message" => "Changement d'état effectué avec succès");
					}
					else {
						http_response_code(500);
						$renvoi = array("message" => "Une erreur interne est survenue");
					}
				}
				else {
					http_response_code(400);
					$renvoi = array("message" => "L'état spécifié est incorrect (attendu : 0 ou 1)");
				}
			}
			else {
				http_response_code(400);
				$renvoi = array("message" => "Données manquantes");
			}
		}

		(new vue)->transformerJson($renvoi);
	}

	public function supprimerMachine() {
		$donnees = json_decode(file_get_contents("php://input"));
		$renvoi = null;
		if($donnees === null) {
			http_response_code(400);
			$renvoi = array("message" => "JSON envoyé incorrect");
		}
		else {
			$attributsRequis = array("id");
			if($this->verifierAttributsJson($donnees, $attributsRequis)) {
				if((new machine)->exists($donnees->id)) {
					$resultat = (new machine)->delete($donnees->id);
					
					if($resultat != false) {
						http_response_code(200);
						$renvoi = array("message" => "Suppression effectuée avec succès");
					}
					else {
						http_response_code(500);
						$renvoi = array("message" => "Une erreur interne est survenue");
					}
				}
				else {
					http_response_code(400);
					$renvoi = array("message" => "La machine spécifiée n'existe pas");
				}
			}
			else {
				http_response_code(400);
				$renvoi = array("message" => "Données manquantes");
			}
		}

		(new vue)->transformerJson($renvoi);
	}

	public function getFabriquants() {
		$donnees = null;

		if(isset($_GET["id"])) {
			if((new fabriquant)->exists($_GET["id"])) {
				http_response_code(200);
				$donnees = (new fabriquant)->get($_GET["id"]);
			}
			else {
				http_response_code(404);
				$donnees = array("message" => "Fabriquant introuvable");
			}
		}
		else {
			http_response_code(200);
			$donnees = (new fabriquant)->getAll();
		}
		
		(new vue)->transformerJson($donnees);
	}

}