<?php
ini_set("memory_limit","1000M");
class Base64 {
  
  private static $base = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/'; //64 bit base64

  public static function encode($plain) { //misal memakai kata MANUSIA
    $len = strlen($plain);
    $pad_len = (3 - ($len % 3)) % 3; //modulus atau sisa bagi, kemudian sisanya nanti dipakai untuk MANUSIA karena ada 7 karakter dan dipecah jadi tiga tiga sehingga MAN USI A00 <---
  
    $padded = str_pad($plain, $len + $pad_len, chr(0)); //DIPAKSA HARUS 12 WAITU DITAMBAH 00
  
    $encoded = '';
  
    for ($i = 0; $i < $len; $i += 3) { //atribut1, atribut2, perulangan 3 kali
      $int = (ord($padded[$i]) << 16) + (ord($padded[$i+1]) << 8) + ord($padded[$i+2]); //ord menampilkan fungsi ASCII kebalikan dr chr
      
      $bi[0] = ($int >> 18) & 0x3F;
      $bi[1] = ($int >> 12) & 0x3F;
      $bi[2] = ($int >> 6) & 0x3F;
      $bi[3] = $int & 0x3F;

      $encoded .= static::$base[$bi[0]].static::$base[$bi[1]].static::$base[$bi[2]].static::$base[$bi[3]];
    }
  
    return str_pad(substr($encoded, 0, strlen($encoded) - $pad_len), strlen($encoded), '='); //DIPAKSA HARUS 12 YAITU DITAMBAH ==
  }
  
  public static function decode($encode) {
    $len = strlen($encode);
    $pad_len = substr_count($encode, '=');
    $zeropad = str_pad($encode, $len + $pad_len, 'A');
  
    $decoded = '';
  
    for ($i = 0; $i < $len; $i += 4) {
      $n = (strpos(static::$base, $encode[$i]) << 18) + (strpos(static::$base, $encode[$i+1]) << 12) + (strpos(static::$base, $encode[$i+2]) << 6) + strpos(static::$base, $encode[$i+3]); //Fungsi strpos(); berguna untuk mencari tahu dimana posisi sebuah karakter 

      $ni[0] = chr(($n >> 16) & 0xFF);
      $ni[1] = chr(($n >> 8) & 0xFF);
      $ni[2] = chr($n & 0xFF);

      $decoded .= $ni[0].$ni[1].$ni[2];
    }
  
    return substr($decoded, 0, strlen($decoded) - $pad_len);
  }
  
//decode
//-------
// X = Hitung panjang karakter base64 yang diinput
// Y = Hitung banyak karakter '='

// Z = X + (Tambahkan karakter 'A' sebanyak Y)

//FOR I = 0; I < Z; I += 4 // per 4 karakter = 32 bit

//TWFu dXNp YQ== AA

//A = (POSISI(Index ke I) MUNDUR 18 bit)  + (POSISI(Index ke I+1) MUNDUR 12 bit) + (POSISI(Index ke I+2) MUNDUR 6 bit) + (POSISI(Index ke I+3))

//B = (A MAJU 16 bit) di AND sama 0xFF
//C = (A MAJU 8 Bit) di AND sama 0xFF
//D = A  di AND sama 0xFF

//E += B+C+D

//ENDFOR

  
  public static function isValid($encode, $isfile = false) {
    if ($isfile)
      return preg_match('/[a-zA-Z0-9\/+]+={0,2}\|[a-zA-Z0-9\/+]+={0,2}/', $encode);
    return preg_match('/[a-zA-Z0-9\/+]+={0,2}/', $encode);
  }
}
