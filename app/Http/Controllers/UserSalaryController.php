<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserSalary;

class UserSalaryController extends Controller
{
    // Create or update user salary details
    public function storeOrUpdate(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string',
            'email'         => 'required|email',
            'salary_local'  => 'required|numeric',
            // salary_euros and commission can be set via admin panel so they are optional here
            'salary_euros'  => 'sometimes|numeric',
            'commission'    => 'sometimes|numeric',
        ]);

        // Use updateOrCreate to check by unique email
        $userSalary = UserSalary::updateOrCreate(
            ['email' => $validated['email']],
            [
                'name'          => $validated['name'],
                'salary_local'  => $validated['salary_local'],
                'salary_euros'  => $validated['salary_euros'] ?? 0,
                'commission'    => $validated['commission'] ?? 500,
            ]
        );

        return response()->json($userSalary);
    }

    // List all user salary records (for Admin panel)
    public function index()
    {
        $records = UserSalary::all();
        return response()->json($records);
    }

    // Admin can update salary details
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'salary_local' => 'sometimes|numeric',
            'salary_euros' => 'sometimes|numeric',
            'commission'   => 'sometimes|numeric',
        ]);

        $userSalary = UserSalary::findOrFail($id);
        $userSalary->update($validated);

        return response()->json($userSalary);
    }
}
