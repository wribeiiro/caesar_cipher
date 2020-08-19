<?php 
    define("ALPHABET", "abcdefghijklmnopqrstuvwxyz");
    define("SALT", 4);

    function cipher(string $message, int $operation) {

        $str = "";
        $alphabet = str_split(ALPHABET);
        $message  = str_split($message);

        foreach ($message as $value) {
            if (in_array($value, $alphabet)) {
                $key = array_search($value, $alphabet);
                $str .= $alphabet[($key + ($operation * SALT)) % count($alphabet)];
            } else {
                $str .= $value;
            }
        }

        return $str;
    }

    function encrypt(string $message) {
        return cipher($message, 1);
    }

    function decrypt(string $message) {
        return cipher($message, -1);
    }

    if (isset($_GET["message"]) && isset($_GET["operation"])) {
        if (strtolower($_GET["operation"]) == "decrypt")
            echo decrypt($_GET["message"]);
        else
            echo encrypt($_GET["message"]);
    }
?>