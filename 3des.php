<?php
#3des加密  EBC模式  7padding填充  密钥24位（自定义）  初始化向量IV可以默认
$keyForTDES = "123456789012345678901234";//加密所用密钥
$defaultIV = "XXXXXXX";//初始化向量IV
//$defaultIV = mcrypt_create_iv( mcrypt_enc_get_iv_size( $td ), MCRYPT_RAND );
 class Cryptogram {
     /**
       * 使用3DES加密源数据
       * @param string $oriSource 源数据
       * @param string $key       密钥
      * @param string $defaultIV 加解密向量
      * @return string $result   密文
      */
     public static function encryptByTDES($oriSource, $key, $defaultIV=''){
         $oriSource = self::addPKCS7Padding($oriSource);
         $td = mcrypt_module_open(MCRYPT_3DES, '', MCRYPT_MODE_ECB, '');
         $defaultIV = mcrypt_create_iv( mcrypt_enc_get_iv_size( $td ), MCRYPT_RAND );
         mcrypt_generic_init($td, $key, $defaultIV);
         $result = mcrypt_generic($td, $oriSource);
         mcrypt_generic_deinit($td);
         mcrypt_module_close($td);
         return $result;
     }

     /**
      * 使用3DES解密密文
      * @param string $encryptedData 密文
      * @param string $key           密钥 
      * @param string $defaultIV     加解密向量
      * @return string $result       解密后的原文
      */
     public static function decryptByTDES($encryptedData, $key, $defaultIV=''){
         $td = mcrypt_module_open(MCRYPT_3DES, '', MCRYPT_MODE_ECB, '');
         $defaultIV = mcrypt_create_iv( mcrypt_enc_get_iv_size( $td ), MCRYPT_RAND );
         mcrypt_generic_init($td, $key, $defaultIV);
         $result = mdecrypt_generic($td, $encryptedData);
         mcrypt_generic_deinit($td);
         mcrypt_module_close($td);
        $result = self::stripPKSC7Padding($result);
         return $result;
     }


     /**
      * 为字符串添加PKCS7 Padding
      * @param string $source    源字符串
      */
     protected static function addPKCS7Padding($source){
     $block = mcrypt_get_block_size('tripledes', 'ecb');
     $pad = $block - (strlen($source) % $block);
     if ($pad <= $block) {
         $char = chr($pad);
        $source .= str_repeat($char, $pad);
     }
     return $source;
     }


     /**
      * 去除字符串末尾的PKCS7 Padding
      * @param string $source    带有padding字符的字符串
      */
     public static function stripPKSC7Padding($source){
         $block = mcrypt_get_block_size('tripledes', 'ecb');
     $char = substr($source, -1, 1);
     $num = ord($char);
     if($num > 8){
         return $source;
     }
     $len = strlen($source);
     for($i = $len - 1; $i >= $len - $num; $i--){
        if(ord(substr($source, $i, 1)) != $num){
             return $source;
         }
     }
     $source = substr($source, 0, -$num);
     return $source;
     }
 }
$str = '{"clientNo":"608087246","seqNo":"010010049002","timestamp":"20180621110143","sign":"970eb39ea1b9f528cd7ce3bce78219be"}';
$encode = base64_encode(Cryptogram::encryptByTDES($str,$keyForTDES));
echo 'encode: '.$encode.'<br/>';
echo Cryptogram::decryptByTDES(base64_decode($encode),$keyForTDES);
