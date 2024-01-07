<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\MemberResource;

class MemberController extends Controller
{
    //
    public function index() {
        $members = Member::all();

        // return response()->json(['data' => $transactions]);
        return MemberResource::collection($members); 
    }

    public function newMember(Request $request) {
        $request->validate([
            'memberName' => 'required'
        ]);

        DB::table('members')->insert([
            'memberName' => $request->memberName,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // $member = DB::table('members')->latest()->first();

        // return new MemberResource($member);

        return 'added new member';
    }
}
