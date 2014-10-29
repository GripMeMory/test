<?php
    $string1 = "佳哥";
    echo $string1."\n";
    $string = encrypt($string1);
    var_dump($string);
    function encrypt($string, $key = 'wsefojs23r_9EH%^UW') {
    $key = md5 ( $key );
    $key_length = strlen ( $key );
    $string = substr ( md5 ( $string . $key ), 0, 8 ) . $string;
    $string_length = strlen ( $string );
    $rndkey = $box = array ();
    $result = '';
    for($i = 0; $i <= 255; $i ++) {
        $rndkey [$i] = ord ( $key [$i % $key_length] );
        $box [$i] = $i;
    }
    for($j = $i = 0; $i < 256; $i ++) {
        $j = ($j + $box [$i] + $rndkey [$i]) % 256;
        $tmp = $box [$i];
        $box [$i] = $box [$j];
        $box [$j] = $tmp;
    }
    for($a = $j = $i = 0; $i < $string_length; $i ++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box [$a]) % 256;
        $tmp = $box [$a];
        $box [$a] = $box [$j];
        $box [$j] = $tmp;
        $result .= chr ( ord ( $string [$i] ) ^ ($box [($box [$a] + $box [$j]) % 256]) );
    }
    return str_replace ( '=', '', base64_encode ( $result ) );
}
?>