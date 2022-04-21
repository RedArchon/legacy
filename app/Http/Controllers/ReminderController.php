<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReminderRequest;
use App\Models\Scheduler;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function __invoke(StoreReminderRequest $request)
    {
        $scheduler = Scheduler::create($request->validated());

        return response()->json(['data' => $scheduler], 201);
    }
}
