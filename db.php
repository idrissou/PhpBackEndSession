<?php
/*
These Backend Session classes were developped by Idriss Benarafa.
Feel Free to redistribute it and improve it to fit your taste.
Before getting started don't forget to create a DB called session with 3 parameters: (unique) id, data, and expiration_date 
	 
*/

class db {
	/** function construct()
     * This is the class constructor. It starts a new session.
     * The construct will check the existence of a session directory ( where the session files are stored). 
	 * If the specidic directory is not existant, then one with the name: session_folder will be created
     * @param  none
     * @return none
     */
	 public $pdo_options;
	 public $bdd;
	 
	 
	function __construct() {
		$this->pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$this->bdd = new PDO('mysql:host=localhost;dbname=session', 'root', '', $this->pdo_options);
	}

	function read ( $sessionid){
		try{
			$req = $this->bdd->prepare('SELECT * FROM sessions where   id=?');
			$req->execute(array($sessionid));
			while ($donnees = $req->fetch()){
				// This is to limit SQL injection 
				echo ' \n The Value is '.$donnees['data'];
				
			}
	   
		}
		catch(Exception $e){
			die('Erreur : '.$e->getMessage());
		}
	}
	
	function delete ( $sessionid){
		try{
			$req = $this->bdd->prepare('DELETE  FROM sessions where   id=?');
			$count = $req->execute(array($sessionid));
			echo 'Numbers of rows deleted is :'.$count.'';
	   
		}
		catch(Exception $e){
			die('Erreur : '.$e->getMessage());
		}
	}
	
	function delete2 ( $sessionid, $data ){
		try{
			$req = $this->bdd->prepare('DELETE  FROM sessions where   id=? and data=?');
			$count = $req->execute(array($sessionid, $data));
			echo 'Numbers of rows deleted is :'.$count.'';
	   
		}
		catch(Exception $e){
			die('Erreur : '.$e->getMessage());
		}
	}
	
	
	function update ( $sessionid, $data ){
		try{
			$req = $this->bdd->prepare('UPDATE   sessions SET  data=?  WHERE id=?');
			$count = $req->execute(array($data, $sessionid));
			echo 'Numbers of rows updated is :'.$count.'';
	   
		}
		catch(Exception $e){
			die('Erreur : '.$e->getMessage());
		}
	}
	
	function insert($sessionid, $data, $expiration_date){
		try{
			$req = $this->bdd->prepare('INSERT INTO sessions( id, data , expiration_date  ) VALUES( :id, :data, :expiration_date)');  
			$req->execute(array(
			'id' => $sessionid,
			'data' => $data,
			'expiration_date' => $expiration_date,
			
			));
			echo' It worked';
		}

		catch(Exception $e){
			die('Erreur : '.$e->getMessage());
		}
	}
}
?>