<?php

require __DIR__ . '/../vendor/autoload.php';

use Rober\ImportFromExportify\Service\ExportifyImporter;

$importer = new ExportifyImporter();

$csvFile = __DIR__ . '/data/exportify_export.csv';

try {
    $songs = $importer->import_exportify($csvFile);
    print_r($songs);
} catch (Exception $e) {
    echo 'Fehler: ' . $e->getMessage();
}



//  [1] => Array
//         (
//             [track_name] => LUNCH
//             [artist_name] => Billie Eilish
//             [album_name] => HIT ME HARD AND SOFT
//             [release_date] => 2024-05-17
//         )

//     [2] => Array
//         (
//             [track_name] => CHIHIRO
//             [artist_name] => Billie Eilish
//             [album_name] => HIT ME HARD AND SOFT
//             [release_date] => 2024-05-17
//         )