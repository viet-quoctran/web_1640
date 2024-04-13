<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faculties;
class FacultiesController extends Controller
{
    public function storeFaculties(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $faculties = Faculties::create([
            'name' => $validated['name'],
        ]);

        if ($faculties) {
            try {
                return redirect()->route('your.route.here')->with('success', 'User has been successfully added, and the password has been emailed.');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors('The faculties was created');
            }
        } else {
            // Handle if the user couldn't be created
            return redirect()->back()->withErrors('Unable to create new faculties.');
        }
    }
    public function updateFaculties(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $faculties = Faculties::find($id);
        if (!$faculties) {
            return redirect()->back()->withErrors('Faculties not found.');
        }

        $faculties->update([
            'name' => $validated['name'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Faculties has been successfully updated.');
    }
    public function deleteFaculties($id)
    {
        $faculties = Faculties::find($id);
        if (!$faculties) {
            return redirect()->back()->withErrors('Faculties not found.');
        }

        $faculties->delete();

        return redirect()->route('dashboard')->with('success', 'Faculties has been successfully deleted.');
    }

}
