<?php

namespace App\Http\Controllers;

use App\User;
use App\StatisticUser;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function usersStore()
    {
        try {
            $stats = new StatisticUser();
            $stats = $stats->get();
            $total = [];
            $today = [];
            $labels = [];
            $now = [User::all()->count()];
            foreach ($stats as $stat) {
                array_push($labels, Carbon::parse($stat->date)->format('d.m.Y'));
                array_push($total, $stat->total);
                array_push($today, $stat->today);
            }
            return response()->json([
                'total' => $total,
                'today' => $today,
                'labels' => $labels,
                'now' => $now
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'status' => 'error',
                'msg' => $error->getMessage()
            ]);
        }
    }
}
