<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait StatusValidatorTrait
{
    public function LoadStatusStorage()
    {
        $this->storage_json = Storage::disk('local')->get('json/request_overview_status_svg.json');
        $this->storage_json_decode = json_decode($this->storage_json, true);
        return $this->storage_json_decode;
    }

    public function StatusValidator($request_model)
    {

        $granted_arg = $request_model->granted;
        $rejected_arg = $request_model->rejected;

        if ($granted_arg == 0 && $rejected_arg == 0)
            return $this->ValidatePending();

        if ($granted_arg == 1 && $rejected_arg == 0)
            return $this->ValidateGranted();

        if ($granted_arg == 0 && $rejected_arg == 1)
            return $this->ValidateDenied();
    }

    protected function ValidatePending()
    {
        $pending = $this->LoadStatusStorage();
        return $pending['profile_pending'];
    }
    protected function ValidateGranted()
    {
        $granted = $this->LoadStatusStorage();
        return $granted['profile_granted'];
    }
    protected function ValidateDenied()
    {
        $denied = $this->LoadStatusStorage();
        return $denied['profile_denied'];
    }
}
