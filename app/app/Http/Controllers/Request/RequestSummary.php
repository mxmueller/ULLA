<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Traits\StatusValidatorTrait;
use App\Traits\ResolveTimestampTrait;

use App\Models\User as UserModel;
use App\Models\Request as RequestModel;
use App\Models\Human_resource as HumanResourceModel;
use App\Models\Request_type as RequestTypeModel;
use App\Models\User_stand_in as UserStandInModel;

class RequestSummary extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userCollection = $this->loadSelectionOfPossibleUsers();
        return view('request.summary', compact('userCollection'));
    }

    private function loadSelectionOfPossibleUsers()
    {
        $this->possibleUserCollection = collect();
        $this->possibleUserModel = UserModel::all();

        foreach ($this->possibleUserModel as $possibleUserEntry) {
            $this->possibleUserCollection->push([
                'name' => $possibleUserEntry->name, 'id' => $possibleUserEntry->id
            ]);
        }
        return $this->possibleUserCollection;
    }

    public function segmented($sq)
    {
        $this->searchQuery = $sq;
        $this->resolveSearchQuery($this->searchQuery);
        $this->fetchSegmentedData();

        $segmented = $this->segmentResultCollection;

        return view('request.segmented', compact('segmented'));
    }

    private function resolveSearchQuery($sq) // sq = search query
    {
        list($order, $quantum, $employees, $status) = explode(":", hex2bin($sq));
        $this->order = $order;
        $this->quantum = $quantum;
        $this->employees = $employees;
        $this->status = $status;
    }

    private function fetchSegmentedData()
    {
        $this->employeeFilterCollection = collect();
        $this->statusFilterCollection = collect();
        $this->segmentedCollection = collect();

        $this->requestModel = $this->filterOrder();

        foreach ($this->requestModel as $filterEmployees) {
            if ($this->filterEmployees($filterEmployees)) {
                $this->employeeFilterCollection->push($filterEmployees);
            };
        }

        foreach ($this->employeeFilterCollection as $filterStatus) {
            if ($this->filterStatus($filterStatus)) {
                $this->statusFilterCollection->push($filterStatus);
            }
        };

        $this->segmentedCollection = $this->filterCut($this->statusFilterCollection);

        $this->segmentedResultBuilder($this->segmentedCollection);
    }

    private function filterCut($collection)
    {
        if ($this->quantum == 'all') {
            return $collection;
        } else {
            $slicedArray = array_slice($collection->toArray(), 0, intval($this->quantum), true);
            return collect($slicedArray);
        }
    }

    private function filterOrder()
    {
        switch ($this->order) {
            case 'desc':
                return RequestModel::orderBy('id', 'desc')->get();
                break;

            default:
                return RequestModel::orderBy('id', 'asc')->get();
                break;
        }
    }

    private function filterStatus($request)
    {
        switch ($this->status) {
            case 'any':
                return $request;
                break;

            case 'rejected':
                if ($request->rejected) {
                    return true;
                } else {
                    return false;
                }
                break;

            case 'granted':
                if ($request->granted) {
                    return true;
                } else {
                    return false;
                }
                break;
        }
    }

    private function filterEmployees($request)
    {
        if ($this->employees != 'none') {
            if ($request->human_resource->creator === intval($this->employees)) {
                return true;
            }
            return false;
        } else {
            return true;
        }
    }

    use StatusValidatorTrait;
    use ResolveTimestampTrait;

    public function segmentedResultBuilder($collection)
    {
        $this->segmentResultCollection = collect();

        foreach ($collection as $request) {

            $creatorId = HumanResourceModel::find($request['id'])->creator;
            $creatorName = UserModel::find($creatorId)->name;

            $executiveId = HumanResourceModel::find($request['id'])->executive;
            $executiveName = UserModel::find($executiveId)->name;

            $this->segmentResultCollection->push([
                'id' => $request['id'],
                'creator' => $creatorName,
                'executive' => $executiveName,
                'status' => $this->statusValidator(RequestModel::find($request['id'])),
                'created' => RequestModel::find($request['id'])->created_at->format('d.m.Y')
            ]);
        }

        $this->segmentResultArray = array(
            'sq' => $this->segmentResultCollection->toArray(),
            'entrys' => count($collection)
        );

        $this->segmentResultCollection = collect($this->segmentResultArray);
    }
}
