<?php

namespace App\Http\Controllers;

use App\Models\Greeting;

class TestController extends Controller
{
  public function __invoke()
  {
      return Greeting::query()->first()->name;
  }
}
