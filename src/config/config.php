<?php

return array(

    'commands' => array(
    	'jpg' => 'jpegoptim --strip-all %s',
    	'png' => 'optipng %s',
    ),

    'folders' => array(
    	'jpg' => array(
    		public_path().'/assets/images/*.jpg',
    	),
    	'png' => array(
    		public_path().'/assets/images/*.png',
    	),
    )
);
