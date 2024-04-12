<?php

namespace App\Http\Controllers;

use App\Models\VoteCandidate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function votecandidate(Request $request): RedirectResponse
    {
        // Validate the incoming file. Refuses anything bigger than 2048 kilobyes (=2MB)
        $request->validate([
            'candidate' => 'required'
        ]);

        // Store file information in the database
        $uploadedFile = new VoteCandidate();
        $userdata['username'] = Auth::user()->id;
        $uploadedFile->candidateid = $request->get('candidate');
        $uploadedFile->userid = Auth::user()->id;
        $uploadedFile->save();

        // Redirect back to the index page with a success message
        echo json_encode(['status' => 'success']);
        die();
    }

    public function candidatedetails()
    {
        $getAll = VoteCandidate::getAllByCandidate();
        $key_values = array_column($getAll, 'votingcount');
        array_multisort($key_values, SORT_DESC, $getAll);

        return view('vote.index', compact('getAll'));
    }
    public function userdetails(Request $request)
    {
        $getAll = VoteCandidate::getAllUsersByCandidateId($request->id);
        return view('vote.details', compact('getAll'));
    }
}
