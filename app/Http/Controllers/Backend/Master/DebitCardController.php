<?php

namespace App\Http\Controllers\Backend\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DebitCard;
use App\Http\Requests\Master\DebitCardRequest;
use App\Models\SettingHotel;

class DebitCardController extends Controller
{
    public function credentials($request)
    {
        return [
            'name'      => $request->name,
            'slug_name' => str_slug($request->name),
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        $title = "Kartu Debit";
        $sub_title = "List Kartu Debit";
        $cards = DebitCard::orderBy('name')->get();
        return view('backend.master.debit_card.main', compact('title', 'sub_title', 'cards', 'apk_name', 'hotel_name','pict'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DebitCardRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            notify()->error($request->validator->messages()->first(), 'Error !!');
            return back();
        }

        DebitCard::create($this->credentials($request));
        notify()->success('Berhasil Menambah Kartu Debit.', 'Horayy !!');
        return back();
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DebitCardRequest $request, $id)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            notify()->error($request->validator->messages()->first(), 'Error !!');
            return back();
        }

        $card = DebitCard::findOrFail($id);
        $card->update($this->credentials($request));
        notify()->success('Berhasil Mengubah Kartu Debit.', 'Horayy !!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DebitCard::destroy($id);
        notify()->success('Berhasil Menghapus Kartu Debit.', 'Horayy !!');
        return response()->json([
            'success' => 'Sukses Menghapus Data'
        ]);
    }
}
