oGravatar <a href="https://www.gittip.com/ReiDuKuduro/" target="__blank" alt="ReiDuKuduro @gittip" ><img alt="ReiDuKuduro @gittip" src="http://bottlepy.org/docs/dev/_static/Gittip.png" /></a>
=========

Simple class that provides easy gravatar integration

#Getting the avatar

First you need to create a oGravatar object, see below:
    
    $my_gravatar = new oGravatar('andre.r.flip@gmail.com');

If you want to use a secure connection, you'll need to pass `true` as second parameter.

Now that you have the object created, you can set the some properties like the image size, rating and a default image, in case of a non Gravatar account.

##Image Size

Simply use the `setSize` function and use an integer greater than 1 and less than 2048 for the pixel size.

    $my_gravatar->setSize(200);

##Image Rating

The function you need is `setRating` and you can use one of the following constants to simplify your life:

- `oGravatar::RATING_G`
- `oGravatar::RATING_PG`
- `oGravatar::RATING_R`
- `oGravatar::RATING_X`

Just like this:

    $my_gravatar->setRating(oGravatar::RATING_X);
    
##Default Image

As you can imagine, my creativity isn't that great, I called this function `setDefault`, you can either set the image path, that you want to define as default, or use one of the following constants:

- `oGravatar::DEFAULT_404`
- `oGravatar::DEFAULT_MM`
- `oGravatar::DEFAULT_IDENTICON`
- `oGravatar::DEFAULT_MONSTERID`
- `oGravatar::DEFAULT_WAVATAR`

Well, you know…

    $my_gravatar->setDefault(oGravatar::DEFAULT_MONSTERID);

##It's avatar time!!

Now that you know how to set some properties, you can get the image, to get the URL.

    $my_gravatar->getAvatarUrl();
    //http://en.gravatar.com/avatar/c34fd2d73a25fabf0bf9ef8f85dbae42?s=200&r=x&d=monsterid

If you dont want to loose time writing the HTML, you can do it this way:
    
    $attributes = array(
        'id'    => 'my_gravatar_image',
        'class' => 'some_random_class or-not',
        'style' => 'height: 200px',
        'width' => '200px'
    );
    $my_gravatar->getAvatar($attibutes);
    //<img src="http://en.gravatar.com/avatar/c34fd2d73a25fabf0bf9ef8f85dbae42?s=200&r=x&d=monsterid"  id="my_gravatar_image"  class="some_random_class or-not"  style="height: 200px"  width="200px"  />

#Getting the profile info

If you want to request the profile info simply call `$my_gravatar->getProfile();`, once you do that, you can check if they email you are using has a profile by doing something like this:

    if ($my_gravatar->has_profile) {
	    echo '<pre>';
    	print_r($my_gravatar);
	    echo '</pre>';
    } else {
	    echo "This email doesn't have a gravatar account";
    }
#But wait there is more…

… you can chain the functions, watch it:

    echo $my_gravatar->setSize(200)
                     ->setRating(oGravatar::RATING_X)
                     ->setDefault(oGravatar::DEFAULT_MONSTERID)
                     ->getAvatar($attributes);

