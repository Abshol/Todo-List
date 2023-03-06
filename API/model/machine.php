<?php

class machine {
	
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
		$sql = "SELECT * FROM machine";
		
		$req = $this->pdo->prepare($sql);
		$req->execute();
		
		return $req->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function get($id) {
		$sql = "SELECT * FROM machine WHERE idMachine = :id";
		
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':id', $id, PDO::PARAM_INT);
		$req->execute();
		
		return $req->fetch(\PDO::FETCH_ASSOC);
	}

	public function exists($id) {
		$sql = "SELECT COUNT(*) AS nb FROM machine WHERE idMachine = :id";
		
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

	public function insert($nom, $fabriquant) {
		$sql = "INSERT INTO machine (nomMachine, etreEnService, idFabriquant) VALUES (:nom, 0, :fabriquant)";
		
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':nom', $nom, PDO::PARAM_STR);
		$req->bindParam(':fabriquant', $fabriquant, PDO::PARAM_INT);
		$result = $req->execute();
		if($result === true) {
			return $this->pdo->lastInsertId();
		}
		else {
			return false;
		}
	}

	public function update($id, $nom, $fabriquant) {
		$sql = "UPDATE machine SET nomMachine = :nom, idFabriquant = :fabriquant WHERE idMachine = :id";
		
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':id', $id, PDO::PARAM_INT);
		$req->bindParam(':nom', $nom, PDO::PARAM_STR);
		$req->bindParam(':fabriquant', $fabriquant, PDO::PARAM_INT);
		return $req->execute();
	}

	public function changeState($id, $etat) {
		$sql = "UPDATE machine SET etreEnService = :etat WHERE idMachine = :id";
		
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':id', $id, PDO::PARAM_INT);
		$req->bindParam(':etat', $etat, PDO::PARAM_INT);
		return $req->execute();
	}

	public function delete($id) {
		$sql = "DELETE FROM machine WHERE idMachine = :id";
		
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':id', $id, PDO::PARAM_INT);
		return $req->execute();
	}
}