<?php

namespace EasySwoole\Pay\Utility;

use EasySwoole\Pay\Exception\Wechat;

class AesGcm
{
    public const BLOCK_SIZE = 16;

    public const KEY_LENGTH_BYTE = 32;

    public const AUTH_TAG_LENGTH_BYTE = 16;

    public const ALGO_AES_256_GCM = 'aes-256-gcm';

    /**
     * The `aes-256-ecb` algorithm string
     */
    public const ALGO_AES_256_ECB = 'aes-256-ecb';


    public static function encrypt(string $plaintext, string $key, string $iv = '', string $aad = ''): string
    {
        if (!in_array(static::ALGO_AES_256_GCM, openssl_get_cipher_methods())) {
            throw new Wechat('It looks like the ext-openssl extension missing the `aes-256-gcm` cipher method.');
        }

        $ciphertext = openssl_encrypt($plaintext, static::ALGO_AES_256_GCM, $key, OPENSSL_RAW_DATA, $iv, $tag, $aad, static::BLOCK_SIZE);

        if (false === $ciphertext) {
            throw new Wechat('Encrypting the input $plaintext failed, please checking your $key and $iv whether or nor correct.');
        }

        return base64_encode($ciphertext . $tag);
    }

    public static function decrypt(string $ciphertext, string $key, string $iv = '', string $aad = ''): string
    {
        if (!in_array(static::ALGO_AES_256_GCM, openssl_get_cipher_methods())) {
            throw new Wechat('It looks like the ext-openssl extension missing the `aes-256-gcm` cipher method.');
        }

        $ciphertext = base64_decode($ciphertext);
        $authTag = substr($ciphertext, $tailLength = 0 - static::BLOCK_SIZE);
        $tagLength = strlen($authTag);

        /* Manually checking the length of the tag, because the `openssl_decrypt` was mentioned there, it's the caller's responsibility. */
        if ($tagLength > static::BLOCK_SIZE || ($tagLength < 12 && $tagLength !== 8 && $tagLength !== 4)) {
            throw new Wechat('The inputs `$ciphertext` incomplete, the bytes length must be one of 16, 15, 14, 13, 12, 8 or 4.');
        }

        $plaintext = openssl_decrypt(substr($ciphertext, 0, $tailLength), static::ALGO_AES_256_GCM, $key, OPENSSL_RAW_DATA, $iv, $authTag, $aad);

        if (false === $plaintext) {
            throw new Wechat('Decrypting the input $ciphertext failed, please checking your $key and $iv whether or nor correct.');
        }

        return $plaintext;
    }
}