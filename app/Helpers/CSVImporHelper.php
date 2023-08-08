<?php

namespace App\Helpers;

use App\Rules\NullableIfExistRule;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ErrorMessage;
use App\Models\User;

/**
 * Class CSVExporter
 *
 * A library for exporting data to CSV format.
 */
class CSVImporHelper
{
    protected $data;

    protected $desireHeader;

    /**
     * CSVExporter constructor.
     *
     */
    public function __construct()
    {

    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setDesireHeader(array $desireHeader)
    {
        $this->desireHeader = $desireHeader;
    }

    public function getDesireHeader()
    {
        return $this->desireHeader;
    }
    // /**
//      * Export the data to a CSV file and return it as a response.
//      *
//      * @return \Symfony\Component\HttpFoundation\StreamedResponse The streamed response containing the CSV file.
//      */
    public function importData($columnInDatabase)
    {
        // Get all row in file csv
        $csvData = file($this->getData());
        // Get header from csvData
        $header = array_shift($csvData);
        $data = [];
        // split special charactor in header
        $header = rtrim($header, "\n\r");
        $header = explode(",", $header);
        $IDs = [];
        // Compare header
        $result = (array_diff_assoc($this->desireHeader, $header) === []) && (array_diff_assoc($header, $this->desireHeader) === []);
        if ($result) {
            foreach ($csvData as $item) {
                $values = explode(',', $item);
                $firstNumber = reset($values);
                $IDs[] = $firstNumber;
            }

            foreach ($csvData as $row) {
                $row = rtrim($row, "\n");
                $data[] = str_getcsv($row);
            }

            $modifiedArray = [];
            foreach ($data as $index => $subArray) {
                $modifiedSubArray = array_combine($columnInDatabase, $subArray);
                $modifiedArray[$index] = $modifiedSubArray;
            }

            foreach ($modifiedArray as $item) {
                $item['id'] = intval($item['id']);
                $item['group_leader_id'] = intval($item['group_leader_id']);
                $item['group_floor_number'] = intval($item['group_floor_number']);
            }

            if ($modifiedArray == []) {
                return false;
            } else {
                // This is data with type of array
                return ['ids' => $IDs, 'results' => $modifiedArray];
            }

        } else {
            return false;
        }
    }

    public function validateData($datas, $listUser)
    {
        $countLine = 1;
        $countError = 0;
        $error_array = [];
        $errors = [];
        $listUserConvert = [];

        foreach ($listUser as $list) {
            $string = (string) $list;
            $listUserConvert[] = $string;
        }

        $rules = [
            'id' => 'required_if:deleted_date,Y|numeric|in:' . implode(',', array_values($listUserConvert)),
            'name' => [
                'required',
                function ($attribute, $value, $fail) {
                    $length = strlen($value);
                    if ($length > 255) {
                        $fail(str_replace([':max', ':length'], [255, $length], ErrorMessagesHelper::getErrorMessage('EBT002', 'Group Name', ':max', ':length')));
                    }
                }
            ],
            'group_leader_id' => ['required', 'numeric'],
            'group_floor_number' => ['required', 'numeric'],
        ];

        // If ID or Delete exist
        $rules2 = [
            'id' => 'required_if:deleted_date,Y|numeric|in:' . implode(',', array_values($listUserConvert)),
            'name' => [
                function ($attribute, $value, $fail) {
                    $length = strlen($value);
                    if ($length > 255) {
                        $fail(str_replace([':max', ':length'], [255, $length], ErrorMessagesHelper::getErrorMessage('EBT002', 'Group Name', ':max', ':length')));
                    }
                }
            ],
            'group_leader_id' => ['numeric'],
            'group_floor_number' => ['numeric'],
        ];

        $customMessages = [
            'id.numeric' => ErrorMessagesHelper::getErrorMessage('EBT010', 'ID'),
            'id.required_if' => ErrorMessagesHelper::getErrorMessage('EBT095'),
            'id.in' => ErrorMessagesHelper::getErrorMessage('EBT094', 'ID'),
            'name.required' => ErrorMessagesHelper::getErrorMessage('EBT001', 'Group Name'),
            'group_leader_id.required' => ErrorMessagesHelper::getErrorMessage('EBT001', 'Group Leader'),
            'group_leader_id.numeric' => ErrorMessagesHelper::getErrorMessage('EBT010', 'Group Leader'),
            'group_floor_number.required' => ErrorMessagesHelper::getErrorMessage('EBT001', 'Floor Number'),
            'group_floor_number.numeric' => ErrorMessagesHelper::getErrorMessage('EBT010', 'Floor Number'),
        ];
        if ($datas != false) {
            foreach ($datas['results'] as $data) {
                if ($data['id'] != "" && $data['deleted_date'] === "Y") {
                    $validator = Validator::make($data, $rules2, $customMessages);
                    $errors = "";
                    if ($validator->fails()) {
                        $errors = $validator->errors()->all();
                        foreach ($errors as $error) {
                            $error_array[] = 'Dòng ' . $countLine . ': ' . $error;
                        }

                        $countError++;
                    }

                    $countLine = $countLine + 1;
                } else {
                    $validator = Validator::make($data, $rules, $customMessages);
                    $errors = "";
                    if ($validator->fails()) {
                        $errors = $validator->errors()->all();
                        foreach ($errors as $error) {
                            $error_array[] = 'Dòng ' . $countLine . ': ' . $error;
                        }

                        $countError++;
                    }

                    $countLine = $countLine + 1;
                }
            }

            if ($countError > 0) {
                return ['errors' => true, 'results' => $error_array];
            } else {
                return ['errors' => false, 'results' => $datas['results']];
            }
        } else {
            return ['errors' => true, 'results' => [ErrorMessagesHelper::getErrorMessage('EBT095')]];
        }
    }

}
