<?php
// Run: php generate-og-image.php
$w = 1200; $h = 630;
$img = imagecreatetruecolor($w, $h);

// Background: dark navy gradient top→bottom
for ($y = 0; $y < $h; $y++) {
    $ratio = $y / $h;
    $r = (int)(15 + $ratio * 12);
    $g = (int)(23 + $ratio * 8);
    $b = (int)(42 + $ratio * 30);
    $col = imagecolorallocate($img, $r, $g, $b);
    imageline($img, 0, $y, $w, $y, $col);
}

// Glow circles
for ($i = 0; $i < 80; $i++) {
    $alpha = 110 + $i;
    $c = imagecolorallocatealpha($img, 99, 102, 241, $alpha > 127 ? 127 : $alpha);
    imagefilledellipse($img, 200, 200, 600 - $i*5, 600 - $i*5, $c);
}
for ($i = 0; $i < 60; $i++) {
    $alpha = 115 + $i;
    $c = imagecolorallocatealpha($img, 139, 92, 246, $alpha > 127 ? 127 : $alpha);
    imagefilledellipse($img, 1050, 480, 420 - $i*4, 420 - $i*4, $c);
}

// Colors
$white  = imagecolorallocate($img, 255, 255, 255);
$indigo = imagecolorallocate($img, 165, 180, 252);
$green  = imagecolorallocate($img, 52,  211, 153);
$purple = imagecolorallocate($img, 196, 181, 253);

// --- Logo area: colored rect as proxy ---
$logoBg = imagecolorallocate($img, 99, 102, 241);
imagefilledroundrect($img, 100, 100, 176, 176, 20, $logoBg);
// "CP" monogram
imagestring($img, 5, 118, 128, 'CP', $white);

// Brand name
imagestring($img, 5, 196, 108, 'CompresslyPro', $white);
imagestring($img, 3, 197, 140, 'Free Online Image Tool', $indigo);

// Divider line
imageline($img, 100, 198, 1100, 198, imagecolorallocate($img, 55, 65, 120));

// Main headline (simulate large text with stacked lines)
$headline1 = 'Compress & Convert Images';
$headline2 = 'Up to 90% Smaller — Instantly';
imagestring($img, 5, 100, 225, $headline1, $white);
imagestring($img, 5, 100, 260, $headline2, $indigo);

// Features row
$features = [
    [100,  330, 'Compress JPG, PNG, WebP, GIF'],
    [100,  360, 'Convert between formats instantly'],
    [100,  390, 'No signup required  |  100% Free'],
    [100,  420, 'Up to 20MB  |  Files auto-deleted'],
    [650,  330, 'Drag & drop  |  Paste from clipboard'],
    [650,  360, 'Quality slider: 10% to 90%'],
    [650,  390, 'Privacy-first  |  No watermarks'],
    [650,  420, 'Works on mobile & desktop'],
];
foreach ($features as [$x, $y, $text]) {
    // checkmark
    imagestring($img, 4, $x, $y, chr(10003) . ' ' . $text, $green);
}

// Stats boxes
$statBg = imagecolorallocate($img, 26, 32, 70);
$boxes = [
    [100, 470, 200, 510, '90%',  'Max reduction'],
    [220, 470, 380, 510, '20MB', 'Max file size'],
    [400, 470, 560, 510, 'FREE', 'No credit card'],
    [580, 470, 760, 510, 'Fast', 'Seconds, not minutes'],
];
foreach ($boxes as [$x1,$y1,$x2,$y2,$val,$label]) {
    imagefilledrectangle($img, $x1, $y1, $x2, $y2, $statBg);
    imagerectangle($img, $x1, $y1, $x2, $y2, imagecolorallocate($img, 99, 102, 241));
    imagestring($img, 4, $x1+8,  $y1+5,  $val,   $white);
    imagestring($img, 2, $x1+8,  $y1+24, $label, $indigo);
}

// Bottom URL bar
$urlBg = imagecolorallocate($img, 79, 70, 229);
imagefilledrectangle($img, 0, 590, $w, 630, $urlBg);
imagestring($img, 4, 460, 603, 'compresslypro.com', $white);

// Save
imagepng($img, __DIR__ . '/public/og-image.png', 3);
imagedestroy($img);
echo "OG image saved to public/og-image.png\n";

// Helper: rounded rect (PHP < 8.1 doesn't have it built-in)
function imagefilledroundrect($img, $x1, $y1, $x2, $y2, $r, $color) {
    imagefilledrectangle($img, $x1+$r, $y1, $x2-$r, $y2, $color);
    imagefilledrectangle($img, $x1, $y1+$r, $x2, $y2-$r, $color);
    imagefilledellipse($img, $x1+$r, $y1+$r, $r*2, $r*2, $color);
    imagefilledellipse($img, $x2-$r, $y1+$r, $r*2, $r*2, $color);
    imagefilledellipse($img, $x1+$r, $y2-$r, $r*2, $r*2, $color);
    imagefilledellipse($img, $x2-$r, $y2-$r, $r*2, $r*2, $color);
}
