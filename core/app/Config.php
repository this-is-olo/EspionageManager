<?php

namespace Project\Helpers;

require_once 'misc.php';

class Config{

    protected $data;
    protected $default;

    public function loadConfigFile( $file ){
        $file = sanitize($file);

        $this->data = require $file;
    }

    public function get($key, $default = null){
        $key = sanitize($key);
        $default = sanitize($default);

        $this->default = $default;

        $segments = explode('.', $key);
        $data = $this->data;

        foreach( $segments as $segment ){
            if( isset( $data[$segment] ) ){
                $data = $data[$segment];
            } else {
                $data = $this->default;
                break;
            }
        }

        return $data;
    }

    //to be removed
    public function get_raw(){
        return $this->data;
    }

}

?>