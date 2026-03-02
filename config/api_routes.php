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
    'compress'    => env('API_SLUG_COMPRESS',    '8f3879ade1c2e843'),
    'convert'     => env('API_SLUG_CONVERT',     '42a601706437881a'),
    'chunk'       => env('API_SLUG_CHUNK',       '07127203ff8fa7b5'),
    'finalize'    => env('API_SLUG_FINALIZE',    'fdb9a74646549352'),
    'batch'       => env('API_SLUG_BATCH',       'c3f1a2b4d5e6f7a8'),
    'batch_zip'   => env('API_SLUG_BATCH_ZIP',   'b8e7d6c5f4a3b2c1'),
    'resize'      => env('API_SLUG_RESIZE',      'a1b2c3d4e5f6a7b8'),
    'url_press'   => env('API_SLUG_URL_PRESS',   'f9e8d7c6b5a4f3e2'),
    'img_to_pdf'  => env('API_SLUG_IMG_TO_PDF',  'e2d3c4b5a6f7e8d9'),
    'pdf_to_img'  => env('API_SLUG_PDF_TO_IMG',  'd9c8b7a6f5e4d3c2'),
    'watermark'   => env('API_SLUG_WATERMARK',   'c2b1a0f9e8d7c6b5'),
    't2_chunk'      => env('API_SLUG_T2_CHUNK',      '9d8c7b6a5f4e3d2c'),
    't2_finalize'   => env('API_SLUG_T2_FINALIZE',   '1a2b3c4d5e6f7a8b'),
    'batch_finalize'=> env('API_SLUG_BATCH_FINALIZE','3e4f5a6b7c8d9e0f'),
];
