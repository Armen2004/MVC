<?php

class Hash {
    /*
     *  Hash::make("password", LOGIN_SALT);
     *  Hash::make("password", OTHER_SALT);
    */

    public static function make($data, $key = 1){
        $password = hash_init ( 'sha1' , HASH_HMAC, $key );
        hash_update($password, $data);

        return hash_final($password);
    }

}