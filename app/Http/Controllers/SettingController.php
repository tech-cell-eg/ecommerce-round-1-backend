<?php

namespace App\Http\Controllers;

use App\Http\Requests\Setting\SettingStoreRequest;
use App\Http\Requests\Setting\SettingUpdateRequest;
use App\Models\Setting;
// use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return response()->json(Setting::all());
    }

    public function store(SettingStoreRequest $request)
    {
        $validated = $request->validated();

        $settingsData = Setting::create($validated);

        return response()->json($settingsData);
    }

    public function show($key)
    {
        $setting = $this->checkKey($key);

        return response()->json($setting);
    }

    public function update(SettingUpdateRequest $request, $key)
    {
        $validated = $request->validated();
        $setting = $this->checkKey($key);
        if(!$setting)
            return response()->json(['message' => 'This key is not found!']);
    
            $setting->update($validated);
        return response()->json($setting);
    }

    public function destroy($key): mixed
    {
        $setting = $this->checkKey($key);
        if(!$setting)
            return response()->json(['message' => 'This key is not found!']);
        
        $setting->delete();
        return response()->json(['message' => 'This key is Deleted successfully']);
    }

    public function checkKey($key)
    {
        $setting = Setting::where('key', $key)->first();
        return $setting;
    }
}
