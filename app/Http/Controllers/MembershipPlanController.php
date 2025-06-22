<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MembershipPlan;

class MembershipPlanController extends Controller
{
    public function index()
    {
        $plans = MembershipPlan::all();
        // $plans = MembershipPlan::where('status', 'active')->get(); If you want...
        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.plans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:90',
            'price' => 'required|numeric',
            'features' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        MembershipPlan::create($validated);
        return redirect()->route('plans.index')->with('success', 'Plan added successfully!');
    }


    public function edit($id)
    {
        $plan = MembershipPlan::findOrFail($id);
        return view('admin.plans.edit', compact('plan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:90',
            'price' => 'required|numeric',
            'features' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $plan = MembershipPlan::findOrFail($id);
        $plan->update($validated);
        return redirect()->route('plans.index')->with('success', 'Plan updated successfully!');
    }

    public function destroy($id)
    {
        $plan = MembershipPlan::findOrFail($id);
        $plan->delete();
        return redirect()->route('plans.index')->with('success', 'Plan deleted successfully!');
    }
}
