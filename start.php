<?php 
require 'simplepie/autoloader.php';


$urls = include 'feeds.php';

$feed = new SimplePie();
$feed->set_feed_url($urls);
$feed->enable_cache(false);

$feed->init();

$items = $feed->get_items();

usort($items, function($a, $b){
	return strnatcasecmp($a->get_title(), $b->get_title());
});

$news = Array();

foreach($items as $item){
	
	$feed = Array(
		"title"=>$item->get_title(),
		"date"=>getDateFormat(strtotime($item->get_date('Y-m-d H:i:s'))),
		"author"=>$item->get_author()->get_name(),
		"description"=>$item->get_description(),
		"link"=>$item->get_link(),
		"itemId"=>$item->get_id(true)
	);
	
	array_push($news, $feed);
}


return $news;

function getDateFormat($dateTimeStamp){
		$months = array("Enero"=>1,"Febrero"=>2,"Marzo"=>3,"Abril"=>4,"Mayo"=>5,"Junio"=>6,"Julio"=>7,"Agosto"=>8,"Septiembre"=>9,"Octubre"=>10,"Noviembre"=>11,"Diciembre"=>12);

		$year = date('Y',$dateTimeStamp);
		$month = date('n',$dateTimeStamp);
		$day = date('d',$dateTimeStamp);
		$dayOfWeek = date('w',$dateTimeStamp);
		
		$hour = date('h',$dateTimeStamp);
	    $minut = date('i',$dateTimeStamp);
	    $second = date('s',$dateTimeStamp);
		
		return $day."/".array_search($month, $months)."/".$year." ".$hour."-".$minut."-".$second;
	}