<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ServicesHelpers;
use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\Profile;
use App\Models\User;
use App\Models\Room;
use App\Models\Reservation;
use App\Models\SettingHotel;
use Illuminate\Http\Request;
use App\Http\Requests\SettingRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportsExport;


class HomeController extends Controller
{

    public function credentials($request, $pict)
    {
        return [
            'hotel_name'        => $request->hotel_name,
            'apk_name'          => $request->app_name,
            'address'           => $request->address,
            'regency'           => $request->regency,
            'province'          => $request->province,
            'phone'             => $request->phone,
            'number_fax'        => $request->number_fax,
            'email'             => $request->email,
            'website'           => $request->website,
            'pict'              => $pict,
            'bed'               => $request->bed,
            'breakfast'         => $request->breakfast,
        ];
    }


    public function index()
    {
        $getsetting = SettingHotel::latest('id')->first();
        $apk_name = 'default';
        $hotel_name = 'default';
        $pict = 'default';
        if (!empty($getsetting)) {
            $apk_name = $getsetting->apk_name;
            $hotel_name = $getsetting->hotel_name;
            $pict = $getsetting->pict;
        }

        $title = "Dashboard";
        $sub_title = "";
        $guests = Guest::count();
        $rooms = Room::where('is_booked', 0)->count();
        $profiles = User::role(['Staff', 'staff', 'STAFF'])->count();
        $check_in = Reservation::where('check_out', null)->orderBy('check_in')->count();

        return view('backend.home.main', compact('title', 'sub_title', 'guests', 'rooms', 'profiles', 'check_in', 'apk_name', 'hotel_name', 'pict', 'getsetting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function report()
    {
        $getsetting = SettingHotel::latest('id')->first();
        $apk_name = 'default';
        $hotel_name = 'default';
        $pict = 'default';
        $bed = 0;
        $breakfast = 0;
        if (!empty($getsetting)) {
            $apk_name = $getsetting->apk_name;
            $hotel_name = $getsetting->hotel_name;
            $pict = $getsetting->pict;
            $bed = $getsetting->bed;
            $breakfast = $getsetting->breakfast;
        }

        $title = "Report";
        $sub_title = "Daily Report";
        $reservations = Reservation::where('check_in', date('Y-m-d'))->get();
        
        // $total = $reservations->payment->payment_total;
        // return $total;
        return view('backend.reservation.report.main', compact('title', 'sub_title', 'reservations', 'apk_name', 'hotel_name', 'pict', 'bed', 'breakfast'));
    }

    public function export() 
    {
        return Excel::download(new ReportsExport, 'reports-'.date('d-m-Y').'.xlsx');
    }

    public function setting()
    {
        $getsetting = SettingHotel::latest('id')->first();

        $view = 'create';
        $apk_name = 'default';
        $hotel_name = 'default';
        $pict = 'default';
        if (!empty($getsetting)) {
            $apk_name = $getsetting->apk_name;
            $hotel_name = $getsetting->hotel_name;
            $pict = $getsetting->pict;
            $view = 'main';
        }

        $title = "Pengaturan";
        $sub_title = "";
        return view('backend.setting.'.$view, compact('title', 'sub_title', 'apk_name', 'hotel_name', 'pict', 'getsetting'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            notify()->error($request->validator->messages()->first(), 'Error !!');
            return back();
        }

        $pict = 'default';
        $dir = public_path('storage/backend/setting/');
        ServicesHelpers::make_directory($dir);

        if($request->file('pict')) {
            ServicesHelpers::make_directory($dir.'pict/');
            $file = $request->file('pict');
            $pict = "pict-".str_slug($request->hotel_name)."-".time().".".$file->extension();
            ServicesHelpers::resize_image($file, 1270, 720, $dir.'pict/'.$pict);
        }

        SettingHotel::create($this->credentials($request, $pict));
        notify()->success('Berhasil Mengubah Pengaturan.', 'Horayy !!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $getsetting = SettingHotel::latest('id')->first();
        $apk_name = 'default';
        $hotel_name = 'default';
        $pict = 'default';
        if (!empty($getsetting)) {
            $apk_name = $getsetting->apk_name;
            $hotel_name = $getsetting->hotel_name;
            $pict = $getsetting->pict;
        }

        $getDBSet = SettingHotel::where('id', $id)->first();
        if(!Empty($getDBSet) == NULL){
            $title = "Pengaturan";
            $sub_title = "";
            return view('backend.setting.create', compact('title', 'sub_title', 'apk_name', 'hotel_name', 'pict'));
        }else{
            $title = "Pengaturan";
            $sub_title = "";
            $settings = SettingHotel::where('id', $id)->first();
            return view('backend.setting.edit', compact('title', 'sub_title', 'settings', 'apk_name', 'hotel_name', 'pict'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, $id)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            notify()->error($request->validator->messages()->first(), 'Error !!');
            return back();
        }

        $settings = SettingHotel::findOrFail($id);
        $pict = $settings->pict;
        $dir = public_path('storage/backend/setting/');

        if($request->file('pict')) {
            $file = $request->file('pict');
            $pict = "pict-".str_slug($request->hotel_name)."-".time().".".$file->extension();
            ServicesHelpers::resize_image($file, 1270, 720, $dir.'pict/'.$pict);
        }


        $settings->update($this->credentials($request, $pict));
        notify()->success('Berhasil Mengubah Pengaturan.', 'Horayy !!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
