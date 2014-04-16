<?php

$serverName = "jdai.demo.aisnovations.com";

/* Connect using Windows Authentication. */
try
{
	$conn = new PDO( "sqlsrv:server=$serverName ; Database=jdai", "jdai", "MCkJEjWLL7biZvXR9jCL");
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
	catch(Exception $e)
{ 
	die( print_r( $e->getMessage() ) ); 
}

print_r('OK');
