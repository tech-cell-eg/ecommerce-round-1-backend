<?php

namespace App\Http\Controllers\API\OurStory;

use App\Http\Controllers\Controller;
use App\Models\OurStory;
use App\Traits\ApiResponse;

class OurStoryController extends Controller
{
  use ApiResponse;

  function index()
  {
    $stories = OurStory::all();
    return $this->success(200, "all our stories :)", $stories);
  }

  public function show(OurStory $ourStory)
  {
    return $this->success(200, "Story returned successfully :)", $ourStory);
  }
}
