<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Candidate extends Model
{
    use HasFactory;

    public static function deleteCandidate($id) {
        
        DB::table('candidates')->where('id', '=', $id)->delete();
        DB::table('vote_candidates')->where('candidateid', '=', $id)->delete();

    
    
    }
}
