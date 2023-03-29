<?php

namespace Mhs;

class Internalization
{
    public function __construct() 
    {
        add_action( 'init', array( $this, 'languages' ) ); 
    }

    public function languages() 
    {
        load_plugin_textdomain( 'mhste', false, MHSTE_PLUGIN_DIR . '/languages' );
    }
}