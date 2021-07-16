<?php

	echo "<pre>";
	error_reporting(E_ERROR);
	$dbh = new SQLite3('users.db');
	
	$sql  = "DROP TABLE IF EXISTS user;\n";
	$sql .= "DROP TABLE IF EXISTS salt;\n";
	
	$sql .= "CREATE TABLE user (\n";
	$sql .= "\tlogin varchar(8) PRIMARY KEY,\n";
	$sql .= "\tforename varchar(20),\n";
	$sql .= "\tsurname varchar(20),\n";
	$sql .= "\tpasshash varchar(64)\n";
	$sql .= ");\n";
	
	$sql .= "CREATE TABLE salt (\n";
	$sql .= "\tlogin varchar(8),\n";
	$sql .= "\tsalt varchar(64)\n";
	$sql .= ");\n";
	
	echo $sql;
	
	if ($dbh->exec( $sql ))
		echo "Members database & tables created\n\n";
	else
		echo "Database and table failed\n\n";
		
	$login   =
	array('Ife','Almas','Maryam','Rob','Nik','Jake','Si','Em','Hurricane','Omar','Tayyaba','Pikachu','Tom','Crater','Riggaz','Lauren');
	$forename =
	array('Ifeoluwa','Almas','Maryam','Robert','Nikita','Jake','Simon','Emily','Shakil','Omar','Tayyaba','Koyesh','Tom','Carter','James','Lauren');
	$surname =
	array('Amusan','Asghar','Bibi','Carvalho','Dunajevs','Finnegan','Flynn','Green','Hussain','Hussein','Iqbal','Miah','Miller','Ormston','Rigby','Speak');
	$password =
	array('PotterMore90*','123456','Cadburys','7777','QW3RTY','£$blazin','football','dragon','123456789','letmein','Borat','420Blazin','mustang','MisChief666*','lion');

	$salt = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);	
?>