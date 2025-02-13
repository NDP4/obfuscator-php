<?php

namespace App\Services;

/**
 * PHP Code Obfuscator Service
 * 
 * This service provides functionality to obfuscate PHP code through various techniques:
 * - Function name obfuscation
 * - Variable name obfuscation
 * - String encryption using AES-256-CBC
 * - Code minification
 * 
 * @package App\Services
 */
class PhpObfuscatorService
{
    /** @var string */
    private $encryptionKey;

    /** @var array */
    private $functionNames = [];

    /**
     * Initialize the obfuscator service with encryption key
     */
    public function __construct()
    {
        // Pastikan key tepat 32 karakter
        $this->encryptionKey = substr(config('obfuscator.key'), 0, 32);
    }

    /**
     * Generate cryptographically secure random string
     * 
     * @param int $length Length of the random string
     * @return string
     */
    private function generateRandomString($length = 10): string
    {
        return substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

    /**
     * Encrypt data using AES-256-CBC
     * 
     * @param string $data Data to encrypt
     * @return string Encrypted data in hex format
     */
    private function encrypt($data): string
    {
        $method = 'AES-256-CBC';
        $ivlen = openssl_cipher_iv_length($method);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $key = hash('sha256', $this->encryptionKey, true);
        $encrypted = openssl_encrypt($data, $method, $key, OPENSSL_RAW_DATA, $iv);
        return bin2hex($iv . $encrypted); // Simplified format
    }

    /**
     * Minify PHP code while preserving functionality
     * 
     * @param string $code PHP code to minify
     * @return string Minified code
     * @throws \RuntimeException If regex pattern fails
     */
    private function minifyCode(string $code): string
    {
        try {
            // Define minification rules
            $minifyRules = [
                // Basic whitespace
                ['/\s+/', ' '],
                // Line endings
                ['/\r\n|\r|\n/', ''],
                // Spaces around operators
                ['/\s*([\{\}\[\]\(\)=+\-*\/%.,;:>~])\s*/', '$1'],
                // Multiple spaces to single
                ['/\s+/', ' '],
                // Space after function keyword
                ['/function(\w)/', 'function $1'],
                // Space before curly brace
                ['/(\w)\{/', '$1 {']
            ];

            // Apply each rule
            foreach ($minifyRules as [$pattern, $replacement]) {
                $code = preg_replace($pattern, $replacement, $code);
                if ($code === null) {
                    throw new \RuntimeException('Error in regex pattern: ' . $pattern);
                }
            }

            return $code;
        } catch (\Exception $e) {
            // If minification fails, return original code with basic cleanup
            return preg_replace(['/\s+/', '/\n+/'], [' ', "\n"], $code);
        }
    }

    /**
     * Generate unique name for decrypt function
     * 
     * @return string Random function name
     */
    private function generateDecryptFunctionName(): string 
    {
        return '_' . substr(md5(uniqid()), 0, 8);
    }

    /**
     * Encode sensitive strings to prevent detection
     * 
     * @param string $str String to encode
     * @return array [functionName, encodedString]
     */
    private function encodeString(string $str): array 
    {
        // Create a function name instead of direct eval
        $funcName = '_' . substr(md5(uniqid()), 0, 6);
        return [$funcName, "function {$funcName}(){return pack('H*','" . bin2hex($str) . "');}"];
    }

    /**
     * Main obfuscation method that processes PHP code
     * 
     * @param string $sourceCode Original PHP code
     * @param array $options Obfuscation options
     * @return string Obfuscated PHP code
     * @throws \RuntimeException If obfuscation fails
     */
    public function obfuscate(string $sourceCode, array $options = []): string
    {
        try {
            // Validasi input
            if (empty(trim($sourceCode))) {
                return '';
            }

            // Remove PHP tags first
            $sourceCode = preg_replace('/<\?php|\?>/', '', $sourceCode);
            
            $options = array_merge([
                'obfuscate_functions' => true,
                'obfuscate_variables' => true,
                'encrypt_strings' => true,
                'minify' => true
            ], $options);

            // Remove comments
            $sourceCode = preg_replace('!/\*.*?\*/!s', '', $sourceCode);
            $sourceCode = preg_replace('/\/{2,}.*\n/', '', $sourceCode);

            if ($options['obfuscate_functions']) {
                // Jangan obfuscate fungsi _d()
                $this->functionNames['_d'] = '_d';
                
                // Obfuscate function names
                $sourceCode = preg_replace_callback(
                    '/function\s+([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)/',
                    function($matches) {
                        if (!isset($this->functionNames[$matches[1]])) {
                            $this->functionNames[$matches[1]] = '_f' . $this->generateRandomString();
                        }
                        return 'function ' . $this->functionNames[$matches[1]];
                    },
                    $sourceCode
                );

                // Replace function calls
                foreach ($this->functionNames as $original => $obfuscated) {
                    $sourceCode = preg_replace('/\b' . preg_quote($original) . '\s*\(/', $obfuscated . '(', $sourceCode);
                }
            }

            if ($options['obfuscate_variables']) {
                // Obfuscate variable names
                $pattern = '/\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)/';
                $variables = [];
                
                $sourceCode = preg_replace_callback($pattern, function($matches) use (&$variables) {
                    if (!isset($variables[$matches[0]])) {
                        $variables[$matches[0]] = '$_' . $this->generateRandomString();
                    }
                    return $variables[$matches[0]];
                }, $sourceCode);
            }

            // Generate random variable names
            $vars = str_split('abcdefghijklmnopqrstuvwxyz', 1);
            shuffle($vars);
            $v1 = $vars[0]; 
            $v2 = $vars[1];
            $v3 = $vars[2];

            // Encode crypto functions
            [$hexbinFunc, $hexbinDef] = $this->encodeString('hex2bin');
            [$sha256Func, $sha256Def] = $this->encodeString('sha256');
            [$hashFunc, $hashDef] = $this->encodeString('hash');
            [$decryptFunc, $decryptDef] = $this->encodeString('openssl_decrypt');
            [$methodFunc, $methodDef] = $this->encodeString('AES-256-CBC');

            // Create helper functions
            $helperFunctions = $hexbinDef . $sha256Def . $hashDef . $decryptDef . $methodDef;
            
            // Create obfuscated decrypt function
            $decryptFuncName = $this->generateDecryptFunctionName();
            $vars = str_split('abcdefghijklmnopqrstuvwxyz', 1);
            shuffle($vars);
            $v = array_slice($vars, 0, 5);
            
            $decryptFunction = <<<EOD
            {$helperFunctions}
            function {$decryptFuncName}(\${$v[0]}){
                \${$v[1]}={$hexbinFunc}()(\${$v[0]});
                \${$v[2]}=substr(\${$v[1]},0,16);
                \${$v[3]}=substr(\${$v[1]},16);
                \${$v[4]}={$hashFunc}()({$sha256Func}(),'{$this->encryptionKey}',true);
                return {$decryptFunc}()(\${$v[3]},{$methodFunc}(),\${$v[4]},1,\${$v[2]});
            }
            EOD;

            if ($options['encrypt_strings']) {
                // Handle string concatenation differently
                $sourceCode = preg_replace_callback(
                    '/"([^"]+)"\s*\.\s*(\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)|"([^"]+)"/',
                    function($matches) use ($decryptFuncName) {
                        if (isset($matches[3])) {
                            // Single string without concatenation
                            return $decryptFuncName . '("' . $this->encrypt($matches[3]) . '")';
                        }
                        // String with concatenation
                        return $decryptFuncName . '("' . $this->encrypt($matches[1]) . '") . ' . $matches[2];
                    },
                    $sourceCode
                );
            }

            // Add minimal header and compact the code
            $sourceCode = "<?php " . $decryptFunction . $sourceCode;
            
            if ($options['minify']) {
                $sourceCode = preg_replace(
                    ['/\s+/', '/\s*([\{\}\[\]\(\)=+\-*\/%.,;:>~])\s*/'],
                    [' ', '$1'],
                    $sourceCode
                );
            }

            return $sourceCode;
        } catch (\Exception $e) {
            throw new \RuntimeException('Obfuscation failed: ' . $e->getMessage());
        }
    }
}