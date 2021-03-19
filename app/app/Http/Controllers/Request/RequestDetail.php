<?php

namespace App\Http\Controllers\Request;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Traits\StatusValidatorTrait;
use App\Traits\ResolveTimestampTrait;

use App\Models\Request as RequestModel;
use App\Models\Request_type as RequestTypeModel;
use App\Models\User_stand_in as UserStandInModel;
use App\Models\User as UserModel;


class RequestDetail extends Controller
{
    use StatusValidatorTrait;
    use ResolveTimestampTrait;

    public function __construct()
    {
        $this->middleware('auth');
        $this->errorPermissionResponse = '403 - Missing authorization';
        $this->errorNotFoundResponse = '404 - Not found';
    }

    public function index($id) // Contains Request id
    {
        $this->responseMessage = '';
        $this->responseCollection = collect();
        $this->responseError = false;

        // validates existence and permission
        $this->doorman($id);

        // main 
        $this->buildDetailRequest($id);

        $details = $this->responseCollection;
        return view('request.detail', compact('details'));
    }

    public function descision($id)
    {
        $this->responseMessage = '';
        $this->responseCollection = collect();
        $this->responseError = false;

        // validates existence and permission
        $this->doorman($id);

        // main 
        $this->buildDetailRequest($id);

        return $this->responseCollection;
    }

    public function doorman($id)
    {
        // check if request exist
        if ($this->existenceConfirmation($id) == false) {
            $this->responseMessage = $this->errorNotFoundResponse;
            $this->responseError = true;
            return false;
        }
        // check if user owns request
        if ($this->permissionConfirmation($id) == false && $this->executiveInRequest($id) == false) {
            $this->responseMessage = $this->errorPermissionResponse;
            $this->responseError = true;
            return false;
        }
    }

    public function existenceConfirmation($id)
    {
        if (RequestModel::find($id) != null)
            return true;
        return false;
    }

    public function permissionConfirmation($id)
    {
        if (RequestModel::find($id)->human_resource->creator == Auth::user()->id)
            return true;
        return false;
    }

    public function executiveInRequest($id)
    {
        $assignedExecutive = RequestModel::find($id)->human_resource->executive;

        if ($assignedExecutive == Auth::user()->id)
            return true;
        return false;
    }

    public function buildDetailRequest($id)
    {
        // get query
        $this->detailQuery($id);

        if ($this->responseError) {
            $this->responseCollection->push([
                'responseError' => $this->responseError,
                'responseErrorMessage' => $this->responseMessage
            ]);
        } else {
            $this->responseCollection->push([
                'responseError' => $this->responseError,
                'responseErrorMessage' => $this->responseMessage,
                'request' => [
                    'id' => $this->request->id,
                    'type' => $this->request->request_type->description,
                    'halfday' => $this->request->period->half_day,
                    'sum' => $this->request->period->sum,
                    'timestamps' => [
                        'start' =>
                        $this->epochConverter(
                            $this->request->period->start_tstmp
                        ),
                        'end' =>
                        $this->epochConverter(
                            $this->request->period->end_tstmp
                        )
                    ],
                    'assigned' => $this->resolveUsersFullName(
                        $this->request->human_resource->executive
                    ),
                    'creator' => $this->resolveUsersFullName(
                        $this->request->human_resource->creator
                    ),
                    'stand_ins' => [$this->standInConstructor($this->request)],
                    'comments' => [
                        'initial' => $this->requestComment($this->request),
                        'granted' => $this->grantedComment($this->request),
                        'rejected' => $this->rejectedComment($this->request)
                    ]

                ],
                'status' => $this->statusValidator($this->request),
            ]);
        }
        return $this->responseCollection->toArray();
    }

    public function detailQuery($id)
    {
        $this->request = RequestModel::find($id);
        // ...
    }

    public function requestComment($request)
    {
        if ($request->request_comment != null) {
            $comment = collect(
                ['available' => true, 'comment' => $request->request_comment->comment]
            );
        } else {
            $comment = collect(
                ['available' => false, 'comment' => null]
            );
        }
        return $comment->toArray();
    }

    public function rejectedComment($request)
    {
        if ($request->rejected_comment != null) {
            $comment = collect(
                ['available' => true, 'comment' => $request->rejected_comment->comment]
            );
        } else {
            $comment = collect(
                ['available' => false, 'comment' => null]
            );
        }
        return $comment->toArray();
    }

    public function grantedComment($request)
    {
        if ($request->granted_comment != null) {
            $comment = collect(
                ['available' => true, 'comment' => $request->granted_comment->comment]
            );
        } else {
            $comment = collect(
                ['available' => false, 'comment' => null]
            );
        }
        return $comment->toArray();
    }

    public function standInConstructor($request)
    {
        $this->standInUserCollection = collect();
        $this->standInUserDatabaseCollection = UserStandInModel::where('request_stand_in_id', $request->id)->get();

        $this->standInUserDatabaseCollection->each(function ($entry, $_) {
            $this->standInUserCollection->push([
                'user_id' => $entry->stand_in_users->id,
                'user_name' => $entry->stand_in_users->name,
                'timestamps' => [
                    'overhanding' =>
                    $this->epochConverter(
                        $entry->over_handing_tstmp
                    )
                ]
            ]);
        });

        return $this->standInUserCollection->toArray();
    }

    public function resolveUsersFullName($userId)
    {
        return UserModel::find($userId)->name;
    }
}
