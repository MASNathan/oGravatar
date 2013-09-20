<?php

/**
 * oGravatar example file
 * 
 * @package	oGravatar
 * @author	André Filipe <andre.r.flip@gmail.com>
 * @link	https://github.com/ReiDuKuduro/oGravatar Github Repo
 * @license	MIT
 * @version	1.0
 */

require_once 'oGravatar.php';

$my_gravatar = new oGravatar('andre.r.flip@gmail.com');

$my_gravatar->setSize(200);

$my_gravatar->setRating(oGravatar::RATING_X);

$my_gravatar->setDefault(oGravatar::DEFAULT_MONSTERID);

$attributes = array(
    'id'    => 'my_gravatar_image',
    'class' => 'some_random_class or-not',
    'style' => 'height: 200px',
    'width' => '200px',
);
echo $my_gravatar->getAvatar($attributes);

echo '<br>';

echo $my_gravatar->getAvatarUrl();

echo '<br>';

$my_gravatar->getProfile();

if ($my_gravatar->has_profile) {
    echo '<pre>';
    print_r($my_gravatar);
    echo '</pre>';
} else {
    echo "This email doesn't have a gravatar account";
}

/*

//Chaining stuff
$my_gravatar = new oGravatar('andre.r.flip@gmail.com', true);

$attributes = array(
    'id'    => 'my_gravatar_image',
    'class' => 'some_random_class or-not',
    'style' => 'height: 200px',
    'width' => '200px',
);

echo $my_gravatar->setSize(200)
                 ->setRating(oGravatar::RATING_X)
                 ->setDefault(oGravatar::DEFAULT_MONSTERID)
                 ->getAvatar($attributes);
//*/
