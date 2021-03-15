<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User as UserModel;

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
}
