<?php

namespace helpers;

class CSVHelper
{
    public function generateCSV(array $header, array $data)
    {
        // Set headers for CSV file
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="data.csv"');

        // Open file stream for output
        $output = fopen('php://output', 'w');

        // Write header row to CSV file
        fputcsv($output, $header);

        // Write data to CSV file
        foreach ($data as $row) {
            fputcsv($output, $row);
        }

        // Close file stream
        fclose($output);
    }
}
