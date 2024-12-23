<?php

namespace Tests\Feature;

use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SettingTest extends TestCase
{
    use RefreshDatabase;

    public function store_new_setting_key()
    {
        $data = [
            'key' => 'setting1',
            'value' => 'value1',
        ];

        $response = $this->postJson('/api/setting', $data);

        $response->assertStatus(200);
    }

    public function show_specific_key()
    {
        $setting = Setting::create([
            'key' => 'key1',
            'value' => 'value1'
        ]);

        $response = $this->getJson('/api/setting/{$setting->key}');

        $response->assertStatus(200);
    }

    public function update_setting_key()
    {
        $setting = Setting::create([
            'key' => 'key1',
            'value' => 'value1'
        ]);

        $updatedSetting = [
            'value' => 'newValue',
        ];

        $response = $this->putJson('/api/setting/{$setting->key}', $updatedSetting);

        $response->assertStatus(200);
    }

    public function delete_setting_key()
    {
        $setting = Setting::create([
            'key' => 'key1',
            'value' => 'value1'
        ]);

        $response = $this->deleteJson("/api/setting/{$setting->key}");

        $response->assertStatus(200);
    }

}