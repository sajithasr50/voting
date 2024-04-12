<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;

class CandidateController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming file. Refuses anything bigger than 2048 kilobyes (=2MB)
        $request->validate([
            'name' => 'required',
            'file_upload' => 'required|mimes:jpg,png|max:2048',
        ]);

        // Store the file in storage\app\public folder
        $file = $request->file('file_upload');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->store('uploads', 'public');

        $file->move(public_path('uploads'), $fileName);


        // Store file information in the database
        $uploadedFile = new Candidate();
        $uploadedFile->name = $request->get('name');
        $uploadedFile->filename = $fileName;
        $uploadedFile->original_name = $file->getClientOriginalName();
        $uploadedFile->file_path = $filePath;
        $uploadedFile->save();

        // Redirect back to the index page with a success message
        return redirect()->route('candidate.index')
            ->with('success', "New Candidate Added successfully.");
    }

    // shows the create form
    public function create()
    {
        return view('candidate.create');
    }

    // shows the uploads index
    public function index()
    {
        $uploadedFiles = Candidate::all();
        return view('candidate.index', compact('uploadedFiles'));
    }
    public function delete(Request $request)
    {
        Candidate::deleteCandidate($request->id);
        $uploadedFiles = Candidate::all();
        return view('candidate.index', compact('uploadedFiles'));
    }
}
