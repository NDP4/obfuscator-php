<?php

return [
    'key' => env('OBFUSCATOR_KEY', str_pad(env('APP_KEY', ''), 32, 'x')),
];
