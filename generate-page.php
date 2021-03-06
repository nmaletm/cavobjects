<?php
header ("Content-Type: text/plain");  

include "class/includes.php";
include "data.php";

$pages = array(
	'index.html' => 'index.php?render=1',
	'sortByMark.html' => 'index.php?sort=mark&render=1',
	'sortByDate.html' => 'index.php?sort=date&render=1',
	'sortByDifficulty.html' => 'index.php?sort=difficulty&render=1',
);

$objects = $gallery->getObjects();

foreach ($objects as $object) {
	$path = 'view-'.$object->getId().'.html';
	$pages[$path] = 'view.php?render=1&id='.$object->getId();

	$photos = $object->getPhotos();

	foreach ($photos as $photo) {
		$photoPath = $photo->getPath();

		$sizes = $photo->getSizes();
		foreach ($sizes as $size) {
			$path = 'images/'.$size.'/'.$photoPath;
			$pages[$path] = 'photo.php?photo='.$photoPath.'&mode='.$size;
		}
	}

}

foreach($pages as $path => $page){
	$data = get('http://cavobjects.storn.es/'.$page);
	echo $path."\n";
	save($path, $data);
}

function get($url){
	$curl = curl_init();
	// Set some options - we are passing in a useragent too here
	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $url
	));
	// Send the request & save response to $resp
	$data = curl_exec($curl);
	if(!curl_exec($curl)){
		echo 'Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl) . "\n";
	}
	else{
		echo 'Get de '.$url."\n";
	}
	// Close request to clear up some resources
	curl_close($curl);
	return $data;
}

function save($path, $data){
	$buildPath = 'build/'.$path;
	$dirname = dirname($buildPath);
	if (!is_dir($dirname)) {
		mkdir($dirname, 0777, true);
	}

	$file = fopen($buildPath, 'w+');
	fwrite($file, $data);
	fclose($file);
}

?>