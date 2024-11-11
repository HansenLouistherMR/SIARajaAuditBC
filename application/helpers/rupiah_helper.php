<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('rupiah')) {
    function rupiah($angka) {
        // Convert the input to a float to avoid the error
        $angka = floatval($angka);
        
        // Format the number to Indonesian Rupiah format
        $hasil_rupiah = number_format($angka, 0, ',', '.');
        return $hasil_rupiah;
    }
}

?>