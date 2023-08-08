<?php
namespace App\Helpers;

use DateTime;

class CommonHelper
{

    public function __construct()
    {

    }
    /**
     * Class longTextToThreeDots
     *
     * Change long text to 3 dots.
     */
    public function longTextToThreeDots($text, $length)
    {
        if (strlen($text) > $length) {
            return substr($text, 0, $length) . "...";
        } else {
            return $text;
        }
    }

    /**
     * Class dateFormatDay
     *
     * Format YYYY/mm/dd to dd/mm/YYYY or YYYY-mm-dd to dd/mm/YYYY
     */
    public function dateFormatDay($date)
    {
        $dateFormat = (new DateTime($date))->format('d/m/Y');
        return $dateFormat;
    }


    /**
     * Class dateFormatYear
     *
     * Format dd/mm/YYYY to YYYY/mm/dd or dd-mm-YYYY to YYYY/mm/dd
     */
    public function dateFormatYear($date)
    {
        if(isset($date)){
            $date = DateTime::createFromFormat('d/m/Y', $date);
            $date = $date->format('Y-m-d');
            return $date;
        }
        return false;
    }


    /**
     * Class changeNameCSV
     *
     * Change file name with extension  from datetime (Y-m-d H:i:s) to (YmdHis) such as xxx_20230711101205.csv
     */
    public function changeNameCSV($name, $exten)
    {
        $pattern = '/[^a-zA-Z0-9]/';
        $timeNow = new DateTime();
        $extension = $exten;
        $fileName = $name;
        $timeNow = $timeNow->format('Y-m-d H:i:s');
        $result = preg_replace($pattern, '', $timeNow);
        $newFileName = $fileName . '_' . $result . '.' . $extension;
        return $newFileName;
    }

    function formatString($inputString) {
        $limit = 50;

        if($inputString <= 20)
        {
            return $inputString;
        }
        if (strlen($inputString) > 20 && strlen($inputString) < $limit) {
            $formattedString = wordwrap($inputString, 25, "<br>", true);
        }
        elseif (strlen($inputString) >= $limit) {
            $formattedString = substr($inputString, 0, 30) . '...';
        }
        else {
            $formattedString = $inputString;
        }

        return $formattedString;
    }
}
?>
