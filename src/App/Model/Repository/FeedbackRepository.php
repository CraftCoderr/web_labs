<?php


namespace App\Model\Repository;


use Core\Files;

class FeedbackRepository
{

    private static $FILE_NAME = 'messages.inc';
    private static $CSV_DELIMITER = ';';
    private static $DATE_FORMAT = 'd.m.y';

    public function getAllSortedByDate()
    {
        $data = [];
        if (!file_exists(Files::file(self::$FILE_NAME))) {
            return $data;
        }
        if (($handle = fopen(Files::file(self::$FILE_NAME), "r")) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, self::$CSV_DELIMITER)) !== FALSE) {
                if (count($row) == 4) {
                    $data[] = [
                        'name' => $row[0],
                        'email' => $row[1],
                        'text' => $row[2],
                        'date' => $row[3]
                    ];
                }
            }
            fclose($handle);
        }
        usort($data, function ($a, $b) {
           return
               \DateTime::createFromFormat(self::$DATE_FORMAT, $a['date'])->getTimestamp()
               - \DateTime::createFromFormat(self::$DATE_FORMAT, $b['date'])->getTimestamp();
        });
        return $data;
    }

    public function addFeedback($feedback)
    {
        if (($handle = fopen(Files::file(self::$FILE_NAME), 'a')) !== FALSE) {
            $feedback['date'] = $feedback['date']->format(self::$DATE_FORMAT);
            fputcsv($handle, $feedback, self::$CSV_DELIMITER);
        }
    }

    public function replaceFile($tmpFile)
    {
        return move_uploaded_file($tmpFile, Files::file(self::$FILE_NAME));
    }

}