<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestimonialController extends Controller
{
    public function index(){
        $testimonials = (new Testimonial())->getAllTestimonial();
        return view('backend.testimonial.index', compact('testimonials'));
    }

    public function create(Request $request){
        return view('backend.testimonial.create');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $testimonial = (new Testimonial())->storeTestimonial($request);
            DB::commit();
            return redirect()->route('testimonial.index')->with('success', 'Testimonial created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(Testimonial $testimonial)
    {
        return view('backend.testimonial.edit', compact('testimonial'));
    }

    public function show(Testimonial $testimonial)
    {
        return view('backend.testimonial.show', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        try {
            DB::beginTransaction();
            (new Testimonial())->updateTestimonial($request, $testimonial);
            DB::commit();
            return redirect()->route('testimonial.index')->with('success', 'Testimonial updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Testimonial $testimonial)
    {
        try {
            DB::beginTransaction();
            (new Testimonial())->deleteTestimonial($testimonial);
            DB::commit();
            return redirect()->route('testimonial.index')->with('success', 'Testimonial deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}