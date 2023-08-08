<?php

namespace App\Helpers;
use App\Console\Commands\ScheduleExport;
use App\Enums\UserRoleEnum;
use DateTime;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

/**
 * Class CSVExporter
 *
 * A library for exporting data to CSV format.
 */
class CSVExportHelper
{
    protected $header;
    protected $data;
    protected $fileName;
    protected $DIRECTOR = UserRoleEnum::DIRECTOR->value;
    protected $LEADER = UserRoleEnum::LEADER->value;
    protected $GROUP_LEADER = UserRoleEnum::GROUP_LEADER->value;
    protected $MEMBER = UserRoleEnum::MEMBER->value;

    /**
     * CSVExporter constructor.
     *
     */
    public function __construct(array $header, string $fileName, object $data)
    {
        $this->header = $header;
        $this->data = $data;
        $this->fileName = $fileName;
    }

// /**
//      * Export the data to a CSV file and return it as a response.
//      *
//      * @return \Symfony\Component\HttpFoundation\StreamedResponse The streamed response containing the CSV file.
//      */
    public function export()
    {
        $csvData = implode(',', $this->header) . "\n";
        $users = collect($this->data)->map(function ($users) {
            return (array) $users;
        })->toArray();

        foreach ($users as $user) {
            // Get array in object
            $user = $user["\x00*\x00attributes"];
            $user['started_date'] = (new DateTime( $user['started_date']))->format('d/m/Y');
            $user['created_date'] = (new DateTime( $user['created_date']))->format('d/m/Y');
            $user['updated_date'] = (new DateTime( $user['updated_date']))->format('d/m/Y');

            $position = [UserRoleEnum::DIRECTOR->value, UserRoleEnum::GROUP_LEADER->value, UserRoleEnum::LEADER->value, UserRoleEnum::MEMBER->value];
            if(in_array($user['position_id'], $position) == false)
            {
                $user['position_id'] = "";
            }
            if($user['position_id'] == $this->DIRECTOR)
            {
                $user['position_id'] = "Director";
            }
            else if ($user['position_id'] == $this->GROUP_LEADER) {
                $user['position_id'] = "Group Leader";
            }
            else if ($user['position_id'] == $this->LEADER) {
                $user['position_id'] = "Leader";
            }
            else if($user['position_id'] == $this->MEMBER) {
                $user['position_id'] = "Member";
            }
            // Loop in list array
            $result = array_map(function ($user) {
                return '"' . addslashes($user) . '"';
            }, $user);
            $csvData .= implode(',', $result) . "\n";
        };

        $filename = $this->fileName;
        // Save file
        Storage::disk('local')->put($filename, $csvData);
        $filePath = Storage::path($filename);
        // Download file
        return Response::download($filePath, $filename)->deleteFileAfterSend();
    }

    /**
     * scheduleExport function
     *
     * Automatic export when have schedule
     */
    public function scheduleExport()
    {
        $csvData = implode(',', $this->header) . "\n";
        $users = collect($this->data)->map(function ($users) {
            return (array) $users;
        })->toArray();

        foreach ($users as $user) {
            $user = $user["\x00*\x00attributes"];
            $result = array_map(function ($user) {
                return '"' . addslashes($user) . '"';
            }, $user);
            $csvData .= implode(',', $result) . "\n";
        };
        return $csvData;
    }
}
