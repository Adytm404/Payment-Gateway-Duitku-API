<?php
// return?merchantOrderId=NYAN1688572799&resultCode=01&reference=D730923LFD1YV3TKWXVK5V


$merchantOrderId = $_GET['merchantOrderId'];
$resultCode = $_GET['resultCode'];
$reference = $_GET['reference'];

if($resultCode != '00'){
    echo 'Transaksi Anda Belum Sukses <br>';
    echo 'Merchant ID: ' . $merchantOrderId . ' <br>';
    echo 'Reference: ' . $reference . ' <br>';
}else{
    echo 'Transaksi Anda Sukses <br>';
    echo 'Merchant ID: ' . $merchantOrderId . ' <br>';
    echo 'Reference: ' . $reference . ' <br>';
}

?>