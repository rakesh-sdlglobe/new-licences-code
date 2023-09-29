<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\TrainingInstitute; // Make sure to import your TrainingInstitute model
use App\Http\Controllers\Controller;
class TrainingInstitutesController extends Controller
{
    public function index()
    {
        // Fetch and return data for the index page
        $trainingInstitutes = TrainingInstitute::all();

        return view('backend.training_institute.index', compact('trainingInstitutes'));
    }
     public function create()
    {
        return view('admin.training_institutes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'website' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        $trainingInstitute = TrainingInstitute::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'website' => $request->website,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'status' => 1,
        ]);

        return redirect()->route('admin.training_institutes.index')->with('success', 'Training institute created successfully.');
    }

    public function show(TrainingInstitute $trainingInstitute)
    {
        return view('admin.training_institutes.show', compact('trainingInstitute'));
    }

    public function edit(TrainingInstitute $trainingInstitute)
    {
        return view('admin.training_institutes.edit', compact('trainingInstitute'));
    }

    public function update(Request $request, TrainingInstitute $trainingInstitute)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'website' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        $trainingInstitute->update([
            'name' => $request->name,
            'website' => $request->website,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.training_institutes.index')->with('success', 'Training institute updated successfully.');
    }

    public function destroy(TrainingInstitute $trainingInstitute)
    {
        $trainingInstitute->delete();

        return redirect()->route('admin.training_institutes.index')->with('success', 'Training institute deleted successfully.');
    }
}
