<?php

namespace App\Http\Controllers;

use App\Helpers\{
    ErrorMessagesHelper,
    CSVImporHelper
};
use App\Http\Controllers\Controller;
use App\Http\Requests\Gro\CsvImportRequest;
use App\Repositories\Interfaces\GroupRepositoryInterface;
use Illuminate\Http\{
    RedirectResponse,
    Request
};

class GroController extends Controller
{

    private GroupRepositoryInterface $groupRepository;
    private CSVImporHelper $csvImportHelper;
    public function __construct(GroupRepositoryInterface $groupRepository, CSVImporHelper $csvImportHelper)
    {
        $this->groupRepository = $groupRepository;
        $this->csvImportHelper = $csvImportHelper;
        $this->middleware('checkrole:director', ['only' => ['renderA01', 'csvImportA01']]);
    }

    public function renderA01()
    {
        $groups = $this->groupRepository->getAllGroups();
        return view('pages.Gro.A01', compact('groups'));
    }

    public function csvImportA01(CsvImportRequest $request)
    {
        $desire_header = ['ID', 'Group Name', 'Group Note', 'Group Leader', 'Floor Number', 'Delete'];
        $columnInDatabase = ['id', 'name', 'note', 'group_leader_id', 'group_floor_number', 'deleted_date'];
        $this->csvImportHelper->setData($request->file('csvFile'));
        $this->csvImportHelper->setDesireHeader($desire_header);
        $data = $this->csvImportHelper->importData($columnInDatabase);
        $listUser = $this->groupRepository->getIdGroups();
        $check_validate_data = $this->csvImportHelper->validateData($data, $listUser);
        if ($check_validate_data['errors'] == true) {
            return redirect()->route('render-gro-a01')->with('error_message', $check_validate_data);
        } else {
            $results = $this->groupRepository->importCSV($check_validate_data['results']);
            if ($results == null) {
                \Illuminate\Support\Facades\Session::flash('message', ErrorMessagesHelper::getErrorMessage('EBT092'));
                return redirect()->route('render-gro-a01');
            } else {

            }
        }
    }
}
