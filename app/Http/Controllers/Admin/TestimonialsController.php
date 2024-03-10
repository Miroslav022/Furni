<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\UserActivityLogger;
use App\Http\Controllers\User\Controller;
use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestimonialsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $testimonials = Testimonial::paginate(5);
        return view('admin/testimonials/testimonials', ['testimonials'=>$testimonials]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.testimonials.newTestimonial');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $testimonial = new Testimonial();
            $testimonial->name = $request->input('name');
            $testimonial->function = $request->input('position');
            $testimonial->testimonial = $request->input('testimonial');
            $testimonial->save();
            UserActivityLogger::logActivity(__METHOD__, __CLASS__, "Added new testimonial");

            return redirect()->back()->with('success', 'You have successfully added new testimonial');

        }catch (\Exception $e){
            Log::error($e);
            return redirect()->back()->with('error', 'Something is wrong');
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
        $testimonial = Testimonial::find($id);
        return view("admin.testimonials.editTestimonial", ['testimonial'=>$testimonial]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $testimonial = Testimonial::find($id);
            $testimonial->name = $request->input('name');
            $testimonial->function = $request->input('position');
            $testimonial->testimonial = $request->input('testimonial');
            UserActivityLogger::logActivity(__METHOD__, __CLASS__, "Updated testimonial");

            $testimonial->save();
            return redirect()->back()->with('success', 'You have successfully updated testimonial');
        }catch (\Exception $e){
            Log::error($e);
            return redirect()->back()->with('error', 'Something is wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $testimonial = Testimonial::find($id);
            $testimonial->delete();
            UserActivityLogger::logActivity(__METHOD__, __CLASS__, "Deleted testimonial");

            return redirect()->back()->with("success", "Deleted successfully");
        }catch (\Exception $e){
            Log::error($e);
            return redirect()->back()->with('error', 'Something is wrong');
        }
    }
}
