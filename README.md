# PhpBackEndSession
PHP Backend implementation of Sessions with 2 options (Database implementation and flat files ones)

These Backend Session classes were developped by Idriss Benarafa.

Feel Free to redistribute it and improve it to fit your taste.
 
Before getting started don't forget to create a DB called session with 3 parameters: (unique) id, data, and expiration_date 

The following is a short example of how to start a session.


creating a new session
$session = new session();

starting a new session
$sessionId = $session->startNewSession();

setting a paramater to the session
$session->addParameter("user","Idriss");

deleting a session
$session->delete($sessionId);
Any questions or remarks, feel free to contact me at: idriss.benarafa@gmail.com. I answer swiftly.

Idriss
