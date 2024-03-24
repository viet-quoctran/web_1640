<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContributeController extends Controller
{
    public function index()
    {
        return view('student.contribute');
    }
    public function postContribute(Request $request)
    {
        $request->validate([
            'word_files.*' => 'required|file|mimes:doc,docx|max:10240', // Giới hạn mỗi file 10MB
        ]);
    
        if($request->hasfile('word_files')) {
            foreach($request->file('word_files') as $file) {
                // Tạo tên file duy nhất
                $filename = time().'_'.$file->getClientOriginalName();
    
                // Lưu file vào thư mục storage/app/public/word_files
                $path = $file->storeAs('word_files', $filename, 'public');
    
                // Lưu đường dẫn file, hoặc xử lý file ở đây
            }
        }
    
        return back()->with('success', 'Files have been uploaded successfully.');
    }
}
