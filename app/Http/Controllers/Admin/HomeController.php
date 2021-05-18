<?php

namespace App\Http\Controllers\Admin;

use App\Checkout;
use App\Http\Controllers\Controller;
use App\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class HomeController extends Controller
{
    public function index()
    {
        $month = 12;
        $labels = $this->getLastMonths($month);
        $chartValues = $this->getVisitPerMonths($month);

        $visits = Visit::count();
        $visitors = Visit::all()->unique('ip')->count();
        $succussfulPayment = Checkout::where('payment',1)->where('resnumber','!=',null)->count();
        $unsuccussfulPayment = Checkout::where('payment',0)->where('resnumber','!=',null)->count();

        return view('admin.index',compact(
            'visits',
            'visitors',
            'succussfulPayment',
            'unsuccussfulPayment',
            'labels',
            'chartValues',
        ));
    }

    private function getLastMonths($month)
    {
        for ($i = 0 ; $i < $month ; $i++) {
            $labels[] = jdate( Carbon::now()->subMonths($i))->format('%B');
        }
        return array_reverse($labels);
    }

    private function getVisitPerMonths($months)
    {
        $date = jdate();
        $year = $date->getYear();
        $month = $date->getMonth();
        $days = $date->getMonthDays();
        $date = new Jalalian($year, $month, $days);

        $values = [];
        $month = $date->toCarbon();
        $subMonth = $date->subMonths(1)->toCarbon();

        for($i = 0 ; $i < $months ; $i++)
        {
            $values['visits'][] = Visit::where('created_at', '<',$month)
                ->where('created_at', '>',$subMonth)
                ->count();

            $values['visitors'][] = Visit::where('created_at', '<',$month)->where('created_at', '>',$subMonth)->get()->unique('ip')->count();

            $month = $subMonth;
            $subMonth = jdate($subMonth)->subMonths(1)->toCarbon();
        }

        $values['visits'] = array_reverse($values['visits']);
        $values['visitors'] = array_reverse($values['visitors']);

        return $values;
    }
}
