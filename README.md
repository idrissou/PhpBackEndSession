# PhpBackEndSession
/*
These Backend Session classes were developped by Idriss Benarafa.
Feel Free to redistribute it and improve it to fit your taste.
Before getting started don't forget to create a DB called session with 3 parameters: (unique) id, data, and expiration_date 
	 
The following is a short example of how to start a session.
You could of course check before the start of a session wether that session has expired or not and so on.
Check the class session.php for reference 
*/ 
// creating a new session
$session = new session();
// starting a new session
// On success, will return the session id
$sessionId = $session->startNewSession();
//setting a paramater to the session
$session->addParameter("user","Idriss");
// deleting a session
$session->delete($sessionId);
?>

PHP Backend implementation of Sessions with 2 options (Database implementation and flat files ones).

Feel free to use both simultanously or one of them as you wish.

