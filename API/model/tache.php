<?php

class tache {
	
	// Objet PDO servant à la connexion à la base
	private $pdo;

	// Connexion à la base de données
	public function __construct() {
		$config = parse_ini_file("config.ini");
		
		try {
			$this->pdo = new \PDO("mysql:host=".$config["host"].";dbname=".$config["database"].";charset=utf8", $config["user"], $config["password"]);
		} catch(Exception $e) {
			echo $e->getMessage();
		}
	}

	public function getAll() {
		$sql = "SELECT * FROM tache";
		
		$req = $this->pdo->prepare($sql);
		$req->execute();
		
		return $req->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function get($id) {
		$sql = "SELECT * FROM tache WHERE id = :id";
		
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':id', $id, PDO::PARAM_INT);
		$req->execute();
		
		return $req->fetch(\PDO::FETCH_ASSOC);
	}

	public function exists($id) {
		$sql = "SELECT COUNT(*) AS nb FROM tache WHERE id = :id";
		
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':id', $id, PDO::PARAM_INT);
		$req->execute();
		
		$nb = $req->fetch(\PDO::FETCH_ASSOC)["nb"];
		if($nb == 1) {
			return true;
		}
		else {
			return false;
		}
	}

	public function insert($titre, $cat, $importance) {
		$sql = "INSERT INTO tache (titre, cat, importance) VALUES (:titre, :cat, :importance)";
		
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':titre', $titre, PDO::PARAM_STR);
		$req->bindParam(':cat', $cat, PDO::PARAM_STR);
		$req->bindParam(':importance', $importance, PDO::PARAM_INT);
		$result = $req->execute();
		if($result === true) {
			return $this->pdo->lastInsertId();
		}
		else {
			return false;
		}
	}

	public function update($id, $titre, $cat, $importance) {
		$sql = "UPDATE tache SET titre = :titre, cat = :cat, importance = :importance  WHERE id = :id";
		
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':id', $id, PDO::PARAM_INT);
		$req->bindParam(':titre', $titre, PDO::PARAM_STR);
		$req->bindParam(':cat', $cat, PDO::PARAM_STR);
		$req->bindParam(':importance', $importance, PDO::PARAM_INT);
		return $req->execute();
	}

	public function delete($id) {
		$sql = "DELETE FROM tache WHERE id = :id";
		
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':id', $id, PDO::PARAM_INT);
		return $req->execute();
	}
}