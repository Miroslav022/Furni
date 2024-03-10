<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UserActivityLogger;
use App\Http\Controllers\User\Controller;
use App\Models\Specification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class SpecificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specifications = Specification::where('is_deleted', 0)->paginate(5);
        return view("admin.specifications.specifications", ['specifications'=>$specifications]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.specifications.newSpecification");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $newSpecification = new Specification();
            $newSpecification->specification= $request->input('specification');
            $newSpecification->save();
            UserActivityLogger::logActivity(__METHOD__, __CLASS__, "Added new specification");

            return redirect()->back()->with('success', 'You have successfully added new specification');
        }catch (Exception){
            Log::error($e);
            return redirect()->back()->with('error', 'Something is wrong.');
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
        $specification = Specification::find($id);
        return view("admin.specifications.editSpecification",['specification'=>$specification]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $specificationToEdit = Specification::find($id);
            $specificationToEdit->specification = $request->input('specification');
            $specificationToEdit->save();
            UserActivityLogger::logActivity(__METHOD__, __CLASS__, "Updated specification");

            return redirect()->back()->with('success', "Updated successfully");
        } catch (Exception $e){
            Log::error($e);
            return redirect()->back()->with('error', "Something is wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $specification = Specification::find($id);
            $specification->is_deleted = 1;
            $specification->save();
            UserActivityLogger::logActivity(__METHOD__, __CLASS__, "Deleted specification");

            return redirect()->back()->with('success', 'You have successfully deleted specification');
        }catch (\Exception $e){
            Log::error($e);
        }
    }
}
