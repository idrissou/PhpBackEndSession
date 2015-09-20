<?php 
/*
These Backend Session classes were developped by Idriss Benarafa.
Feel Free to redistribute it and improve it to fit your taste.
Before getting started don't forget to create a DB called session with 3 parameters: (unique) id, data, and expiration_date 
	 

This is the Backend Flat File Session Implimentation Class. It make uses of the DB class to combine flatfiles DB sessions with 
DB session implementation

Every session has a uniqid like: 4b3403665fea6 
 microtime() returns the current Unix timestamp with microseconds.
*/ 

class session {
public $dbconnection;
	/** function construct()
     * This is the class constructor. It starts a new session.
     * The construct will check the existence of a session directory ( where the session files are stored). 
	 * If the specidic directory is not existant, then one with the name: session_folder will be created
     * @param  none
     * @return none
     */
	 
	function __construct() {
		define('ROOT',getcwd().DIRECTORY_SEPARATOR);
		if (!(is_dir((ROOT.'session_folder')))){
			mkdir(ROOT.'session_folder', 0700);
			define('SESSIONS_FOLDER',ROOT.'session_folder'.DIRECTORY_SEPARATOR);
		}
		else {
			define('SESSIONS_FOLDER',ROOT.'session_folder'.DIRECTORY_SEPARATOR);
		}
		$this->dbconnection = new db();
	}
	/** function modifySessionParameter($sessionid, $parametername, $newvalue)                                                                                                                                
	*This function modifies a specific parameter value.
	*Input
	*@param string $sessionid
	*@param string $parametername
	*@param string $newvalue
	*@return int
	*if the $parametername does not exist, the function returns -1
	*if the parametername exist, the old value, and the modification took place, the function returns 1
	*/
	function modifySessionParameter($sessionid, $parametername, $newvalue) {
	}
 
	/** function deleteSessionParameter($sessionid, $parametername)                                                                                                                                 
	*This function deletes a specific parameter .// to change a variable, I just overwrite it
	*Input
	*@param string $sessionid
	*@param string $parametername
	*@return int
	*if the $parametername does not exist, the function returns -1
	*if the parametername exist, and was deleted succesfully, the function returns 1
	*/

	function deleteSessionParameter($sessionid, $parametername){
	}


	/** function deleteAllParameters($sessionid)                                                                                                                                
	*This function deletes all session parameters.
	*@param string $sessionid
	*@return int
	*if the $parametername does not exist, the function returns -1
	*if all parameters were deleted succesfully, then the function returns 1
	*/


	function deleteAllParameters($sessionid){
	}


	/** function addParameter($sessionid, $parametername, $parametervalue)                                                                                                                                
	*This function adds a parameter to the session..
	*Input:
	*@param string $sessionid
	*@param string $parametername
	*@param string $parametervalue
	*@return int
	* if the parameter was added and succesfully initialized to the session, then the function returns 1
	*/

	function addParameter($sessionid, $parametername, $parametervalue){
		$this->dbconnection->insert($sessionid, $parametername, $parametervalue);
	}


	/** function destroySession($sessionid )                                                                                                                                 
	*This function destroys a session
	*Input: 
	*@param string $sessionid
	*@return int
	* if the session was destroyed, the function returns a 1 value
	*/
	function destroySession($sessionid ) {
	}

	/** function startSession()                                                                                                                                 
	*This function stats a session in case it wasn't already started by creating a new identifier
	*Input: none
	*Output: 
	*string $sessionid
	*/
	/* A uniqid, like: 4b3403665fea6 */
	// microtime() returns the current Unix timestamp with microseconds.
	function startNewSession(){
	$sessionid = 0;
		if (isset($_SERVER['REMOTE_ADDR']) &&  isset($_SERVER['HTTP_USER_AGENT']))
			$sessionid = md5(uniqid(microtime()) . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']); 
		else if (!isset($_SERVER['REMOTE_ADDR']) &&  isset($_SERVER['HTTP_USER_AGENT']))
			$sessionid = md5(uniqid(microtime()) . $_SERVER['HTTP_USER_AGENT']);	
		else if (isset($_SERVER['REMOTE_ADDR']) &&  !isset ($_SERVER['HTTP_USER_AGENT']))
			$sessionid = md5(uniqid(microtime()) . $_SERVER['REMOTE_ADDR']); 
		else
			$sessionid = md5(uniqid(microtime()));
		return $sessionid;
		/*  Testing purpusos Line *///echo 'The Generated Session Id is the following '.$sessionid; 
		
	}

	/** function checksifStarted($sessionid )                                                                                                                                
	*This function checks if  a session already started
	*Input: 
	*@param string $sessionid
	*@return int:
	*It returns 1 if the session already started
	*It returns 0 in case the session did not start yet
	*/

	function checksifStarted($sessionid ){
	}

/** function checkParameter($sessionid, $parametername)                                                                                                                                 
  *This function checks if  a  session's parameter exists
  *Input:
  *@param string $sessionid
  *@param string $parameter
  *@return int:
  *It returns 1 if the parameter already exists
  *It returns 0 in case the parameter does not exist
  */

// This function checks if  a  session's parameter exists
// It returns 1 if the parameter already exists
//It returns 0 in case the parameter does not exist

	function checkParameter($sessionid, $parametername){
	$this->dbconnection->read($sessionid, $parametername);
	
	}


/** function getParameter($sessionid, $parametername)                                                                                                                                 
  *This function returns the value of a parameter if  a  session's parameter exists
  *Input:
  *@param string $sessionid
  *@param string $parameter
  *@return int:
  *It returns the value of the parameter if the parameter exists
  *It returns 0 in case the parameter does not exist
  */
  function getParameter($sessionid, $parametername){
  }
  
   /********************************************
   *********************************************
   *********************************************
   *********************************************
   **********Flat File Functions****************
   *********************************************
   *********************************************
   *********************************************
   ********************************************/
   
   
	
	//Done
	function createFlatFile($sessionid){
		$myFile = ''.$sessionid.'.txt';
		$fh = fopen($myFile, 'w');
		$row = 'parametername parametervalue lastmodifieddate';
		fwrite($fh, $row);
		fclose($fh);

	}
	//Done
	function deleteFlatFile($sessionid){
		unlink(''.$sessionid.'.txt');
	}
	//Done
	function addParameterFlat($sessionid, $parametername, $parametervalue){
		$date = date('d/m/Y');
		$myFile = ''.$sessionid.'.txt';
		$fh = fopen($myFile, 'a');
		$row = ''.$parametername.' '.$parametervalue.' '.$date.'';
		fwrite($fh, $row);
		fclose($fh);

	// create a string here and assign to it a specific format you want 
	}
	
	/** function modifySessionParameter($sessionid, $parametername, $newvalue)                                                                                                                                
	*This function modifies a specific parameter value.
	*Input
	*@param string $sessionid
	*@param string $parametername
	*@param string $newvalue
	*@return int
	*if the $parametername does not exist, the function returns -1
	*if the parametername exist, the old value, and the modification took place, the function returns 1
	*/
	//Done
	function modifySessionParameterinflatfile($sessionid, $parametername, $newvalue) {
		$date = date('d/m/Y');
		$linereplacement = "".$parametername." ".$newvalue." ".$date." \n";
		$variabletolookfor = $parametername;
		$line=-1;
		$lncount = 0;
		$array = array();
		$handle = @fopen(''.$sessionid.'.txt', 'r');
		if ($handle) {
			while (($array[$lncount] = $buffer = fgets($handle, 4096)) !==  false) {
				$pieces = explode(' ', $buffer);
				$pieces[0] = str_replace('\n', '', $pieces[0]); 
				$pieces[0] = str_replace(' ', '', $pieces[0]);
				$lncount++;
				if ($pieces[0] == $variabletolookfor){
					$line = $lncount-1;
				}
			}
			if (!feof($handle)) {
				echo 'Error: unexpected fgets() fail\n';
			}
					fclose($handle);
		}
        if ($line == -1){
			return -1; // Not Found 
		}
		else{
			$myFile = ''.$sessionid.'.txt';
			$fh = fopen($myFile, 'w') or die("can't open file");
			for ($i = 0 ; $i < $lncount ; $i++){
				if ($i != $line  /* &&This is for the next Line $i != ($line+1)*/){
					fwrite($fh, $array[$i]);
				}
				else {
					fwrite($fh, $linereplacement);
				}
				}
			fclose($fh);
			return 1;
		}
	}
 
	/** function deleteSessionParameter($sessionid, $parametername)                                                                                                                                 
	*This function deletes a specific parameter .// to change a variable, I just overwrite it
	*Input
	*@param string $sessionid
	*@param string $parametername
	*@return int
	*if the $parametername does not exist, the function returns -1
	*if the parametername exist, and was deleted succesfully, the function returns 1
	*/
	//Done
	function deleteSessionParameterinflatfile($sessionid, $parametername){
		$variabletolookfor = $parametername;
		$line = -1;
		$lncount = 0;
		$array = array();
		$handle = @fopen(''.$sessionid.'.txt', 'r');
		if ($handle) {
			while (($array[$lncount] = $buffer = fgets($handle, 4096)) !==  false) {
				$pieces = explode(' ', $buffer);
				$pieces[0] = str_replace('\n', '', $pieces[0]); 
				$pieces[0] = str_replace(' ', '', $pieces[0]);
				$lncount++;
				if ($pieces[0] == $variabletolookfor){
					$line = $lncount-1;
				}
			}
			if (!feof($handle)) {
				echo 'Error: unexpected fgets() fail\n';
			}
			fclose($handle);
				}
        if ($line == -1){
			return -1;  // Could not find the parametername in the session File
			}
		else{
			$myFile = ''.$sessionid.'.txt';
			$fh = fopen($myFile, 'w') or die("can't open file");
			for ($i = 0 ; $i < $lncount ; $i++){
				if ($i != $line ){
					fwrite($fh, $array[$i]);
				}
			}
			fclose($fh);
			return 1;
		}	
	}


	/** function deleteAllParameters in the specific flat file($sessionid)                                                                                                                                
	*This function deletes all session parameters.
	*@param string $sessionid
	*@return int
	*if the $parametername does not exist, the function returns -1
	*if all parameters were deleted succesfully, then the function returns 1
	*/

    //Done
	function deleteAllParametersinflatfile($sessionid){
		unlink(''.$sessionid.'.txt');
		$myFile = ''.$sessionid.'.txt';
		$fh = fopen($myFile, 'w');
		$row = 'parametername parametervalue lastmodifieddate';
		fwrite($fh, $row);
		fclose($fh);
	}
	
	/** function checksifStarted($sessionid )                                                                                                                                
	*This function checks if  a session already started
	*Input: 
	*@param string $sessionid
	*@return int:
	*It returns 1 if the session already started
	*It returns 0 in case the session did not start yet
	*/

	function checksifStartedFlat($sessionid ){
		if (file_exists(''.$sessionid.'.txt')){
			return 1;
		}
		return 0;
	
	}

	/** function checkParameter($sessionid, $parametername)                                                                                                                                 
	*This function checks if  a  session's parameter exists
	*Input:
	*@param string $sessionid
	*@param string $parameter
	*@return int:
	*It returns 1 if the parameter already exists
	*It returns 0 in case the parameter does not exist
	*/
	
	// This function checks if  a  session's parameter exists
	// It returns 1 if the parameter already exists
	//It returns 0 in case the parameter does not exist

	function checkParameterFlat($sessionid, $parametername){
		$variabletolookfor = $parametername;
		$line = -1;
		$lncount = 0;
		$array = array();
		$handle = @fopen(''.$sessionid.'.txt', 'r');
		if ($handle) {
			while (($array[$lncount] = $buffer = fgets($handle, 4096)) !==  false) {
				$pieces = explode(' ', $buffer);
				$pieces[0] = str_replace('\n', '', $pieces[0]); 
				$pieces[0] = str_replace(' ', '', $pieces[0]);
				$lncount++;
				if ($pieces[0] == $variabletolookfor){
					$line = $lncount-1;
					return 1;
				}
			}
			if (!feof($handle)) {
				echo 'Error: unexpected fgets() fail\n';
			}
			fclose($handle);
				}
        if ($line == -1){
			return -1;  // Could not find the parametername in the session File
			}
		else{
			return 1;
		}
	}

	


}

?>