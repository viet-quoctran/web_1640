<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contribution;
use App\Models\Word;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContributionSubmittedMail;
use App\Models\Magazines;
use Illuminate\Support\Facades\DB;
class ContributeController extends Controller
{
    public function index() 
    {
        $magazines = Magazines::where('faculties_id', Auth::user()->faculties_id)->get();
        return view('student.contribute',compact('magazines'));
    }
    public function postContribute(Request $request)
    {
        $admins = User::where('role_id', 4)
               ->whereExists(function ($query) {
                   $query->select(DB::raw(1))
                         ->from('magazines')
                         ->whereColumn('magazines.faculties_id', 'users.faculties_id');
               })->get();
        $request->validate([
            'title'=>'required',
            'word_files.*' => 'required|file|mimes:doc,docx|max:10240', // Giới hạn mỗi file Word là 10MB
            'image_files.*' => 'file|image|max:5120', // Giới hạn mỗi file ảnh là 5MB
        ]);
        $userId = Auth::id();
        // Tạo một contribution mới
        $contribution = Contribution::create([
            'title' => $request->title,
            'student_id' => $userId,
            'magazines_id' => $request->magazines_id,
        ]);
        // Xử lý upload và lưu file Word
        if ($request->hasfile('word_files')) {
            foreach ($request->file('word_files') as $file) {
                $filename = time().'_'.$file->getClientOriginalName();
                $userDirectory = 'word_files/'.$userId;
                $path = $file->storeAs($userDirectory, $filename, 'public');
                Word::create([
                    'path' => $path,
                    'user_id' => $userId,
                    'contribution_id' => $contribution->id,
                ]);
            }
        }

        // Xử lý upload và lưu file Image
        if ($request->hasfile('image_files')) {
            foreach ($request->file('image_files') as $file) {
                $filename = time().'_'.$file->getClientOriginalName();
                $userDirectory = 'image_files/'.$userId;
                $path = $file->storeAs($userDirectory, $filename, 'public');
                Image::create([
                    'path' => $path,
                    'user_id' => $userId,
                    'contribution_id' => $contribution->id,
                ]);
            }
        }
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new ContributionSubmittedMail($contribution));
        }    
        return back()->with('success', 'Contribution and files have been uploaded and saved successfully.')
                    ->with('contribution',$contribution);
    }
    public function confirmContribution($id)
    {
        $contribution = Contribution::find($id);
        if ($contribution) {
            $contribution->status = 1;
            $contribution->save();

            return response()->make("
                <script>
                    alert('Contribution confirmed successfully. This window will now close.');
                    window.close();
                </script>
            ");
        }

        return response()->make("
            <script>
                alert('Contribution not found.');
                window.close();
            </script>
        ");
    }
}