<?php

namespace App\Http\Controllers\Request;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Request as RequestModel;
use App\Models\Request_type as RequestTypeModel;
use App\Models\Human_resource as HumanResourceModel;
use App\Models\User_stand_in as UserStandInModel;
use App\Models\User as UserModel;

use App\Traits\StatusValidatorTrait;
use App\Traits\ResolveTimestampTrait;

class RequestAssigned extends Controller
{
    use StatusValidatorTrait;
    use ResolveTimestampTrait;

    public function __construct()
    {
        $this->middleware('auth');
        $this->errorPermissionResponse = '403 - Missing authorization';
        $this->errorNotFoundResponse = '404 - Not found';
        $this->errorNothingAssigned = 'Sorry, there are no requests assigned to you at the moment.';
    }

    public function index()
    {
        $this->assignedCollection = collect();
        $this->assignedError = false;
        $this->assignedErrorMessage = null;
        $this->loggedInUser = Auth::user()->id;

        $this->buildAssignedRequest($this->loggedInUser);

        $assigned = $this->assignedCollection;

        return view('request.assigned', compact('assigned'));
    }

    private function browseThroughRequests($loggedInUser)
    {
        $this->humaneResourcesAll = HumanResourceModel::all();
        $this->areThereExistingEntries = false;

        foreach ($this->humaneResourcesAll as $humaneResourcesEntry) {
            if ($humaneResourcesEntry->executive == $loggedInUser) {;
                $this->areThereExistingEntries = true;
            }
        }
        if (!$this->areThereExistingEntries) {
            $this->assignedError = true;
            $this->assignedErrorMessage = $this->errorNothingAssigned;
        }
        return true;
    }

    private function pendingRequestStatus($request)
    {
        if ($request->granted === 0 && $request->rejected === 0)
            return true;
        return false;
    }

    private function buildAssignedRequest($loggedInUser)
    {
        $this->browseThroughRequests($loggedInUser);

        if ($this->assignedError) {
            $this->assignedCollection->push([
                'assignedError' => $this->assignedError,
                'assignedErrorMessage' => $this->assignedErrorMessage
            ]);

            $assignedCollectionArray = $this->assignedCollection->toArray();
            $assignedCollectionArray = $assignedCollectionArray[0];
        } else {
            $this->assignedCollection->push([
                'assignedError' => $this->assignedError,
                'assignedErrorMessage' => $this->assignedErrorMessage,
                'assigned' => []
            ]);

            $assignedEntryCollection = collect(); // temporary

            foreach ($this->humaneResourcesAll as $humaneResourcesEntry) {
                if ($humaneResourcesEntry->executive == $loggedInUser) {;

                    $request = $humaneResourcesEntry->request;

                    $assignedEntryCollection->push([
                        'status' => $this->statusValidator($request),
                        'timestamps' => [
                            'start' =>
                            $this->epochConverter($request->period->start_tstmp),
                            'end' =>
                            $this->epochConverter($request->period->end_tstmp)
                        ],
                        'arguments' => [
                            'halfday' => $request->period->half_day,
                            'id' => $request->id,
                            'pending' => $this->pendingRequestStatus($request)
                        ],
                        'creator' => UserModel::find($humaneResourcesEntry->creator)->name
                    ]);
                }
            }
            $assignedCollectionArray = $this->assignedCollection->toArray();
            $assignedEntryCollectionArray = $assignedEntryCollection->toArray();
            $assignedCollectionArray[0]['assigned'] = $assignedEntryCollectionArray;
            $assignedCollectionArray = $assignedCollectionArray[0];
        }
        return $this->assignedCollection = collect($assignedCollectionArray);
    }
}
