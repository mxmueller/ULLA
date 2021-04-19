<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait StatusValidatorTrait
{
    public function loadStatusStorage()
    {
        $this->storage_json = Storage::disk('local')->get('json/request_overview_status_svg.json');
        $this->storage_json_decode = json_decode($this->storage_json, true);
        return $this->storage_json_decode;
    }

    public function statusValidator($request_model)
    {

        $granted_arg = $request_model->granted;
        $rejected_arg = $request_model->rejected;

        if ($granted_arg == 0 && $rejected_arg == 0)
            return $this->validatePending();

        if ($granted_arg == 1 && $rejected_arg == 0)
            return $this->validateGranted();

        if ($granted_arg == 0 && $rejected_arg == 1)
            return $this->validateDenied();
    }

    protected function validatePending()
    {
        $pending = $this->loadStatusStorage();
        return $pending['profile_pending'];
    }
    protected function validateGranted()
    {
        $granted = $this->loadStatusStorage();
        return $granted['profile_granted'];
    }
    protected function validateDenied()
    {
        $denied = $this->loadStatusStorage();
        return $denied['profile_denied'];
    }
}
