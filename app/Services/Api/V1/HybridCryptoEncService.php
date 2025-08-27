<?php

namespace App\Services\Api\V1;

class HybridCryptoEncService
{
    private string $publicKeyPath;
    private string $privateKeyPath;

  /*  public function __construct()
    {
        $this->publicKeyPath = public_path('keys/client_public.pem');   // RSA Public Key
        $this->privateKeyPath = public_path('keys/client_private.pem'); // RSA Private Key
    }*/
    public function __construct(string $publicKeyPath = null, string $privateKeyPath = null)
    {
        $this->publicKeyPath = $publicKeyPath ?? public_path('keys/client_public.pem');
        $this->privateKeyPath = $privateKeyPath ?? public_path('keys/server_private.pem'); // 4096
    }

    /**
     * Encrypt payload using AES + RSA hybrid approach
     */
    public function encrypt(array $payload): array
    {
        $plaintext = json_encode($payload, JSON_UNESCAPED_UNICODE);

        // 1. Generate AES key & IV
        $aesKey = openssl_random_pseudo_bytes(16); // AES-128 → 16 bytes
        $iv = openssl_random_pseudo_bytes(16);

        // 2. Encrypt payload with AES
        $ciphertext = openssl_encrypt(
            $plaintext,
            'AES-128-CBC',
            $aesKey,
            OPENSSL_RAW_DATA,
            $iv
        );

        // 3. Encrypt AES key with RSA Public Key
        $publicKey = openssl_pkey_get_public(file_get_contents($this->publicKeyPath));
        openssl_public_encrypt($aesKey, $encryptedKey, $publicKey, OPENSSL_PKCS1_PADDING);

        return [
            'encryptedKey'      => base64_encode($encryptedKey),
            'iv'                => base64_encode($iv),
            'encryptedPayload'  => base64_encode($ciphertext),
        ];
    }

    /**
     * Decrypt payload using AES + RSA hybrid approach
     */
    public function decrypt(array $data): array
    {
        $encryptedKey = base64_decode($data['encryptedKey']);
        $iv = base64_decode($data['iv']);
        $encryptedPayload = base64_decode($data['encryptedPayload']);

        // 1. Decrypt AES key using RSA Private Key
        $privateKey = openssl_pkey_get_private(file_get_contents($this->privateKeyPath));
        openssl_private_decrypt($encryptedKey, $aesKey, $privateKey, OPENSSL_PKCS1_PADDING);

        // 2. Decrypt payload using AES
        $plaintext = openssl_decrypt(
            $encryptedPayload,
            'AES-128-CBC',
            $aesKey,
            OPENSSL_RAW_DATA,
            $iv
        );

        return json_decode($plaintext, true);
    }
}
