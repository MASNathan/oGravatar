<?php


require_once 'oGravatar.php';

$g = new oGravatar('andre.r.flip@gmail.com');

//echo $g->getAvatar(array('width'=>'190'));

echo $g->setSize(200)
	->setDefault(oGravatar::DEFAULT_MONSTERID)
	->setRating(oGravatar::RATING_X)
	->getAvatar(array('width'=>'190'));

echo '<pre>';
$g->getProfile();
var_dump($g);