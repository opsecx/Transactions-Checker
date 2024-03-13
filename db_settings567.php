<?php

//database configuration
//replace with correct values for your setup

$db_host = 'localhost';
$db_port = '5432';
$db_name = 'dbname';  
$db_user = 'dbuser';
$db_password = '';

//end of user settings
//leave the following untouched

if (empty($db_name) or empty($db_user) or empty($db_password)) {
	die('update database settings');
} else {
	//returns $dbconn connection if successful for further use
	$dbconn = pg_connect("host=$db_host dbname=$db_name user=$db_user password=$db_password port=$db_port") or die('database connection error');
}

//check if our schema exists and create if not
$schema_query = "SELECT schema_name FROM information_schema.schemata WHERE schema_name = 'tcheck'";
$results_schema =  pg_query($dbconn, $schema_query) or die('could not fetch schema information');
$schema_name = pg_fetch_array($results_schema, null, PGSQL_NUM)[0];

if ($schema_name != 'tcheck') {
  pg_query($dbconn, "CREATE SCHEMA tcheck") or die('could not create schema');
}

$create_table_query = "CREATE TABLE tcheck.players (
  moniker VARCHAR(150),
  implicit_address VARCHAR(50),
  public_key VARCHAR(100),
  score VARCHAR(45),
  class VARCHAR(17)
)";

$check_table_query = "SELECT EXISTS (
    SELECT FROM
        pg_tables
    WHERE
        schemaname = 'tcheck' AND
        tablename  = 'players'
    );";


$check_table_results = pg_query($dbconn, $check_table_query) or die('could not check table');

if (!pg_fetch_array($check_table_results, null, PGSQL_NUM)[0]) {
  pg_query($dbconn, $create_table_query) or die('could not create table');
}








?>
