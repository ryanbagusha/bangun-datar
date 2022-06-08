<?php
// Mengambil data JSON dari data.txt
function getData($shape = null)
{
    // lokasi file
    $filename = "../data/data.txt";
    // deklarasi array pada variabel $data
    $data = [];

    // Mengecek apakah data.txt sudah dibuat
    if (file_exists($filename)) {
        // mengambil data dan mengubahnya kedalam bentuk array 
        $raw = json_decode(file_get_contents($filename), true);
        // jika parameter tidak null maka filter data
        if($shape != null) {
            // mengambil hanya data sesuai dengan parameter
            foreach($raw as $result) {
                if($result['bentuk'] == $shape) {
                    $data[] = $result;
                }
            }

            // Mengurutkan array 
            $ord = array();
            foreach ($data as $key => $value){
                $ord[] = strtotime($value['waktu']);
            }
            array_multisort($ord, SORT_DESC, $data);

            return $data;
        } else {
            // jika tidak kembalikan nilai semua data
            return $raw;
        }
    } else {
        return null;
    }
}

// save data ke data.txt
function save($data)
{
    // penanganan error
    try {
        // lokasi file
        $filename = "../data/data.txt";
        // deklarasi array pada variabel $hasil
        $hasil = [];

        // Mengecek apakah data.txt sudah dibuat
        if (file_exists($filename)) {
            // mengambil data
            $hasil = getData();
        }

        // menambahkan array $data kedalam array $hasil
        $hasil[] = $data;

        // mengubah $hasil kedalam bentuk JSON dan menyimpannya ke file 
        file_put_contents($filename, json_encode($hasil));

        return true;
    } catch (Exception $e) {
        // jika try gagal dijalankan
        return false;
    }
}