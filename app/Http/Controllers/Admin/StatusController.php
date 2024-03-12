<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UserActivityLogger;
use App\Http\Controllers\User\Controller;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = Status::where('is_deleted', 0)->get();
        return view('admin.statuses.statuses', ['statuses'=>$statuses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.statuses.newStatus');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'status' => 'required|min:3'
            ]);

            $status = new Status();
            $status->status = $request->input('status');
            $status->save();
            UserActivityLogger::logActivity(__METHOD__, __CLASS__, "Add new status");
            return redirect()->back()->with('success', 'You have successfully added new status');
        } catch (Exception $e){
            Log::error($e);
            return redirect()->back()->with('error', 'something is wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $status = Status::find($id);
        return view('admin.statuses.editStatus', ['status'=> $status]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'status'=>'required|min:3'
            ]);
            $status = Status::find($id);
            $status->status = $request->input('status');
            $status->save();
            UserActivityLogger::logActivity(__METHOD__, __CLASS__, "Updated status");
            return redirect()->back()->with('success', "Updated successfully");

        }catch (Exception $e){
            Log::error($e);
            return redirect()->back()->with('error', 'something is wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $status = Status::find($id);
            $status->is_deleted = 1;
            $status->save();
            UserActivityLogger::logActivity(__METHOD__, __CLASS__, "Deleted status");

            return redirect()->back()->with('success', 'You have successfully deleted status');

        } catch (Exception $e){
            Log::error($e);
            return redirect()->back()->with('error', 'something is wrong');

        }
    }
}
