<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\UserStatus;

class StatusController extends Controller
{
    public function getStatuses() {
        $statuses = UserStatus::all();

        return response()->json([
            'statuses' => $statuses
        ]);
    }

    public function addStatus(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $status = UserStatus::create($request->all());

        return response()->json([
            'message' => 'Status added successfully',
            'status' => $status
        ]);
    }

    public function editStatus(Request $request, $id) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $status = UserStatus::find($id);

        if(!$status) {
            return response()->json([
                'message' => 'Status not found'
            ], 404);
        }

        $status->update($request->all());

        return response()->json([
            'message' => 'Status updated successfully',
            'status' => $status
        ]);
    }

    public function deleteStatus($id) {
        $status = UserStatus::find($id);

        if(!$status) {
            return response()->json([
                'message' => 'Status not found'
            ], 404);
        }    

        $status->delete();

        return response()->json([
            'message' => 'Status deleted successfully'
        ]);
    }
}
