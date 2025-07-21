<?php

namespace Rober\ImportFromExportify\Service;

class ExportifyImporter
{
    public function import_exportify(string $csvFile): array
    {
        if (!file_exists($csvFile)) {
            throw new \InvalidArgumentException("File not found: $csvFile");
        }

        $songs = [];

        if (($handle = fopen($csvFile, 'r')) !== false) {
            $header = fgetcsv($handle);

            // Prüfe auf nötige Spalten
            $trackNameIndex = array_search('Track-Name', $header);
            $artistNameIndex = array_search('Künstlername(n)', $header);
            $albumNameIndex = array_search('Album-Name', $header);
            $releaseDateIndex = array_search('Veröffentlichungsdatum des Albums', $header);

            if ($trackNameIndex === false || $artistNameIndex === false) {
                throw new \RuntimeException("Needed attributes are missing in the export file. Check your CSV columns.");
            }

            while (($row = fgetcsv($handle)) !== false) {
                $songs[] = [
                    'track_name' => $row[$trackNameIndex],
                    'artist_name' => $row[$artistNameIndex],
                    'album_name' => $albumNameIndex !== false ? $row[$albumNameIndex] : null,
                    'release_date' => $releaseDateIndex !== false ? $row[$releaseDateIndex] : null,
                ];
            }

            fclose($handle);
        }

        return $songs;
    }
}
