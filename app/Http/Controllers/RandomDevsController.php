<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Support\Facades\DB;

class RandomDevsController extends Controller
{
    public function recoversSixRandomUsers(): \Illuminate\Http\JsonResponse
    {
        $developers = DB::select(
            DB::raw('SELECT DISTINCT developers.*,
                                           (
                                                SELECT AVG(reviews.rating)
                                                FROM reviews
                                                WHERE reviews.dev_id = developers.id
                                           ) as avg,
                                           users.

                            FROM developers
                            INNER JOIN reviews ON reviews.dev_id = developers.id
                                WHERE (
                                        SELECT COUNT(complaints.user_id)
                                        FROM complaints
                                        WHERE complaints.user_id = developers.user_id
                                      ) = 0
                                AND (
                                        (
                                            SELECT AVG(reviews.rating)
                                            FROM reviews
                                            WHERE reviews.dev_id = developers.id
                                        ) >= 3
                                        OR
                                        (
                                            SELECT COUNT(reviews.dev_id)
                                            FROM reviews
                                            WHERE reviews.dev_id = developers.id
                                        ) = 0
                                        OR
                                        (
                                            SELECT AVG(reviews.rating)
                                            FROM reviews
                                            WHERE reviews.dev_id = developers.id
                                        ) = 0
                                )
            ')
        );
        //
        //$developrs = Developer::with('reviews')->avg();
        $devs = [];
        $old_keys = [];
        if(sizeof($developers) >= 6){
           while(sizeof($devs) < 6){
               $key = rand(0,sizeof($developers)-1);
               if(!in_array($key,$old_keys)){
                   $devs[] = $developers[$key];
               }
               $old_keys[] = $key;
           }
        } else {
            $devs = $developers;
        }

        return response()->json(
            $devs
        , 200);
    }
}
