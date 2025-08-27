<?php

namespace app\Services;

class EncryptDecryptCryptoService
{
    protected $clientPublicKey;
    protected $clientPrivateKey;

    public function __construct()
    {
        $this->clientPublicKey  = public_path('keys/client_public.pem');
        $this->clientPrivateKey = public_path('keys/client_private.pem');
    }

    /**
     * Encrypt payload with Client Public Key (.pem)
     */
    public function encryptWithPublicKey(array $payload): string
    {
        $plaintext = json_encode($payload);

        // Load public key from PEM
        $publicKey = openssl_pkey_get_public(file_get_contents($this->clientPublicKey));

        if (!$publicKey) {
            throw new \Exception('Invalid public key file.');
        }

        // Encrypt with RSA/ECB/PKCS1Padding (default for RSA)
        openssl_public_encrypt($plaintext, $encrypted, $publicKey, OPENSSL_PKCS1_PADDING);

        return base64_encode($encrypted);
    }

    /**
     * Decrypt payload with Client Private Key (.pem)
     */
    public function decryptWithPrivateKey(string $encryptedBase64): array
    {
        $encryptedData = base64_decode($encryptedBase64);

        // Load private key from PEM
        $privateKey = openssl_pkey_get_private(file_get_contents($this->clientPrivateKey));

        if (!$privateKey) {
            throw new \Exception('Invalid private key file.');
        }

        // Decrypt with RSA/ECB/PKCS1Padding
        openssl_private_decrypt($encryptedData, $decrypted, $privateKey, OPENSSL_PKCS1_PADDING);

        return json_decode($decrypted, true);
    }
}
