<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'image' => Storage::url($this->image),
            'video' => Storage::url($this->video),
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'user' => $this->user,
            'text' => $this->text,
        ];
    }
}
