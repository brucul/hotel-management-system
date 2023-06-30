<?php

namespace App\Exports;

use App\Models\Reservation;
use App\Models\SettingHotel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
    	$reservations = Reservation::where('check_in', date('Y-m-d'))->get();
    	$getsetting = SettingHotel::latest('id')->first();
        $breakfast = 0;
        $bed = 0;
        if (!empty($getsetting)) {
            $bed = $getsetting->bed;
            $breakfast = $getsetting->breakfast;
        }
    	
    	return view('backend.reservation.report.export', compact('reservations', 'bed', 'breakfast'));
    }
}
