<?php

namespace App\Http\Controllers;

use App\Http\Requests\Setting\SettingStoreRequest;
use App\Http\Requests\Setting\SettingUpdateRequest;
use App\Models\Setting;
use App\Traits\ApiResponse;

// use Illuminate\Http\Request;

class SettingController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return $this->success(200, "settings retrived successfully!" , Setting::all());
    }

    public function store(SettingStoreRequest $request)
    {
        $validated = $request->validated();

        $settingsData = Setting::create($validated);

        return $this->success(200, "settings created successfully!" , $settingsData);

    }

    public function show($key)
    {
        $setting = $this->checkKey($key);
        return $this->success(200, "settings returned successfully!" , $setting);
    }

    public function update(SettingUpdateRequest $request, $key)
    {
        $validated = $request->validated();
        $setting = $this->checkKey($key);
        if (!$setting)
            return $this->failed(404, "This key is not found!");


        $setting->update($validated);
        return $this->success(200, "settings updated successfully!", $setting);

    }

    public function destroy($key): mixed
    {
        $setting = $this->checkKey($key);
        if (!$setting)
            return $this->failed(404, "This key is not found!");

        $setting->delete();
        return $this->success(200, "This key is Deleted successfully");

    }

    public function checkKey($key)
    {
        $setting = Setting::where('key', $key)->first();
        return $setting;
    }

}



