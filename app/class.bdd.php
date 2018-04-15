<?php 
	class Bdd {
		private $instance = null;

		public function __construct() {
			
		if($_SERVER['HTTP_HOST'] == 'localhost'){
			$sql_hote = 		'localhost';
			$sql_utilisateur = 	'root';
			$sql_pass = 		'';
			$sql_bdd = 			'lesartisans';
		} else {
			$sql_hote = 		'localhost';
			$sql_utilisateur = 	'c2Deco';
			$sql_pass = 		'nw3DRgTW';
			$sql_bdd = 			'c2Deco';
		}
	
			try {
			
				$this->instance = new PDO('mysql:host=' . $sql_hote . ';dbname=' . $sql_bdd, $sql_utilisateur, $sql_pass);
				// $this->instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
				$this->instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
			} catch(PDOException $e) {
				echo 'ERREUR: ' . $e->getMessage();
			}
		}

		public function getInstance() {
			return $this->instance;
		}
	}
?>