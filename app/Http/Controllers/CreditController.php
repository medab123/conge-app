<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CreditController extends Controller
{
    public static function getSold($user_id)
    {
        $user = User::with("contrat")->find($user_id);
        if (!$user || !$user->contrat)
            return 0;
        $contract = $user->contrat;
        $workingDaysPerMonth = $contract->nb_jours / 12;
        echo $workingDaysPerMonth . "\n";
        $employmentStartDate = $user->contrat_date;
        $now = now();

        $contrat_year = Carbon::parse($employmentStartDate)->format('Y');
        $now_year = Carbon::now()->year;
        $deff_years = Carbon::parse($now_year."-01-01")->diffInYears($contrat_year."-01-01");
        echo "date start = $contrat_year\ndate now = $now_year\ndeff years = $deff_years\n";

        for ($i = $contrat_year; $i <= $now_year; $i++) {
            $date1 = $i."-01-01";
            $date2 = ((int)$i+1).'-01-01';

            if($i == $contrat_year) $date1 = $employmentStartDate;
            if($i == $now_year) $date2 = $now;

            
           

            $employmentDurationInMonths = Carbon::parse($date1)->diffInMonths($date2);
            //echo $employmentDurationInMonths . "\n";
            $totalWorkingDays = $employmentDurationInMonths * $workingDaysPerMonth;
            //$leaveDaysTaken = Demande::where('demandeur_id', $user_id)->where("status", 2)->whereBetween("date_")->sum('duration');
            //echo $leaveDaysTaken . "\n";
            $remainingLeaveDays = $totalWorkingDays; //- $leaveDaysTaken;
            echo $date1."\t$date2\t$remainingLeaveDays\n";
        }



        /*$employmentDurationInMonths = Carbon::parse($now)->diffInMonths($employmentStartDate);
        echo $employmentDurationInMonths . "\n";
        $totalWorkingDays = $employmentDurationInMonths * $workingDaysPerMonth;
        $leaveDaysTaken = Demande::where('demandeur_id', $user_id)->where("status", 2)->sum('duration');
        echo $leaveDaysTaken . "\n";
        $remainingLeaveDays = $totalWorkingDays - $leaveDaysTaken;
        return $remainingLeaveDays;*/

    }
}