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

    public function generateHeader(bool $id, bool $user_id, bool $share_uuid, bool $status, bool $payed_at, bool $total)
    {
        $header = array();
        if ($id === true) {
            $header[] = 'ID';
        }
        if ($user_id === true) {
            $header[] = 'User ID';
        }
        if ($share_uuid === true) {
            $header[] = 'Share UUID';
        }
        if ($status === true) {
            $header[] = 'Status';
        }
        if ($payed_at === true) {
            $header[] = 'Payed at';
        }
        if ($total === true) {
            $header[] = 'Total price';
        }
        return $header;
    }
}
