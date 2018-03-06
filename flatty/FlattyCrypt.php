<?php

// Flatty Crypt, by Kalan Brock @ The Biggest Nerd
// We love hacky projects! Give us a shout, I'm probably awake. - kalan@thebiggestnerd.com

namespace Flatty;

class FlattyCrypt {
    private static $private_key = "./mykey.pem";
    private static $public_key = "./mykey.pub";

    public static function encrypt($plaintext)
    {
        $fp = fopen(self::$public_key,"r");
        $pub_key = fread($fp,8192);
        fclose($fp);
        openssl_get_publickey($pub_key);
        openssl_public_encrypt($plaintext,$crypttext, $pub_key );

        return(base64_encode($crypttext));
    }

    public static function decrypt($encryptedext)
    {
        $fp = fopen(self::$private_key,"r");
        $priv_key = fread($fp,8192);
        fclose($fp);
        $private_key = openssl_get_privatekey($priv_key);
        openssl_private_decrypt(base64_decode($encryptedext), $decrypted, $private_key);

        return $decrypted;
    }
}