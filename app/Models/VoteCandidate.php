<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VoteCandidate extends Model
{
    use HasFactory;

    public static function checkUserAvaliable(int $user_id): int{
        $count = DB::table('vote_candidates')->where('userid', '=', $user_id)
            ->get();
        return $count->count();

    }

    public static function checkVotingCount(): int{
        $count = DB::table('vote_candidates')->count(DB::raw('DISTINCT userid'));
        return $count;

    }

    public static function getAllByCandidate(){
        $getall = DB::table('vote_candidates')
        ->select(DB::raw('count(vote_candidates.id) as votingcount,candidateid'))
        ->groupBy('candidateid')
        ->get();

        $result = $getall; 
        $resultData = json_decode(json_encode($result), true);
        
        foreach($resultData as $resultimgKey => $resultImgVal) {
            $name = \DB::table('candidates')->select('name','filename')->where('id', '=', $resultImgVal['candidateid'])
            ->get();
            $resultname = isset($name[0]->name)?$name[0]->name:'';
            $resultfile = isset($name[0]->filename)?$name[0]->filename:'';

            $resultData[$resultimgKey]['candidatename'] = $resultname;
            $resultData[$resultimgKey]['candidateimage'] = $resultfile;
        } 
        return $resultData;

    }

    public static function getAllUsersByCandidateId($id){
        $getall = DB::table('vote_candidates')
        ->join('users', 'users.id', '=', 'vote_candidates.userid')
        ->join('candidates', 'candidates.id', '=', 'vote_candidates.candidateid')
        ->select('vote_candidates.*', 'users.username', 'candidates.name')
        ->where('vote_candidates.candidateid','=', $id)
        ->get();


        $result = $getall; 
        $resultData = json_decode(json_encode($result), true);
        
        return $resultData;

    }

    
    
}
