<?php
header('Content-Type: application/json');
$videos = [];

$i=0;
$variable = [
    'https://drive.google.com/open?id=0B1zCZ0CBPrevOHhiQzA3Mkppdkk',
    'https://drive.google.com/open?id=0B1zCZ0CBPrevOHB2dXhBTDloZFE',
    'https://drive.google.com/open?id=0B1zCZ0CBPrevQ0tWaTlhNlJ3S1E',
    'https://drive.google.com/open?id=0B1zCZ0CBPreveUN0Z0d4RTdiZUU',
    'https://drive.google.com/open?id=0B1zCZ0CBPrevcS1tUEh2Y3NCeGs',
    'https://drive.google.com/open?id=0B1zCZ0CBPrevMzNLTjZfV3RlMlU',
    'https://drive.google.com/open?id=0B1zCZ0CBPrevdkZyNF9ralFCaW8',
    'https://drive.google.com/open?id=0B1zCZ0CBPrevd0VsaFZYNUxOcGM',
    'https://drive.google.com/open?id=0B1zCZ0CBPrevN2ljM2M0dTl0UkU',
    'https://drive.google.com/open?id=0B1zCZ0CBPrevYWlrNHlpSTRXTFU',
    'https://drive.google.com/open?id=0B1zCZ0CBPrevcVN4ME5aTkRTYUk',
    'https://drive.google.com/open?id=0B1zCZ0CBPrevS3Y4WW5FWnJXRzA',
    'https://drive.google.com/open?id=0B1zCZ0CBPrevbjlMbENHLUxZZFE',
    'https://drive.google.com/open?id=0B1zCZ0CBPrevS1RHWkY1TUhuaGs',
    'https://drive.google.com/open?id=0B1zCZ0CBPrevMU82NUFTYWJicWs',
    'https://drive.google.com/open?id=0B1zCZ0CBPrevS2N6eVlYWEJWd28',
    'https://drive.google.com/open?id=0B1zCZ0CBPrevRU5qei1qcmF0eDA',
    'https://drive.google.com/open?id=0B1zCZ0CBPrevRTRFX3ZZQmpPMzg',
    'https://drive.google.com/open?id=0B1zCZ0CBPrevamVBMXpCaVNFMWc',
    'https://drive.google.com/open?id=0B1zCZ0CBPrevb0xVdEtDZFozdkE',
    'https://drive.google.com/open?id=0B1zCZ0CBPrevR1doRzlEZFE1Y0k',
    'https://drive.google.com/open?id=0B1zCZ0CBPrevS28yRlRUSGlta0E',
    'https://drive.google.com/open?id=0B1zCZ0CBPrevQ3BvaGlxTWktSVE',
    'https://drive.google.com/open?id=0B1zCZ0CBPrevUExLZV9IVmROSDA'
];
foreach ($variable as $key => $value) {
    $i++;
    $videos[] = (object)["text" => "", "number" => $i, "url" => $value];
}



echo json_encode($videos);
