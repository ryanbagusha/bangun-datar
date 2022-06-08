<?php

// fungsi untuk menghitung luas segitiga
// dengan rumus 1/2 x alas x tinggi
function segitiga($a, $t)
{
    return ($a * $t) / 2;
}

// fungsi untuk menghitung luas persegi
// dengan rumus sisi x sisi
function persegi($s)
{
    return $s * $s;
}

// fungsi untuk menghitung luas lingkaran
// dengan rumus π x r²
function lingkaran($r)
{
    return 3.14 * ($r * $r);
}