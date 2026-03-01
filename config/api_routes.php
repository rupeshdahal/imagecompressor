<?php

/*
|--------------------------------------------------------------------------
| Obfuscated API Route Slugs
|--------------------------------------------------------------------------
| These random tokens are the URL segments used for AJAX endpoints.
| Change them in .env (API_SLUG_*) to rotate all endpoint URLs instantly.
| Never commit real values — keep .env out of version control.
*/

return [
    'compress'  => env('API_SLUG_COMPRESS',  '8f3879ade1c2e843'),
    'convert'   => env('API_SLUG_CONVERT',   '42a601706437881a'),
    'chunk'     => env('API_SLUG_CHUNK',     '07127203ff8fa7b5'),
    'finalize'  => env('API_SLUG_FINALIZE',  'fdb9a74646549352'),
];
