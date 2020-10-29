<?php
function format_uang($angka){ 

	$angka = filter_var($angka, FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_THOUSAND);
    $hasil =  number_format($angka,0, ',' , '.'); 
    return $hasil; 
}