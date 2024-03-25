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
class ContributeController extends Controller
{
    public function index()
    {
        return view('student.contribute');
    }
    public function postContribute(Request $request)
    {
        $admins = User::where('role_id', 1)->get();
        $request->validate([
            'word_files.*' => 'required|file|mimes:doc,docx|max:10240', // Giới hạn mỗi file Word là 10MB
            'image_files.*' => 'file|image|max:5120', // Giới hạn mỗi file ảnh là 5MB
        ]);

        $userId = Auth::id();

        // Tạo một contribution mới
        $contribution = Contribution::create([
            'student_id' => $userId,
            
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
}