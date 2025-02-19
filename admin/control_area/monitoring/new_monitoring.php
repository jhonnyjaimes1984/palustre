<?php 
include_once "../../../conf/Config.php"; 

if(
!isset($_POST['id_staff_mon']) ||
!isset($_POST['species']) ||
!isset($_POST['id_individual_mon']) ||
!isset($_POST['status_mon']) ||
!isset($_POST['id_external_distutbance']) ||
!isset($_POST['interior_mon']) ||
!isset($_POST['external_mon']) ||
!isset($_POST['date']) ||
!isset($_POST['start_time_mon']) ||
!isset($_POST['finish_time_mon']) ||
!isset($_POST['take_mon_photo_video']) ||
!isset($_POST['id_master_routine']) ||
!isset($_POST['id_master_reproductive']) ||
!isset($_POST['id_master_chicken']) ||
!isset($_POST['id_meteorology']) ||
!isset($_POST['notes'])
) exit();

$id_staff_mon = $_POST['id_staff_mon'];
$specie = $_POST['species'];
$id_individual_mon = $_POST['id_individual_mon'];
$status_mon = $_POST['status_mon'];

$id_external_distutbance = $_POST['id_external_distutbance'];
$interior_mon = $_POST['interior_mon'];
$external_mon = $_POST['external_mon'];
$date = $_POST['date'];
$start_time_mon = $_POST['start_time_mon'];
$finish_time_mon = $_POST['finish_time_mon'];
$take_mon_photo_video = $_POST['take_mon_photo_video'];
$id_master_routine = $_POST['id_master_routine'];
$id_master_reproductive = $_POST['id_master_reproductive'];
$id_master_chicken = $_POST['id_master_chicken'];
$id_meteorology = $_POST['id_meteorology'];
$notes = $_POST['notes'];

// Coordinates
$lat = "39.34176535183375";
$lon = "-0.3199635470698924";

// Fetch weather data from wttr.in
$url = "https://wttr.in/{$lat},{$lon}?format=j1";
$data = file_get_contents($url);
if (!$data) {
    die("Error fetching weather data.");
}

// Decode JSON response
$weather = json_decode($data, true);

// Extract relevant weather details
$temperature = $weather["current_condition"][0]["temp_C"];
$humidity = $weather["current_condition"][0]["humidity"];
$wind_speed = $weather["current_condition"][0]["windspeedKmph"] . " km/h";
$wind_direction = $weather["current_condition"][0]["winddir16Point"];
$precipitation = $weather["current_condition"][0]["precipMM"];
$weather_condition = $weather["current_condition"][0]["weatherDesc"][0]["value"];
$pressure = $weather["current_condition"][0]["pressure"];
$visibility = $weather["current_condition"][0]["visibility"];
$uv_index = $weather["current_condition"][0]["uvIndex"];
$feels_like = $weather["current_condition"][0]["FeelsLikeC"];

// Insert data into MySQL
$peticion = $db->query("INSERT INTO `meteorology`(
    `temperature`,
    `humidity`,
    `wind_speed`,
    `wind_direction`,
    `precipitation`,
    `weather_condition`,
    `pressure`,
    `visibility`,
    `uv_index`,
    `feels_like`,
    `timestamp`) VALUES (
    '".$temperature."',
    '".$humidity."',
    '".$wind_speed."',
    '".$wind_direction."',
    '".$precipitation."',
    '".$weather_condition."',
    '".$pressure."',
    '".$visibility."',
    '".$uv_index."',
    '".$feels_like."',
    '".date('Y-m-d H:i:s a')."')");



$peticion_new_monitoring = $db->query("INSERT INTO `monitoring`(
	`id_staff_mon`,
	`specie`,
	`id_individual_mon`,
	`status_mon`,
	
	`id_external_distutbance`,
	`interior_mon`,
	`external_mon`,
	`date`,
	`start_time_mon`,
	`finish_time_mon`,
	`take_mon_photo_video`,
	`id_master_routine`,
	`id_master_reproductive`,
	`id_master_chicken`,
	`id_meteorology`,
	`notes`) VALUES (
	'".$id_staff_mon."',
	'".$specie."',
	'".$id_individual_mon."',
	'',
	
	'".$id_external_distutbance."',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	');