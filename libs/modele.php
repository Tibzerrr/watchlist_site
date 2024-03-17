<?php

include_once "maLibSQL.pdo.php";

function console_log($output, $with_script_tags = true) {
	$js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
	if ($with_script_tags) {
		$js_code = '<script>' . $js_code . '</script>';
	}
	echo $js_code;
}

function add_movie($title,$grade,$duration,$year_of_release, $genre,$synopsis,$actors, $director, $writer, $picture) {
	$SQL = "INSERT INTO movie_data(title, grade, duration, year_of_release, genre, synopsis, watched_status, actors, director, writer, picture) 
	VALUES('$title',$grade,'$duration', '$year_of_release', '$genre', '$synopsis' , 2, '$actors', '$director', '$writer', '$picture')";
	console_log($SQL);
	return SQLInsert($SQL);
}

function getMovies($title="", $status="", $genre="",$order="", $high="", $low=""){
	$SQL = "SELECT * FROM movie_data WHERE duration";

	if ($title){
		$SQL = "SELECT * FROM movie_data WHERE title LIKE '%$title%'";
	}
	if ($status){
		$SQL = "SELECT * FROM (" . $SQL . ") a WHERE watched_status='$status'";
	}
	if ($genre){
		$SQL = "SELECT * FROM (" . $SQL . ") b WHERE genre LIKE '%$genre%'";
	}
	if ($high){
		$SQL = "SELECT * FROM (" . $SQL . ") c WHERE duration<'$high'";
	}
	if ($low){
		$SQL = "SELECT * FROM (" . $SQL . ") d WHERE duration>'$low'";
	}
	if ($order=="Year of release"){
		$SQL = "SELECT * FROM (" . $SQL . ") e ORDER BY year_of_release ASC";
	}
	if ($order=="Movie rating"){
		$SQL = "SELECT * FROM (" . $SQL . ") e ORDER BY grade ASC";
	}
	if ($order=="Alphabetical order"){
		$SQL = "SELECT * FROM (" . $SQL . ") e ORDER BY title DESC";
	}
	if ($order=="Length"){
		$SQL = "SELECT * FROM (" . $SQL . ") e ORDER BY duration DESC";
	}
	return parcoursRs(SQLSelect($SQL));
}

function removeMovie($title){
	$SQL = "DELETE FROM movie_data WHERE title='$title'";
	return parcoursRs(SQLSelect($SQL));
}

function changeStatus($title){
	$SQL = "UPDATE movie_data SET watched_status=IF(watched_status=2,1,2) WHERE title='$title'";
	return parcoursRs(SQLSelect($SQL));
}
?>