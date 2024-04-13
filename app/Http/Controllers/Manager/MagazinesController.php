<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Magazines;
class MagazinesController extends Controller
{
    public function storeMagazines(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'faculties_magazines'=> 'required|exists:faculties,id',
        ]);
        $magazines = Magazines::create([
            'name' => $validated['name'],
            'faculties_id'=>$validated['faculties_magazines'],
        ]);
        if ($magazines) {
            try {
                return redirect()->route('dashboard')->with('success', 'User has been successfully added, and the password has been emailed.');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors('The magazines was created');
            }
        } else {
            // Handle if the user couldn't be created
            return redirect()->back()->withErrors('Unable to create new magazines.');
        }
    }
    public function updateMagazines(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'faculties_magazines'=> 'required|exists:faculties,id',
        ]);

        $magazines = Magazines::find($id);
        if (!$magazines) {
            return redirect()->back()->withErrors('Magazines not found.');
        }

        $magazines->update([
            'name' => $validated['name'],
            'faculties_id'=>$validated['faculties_magazines']
        ]);

        return redirect()->route('dashboard')->with('success', 'Magazines has been successfully updated.');
    }
    public function deleteMagazines($id)
    {
        $magazines = Magazines::find($id);
        if (!$magazines) {
            return redirect()->back()->withErrors('Magazines not found.');
        }
        $magazines->delete();
        return redirect()->route('dashboard')->with('success', 'Magazines has been successfully deleted.');
    }
}
