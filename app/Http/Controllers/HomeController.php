<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Candidate;
use App\Models\VoteCandidate;

class HomeController extends Controller
{
    public function index()
    {
        $userdata = [];
        if (Auth::check()) {
            $userdata['candidates'] =  Candidate::all();
            $userdata['checkvoted'] =  VoteCandidate::checkUserAvaliable(Auth::user()->id);
            $userdata['votingcount'] =  VoteCandidate::checkVotingCount();
            $userdata['candidatecount'] =  count($userdata['candidates']);
            $userdata['username'] = Auth::user()->username;
        }

        return view('home.index', compact('userdata'));
    }
}
