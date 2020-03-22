<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests\MatchingPercentageRequest;
use App\MatchPercentage;

class MatchPercentageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MatchPercentage::first();
        $employee = Employee::paginate();

        return view('welcome', compact('data', 'employee'));
    }

    /**
     * @param MatchingPercentageRequest $request
     * @return mixed
     */
    public function store(MatchingPercentageRequest $request)
    {
        $check = MatchPercentage::first();
        if ($check) {
            return $check->update($request->all());
        }
        return MatchPercentage::create($request->all());

    }

    public function match()
    {
        $percents = MatchPercentage::first();
        $employees = Employee::all();
        $percentage = [];
        $pairsCount = 0;

        $employeesCount = count($employees);
        $i = 0;
        while ($i < $employeesCount) {
            $j = $i + 1;
            while ($j < $employeesCount) {
                $count = 0;
                if ($employees[$i]->division === $employees[$j]->division) {
                    $count += $percents->division;
                }
                if ($employees[$i]->timezone === $employees[$j]->timezone) {
                    $count += $percents->timezone;
                }
                if (abs($employees[$i]->age - $employees[$j]->age) <= 5) {
                    $count += $percents->age;
                }
                $percentage[$count][$pairsCount][] = $employees[$i];
                $percentage[$count][$pairsCount][] = $employees[$j];
                $j++;
                $pairsCount++;
            }
            $i++;
        }

        $maxPercentage = max(array_keys($percentage));
        $matchingPercentage = array_keys($percentage);
        $result = $percentage[$maxPercentage];
        return view('welcome', compact('result', 'matchingPercentage'));
    }

}
