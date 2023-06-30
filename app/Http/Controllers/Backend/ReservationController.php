<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Category;
use App\Models\Guest;
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\Discount;
use App\Models\DebitCard;
use App\Models\RoomAcomodation;
use DateTime;
use App\Http\Requests\ReservationRequest;
use App\Models\SettingHotel;

class ReservationController extends Controller
{
    public function credentials_reservation($request, $bed)
    {
        return [
            'guest_id'          => $request->guest_id,
            'room_id'           => $request->room_id,
            'type_id'           => $request->type,
            'guest_in_house'    => $request->guest_id,
            'bed'               => $bed,
            'check_in'          => date('Y-m-d'),
            'check_out'         => null,
            'adult'             => $request->adult,
            'children'          => $request->child,
            'additional_info'   => $request->additional_info,
            'discount_id'       => $request->discount_id,
            'agency'            => $request->agency,
        ];
    }

    public function credentials_payment($request, $reservation_id, $payment, $invoice, $payment_total)
    {
        return [
            'reservation_id'    => $reservation_id,
            'invoice'           => $invoice,
            'method'            => $payment,
            'payment_total'     => $payment_total,
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function check()
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

        $title = "Kamar";
        $sub_title = "List Kamar";
        $rooms = Room::where('is_booked', 0)->orderBy('number')->get();
        return view('backend.reservation.check-room.main', compact('title', 'sub_title', 'rooms', 'apk_name', 'hotel_name', 'pict'));
    }

    public function check_acomodation($id)
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

        $title = "Room Acomodations";
        $sub_title = "List Room Acomodation";
        $acomodations = RoomAcomodation::where('room_id', $id)->orderBy('name')->get();
        return view('backend.reservation.check-room.check', compact('title', 'sub_title', 'acomodations', 'id', 'apk_name', 'hotel_name', 'pict'));
    }

    public function checkin(Request $request)
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

        $title = "Check In";
        $sub_title = "List Kamar";

        $id = Category::where('slug_name', 'room')->first();
        $parent_id = -1;
        if (!empty($id)) {
            $parent_id = $id->id;
        }
        $categories = Category::where('parent_id', $parent_id)->orderBy('name')->get();

        $rooms = Room::where('is_booked', 0)->orderBy('number')->get();

        if (!empty($request->search)) {
            $search = $request->search;
            $rooms = Room::where('is_booked', 0)
                            ->where('number', 'like', '%'.$search.'%')
                            ->orderBy('number')->get();
        }

        return view('backend.reservation.check-in.main', compact('title', 'sub_title', 'rooms', 'categories', 'apk_name', 'hotel_name', 'pict'));
    }

    public function checkin_create($numb)
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

        $title = "Check In";
        $sub_title = "";
        $get_cat = Category::where('slug_name', 'reservation')->first();
        $parent_id = -1;
        if (!empty($get_cat)) {
            $parent_id = $get_cat->id;
        }

        $discounts = Discount::orderBy('value')->get();
        $cards = DebitCard::orderBy('name')->get();
        $type_room = Room::where('id', $numb)->first();
        $guests = Guest::orderBy('name')->get();
        $categories = Category::where('parent_id', $parent_id)->orderBy('name')->get();
        $corporate = Category::where('slug_name', 'like', 'corporate')->first();
        $government = Category::where('slug_name', 'like', 'government')->first();
        $id_corporate = $corporate->id;
        $id_government = $government->id;

        
        return view('backend.reservation.check-in.create', compact('title', 'sub_title', 'categories', 'guests', 'type_room', 'numb', 'cards', 'apk_name', 'hotel_name', 'pict', 'id_corporate', 'id_government', 'discounts'));
    }

    public function checkin_store(ReservationRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            notify()->error($request->validator->messages()->first(), 'Error !!');
            return back();
        }

        $invoice = 'INV-'.date('Ymd').'-'.$request->room_id.'-'.$request->guest_id;

        //extra bed & breakfast
        $bed = 0;
        if (!empty($request->bed)) {
            $bed = $request->bed;
        }

        Reservation::create($this->credentials_reservation($request, $bed));
        $reservation = Reservation::latest('created_at')->first();
        $reservation_id = $reservation->id;

        //method
        if ($request->payment == 'Cash') {
            $payment = 'Cash';
        }
        if ($request->payment == 'Debit') {
            $payment = 'Debit ('.$request->card.')';
        }

        // if (!empty($request->invoice)) {
        //     $invoice = $request->invoice.''.$request->guest_id;
        // }

        //payment
        $getsetting = SettingHotel::latest('id')->first();
        $bed_price = 0;
        $breakfast_price = 0;
        if (!empty($getsetting)) {
            $bed_price = $getsetting->bed;
            $breakfast_price = $getsetting->breakfast;
        }
        $discount = Discount::findOrFail($request->discount_id);
        $extra_bed = $request->bed*$bed_price;
        $breakfast = (($request->adult) * $breakfast_price) + ($request->child * ($breakfast_price/2));
        $price = $reservation->room->price - ($reservation->room->price * $discount->value/100);
        $payment_total = $price + $extra_bed;// - $breakfast;
        

        Payment::create($this->credentials_payment($request, $reservation_id, $payment, $invoice, $payment_total));

        $room = Room::findOrFail($request->room_id);
        $room->update(['is_booked' => 1]);

        $msg = '<a href="'. route('billing', $reservation_id) .'" class="btn btn-xs btn-info" target="_blank" style="text-decoration: none;"> Cetak Billing  </a>  atau <a href="'. route('stroke', $reservation_id) .'" class="btn btn-xs btn-info" target="_blank" style="text-decoration: none;"> Cetak Stroke</a> jika diperlukan';
        notify()->success('Berhasil Check In.', 'Horayy !!');
        return redirect()->route('checkin')->withSuccess($msg);
    }

    public function checkout()
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
        
        $title = "Check Out";
        $sub_title = "List Kamar";

        $id = Category::where('slug_name', 'room')->first();
        $parent_id = -1;
        if (!empty($id)) {
            $parent_id = $id->id;
        }
        $categories = Category::where('parent_id', $parent_id)->orderBy('name')->get();

        $reservations = Reservation::where('check_out', null)->orderBy('check_in')->get();
        return view('backend.reservation.check-out.main', compact('title', 'sub_title', 'reservations', 'categories', 'apk_name', 'hotel_name', 'pict'));
    }

    public function checkout_create($id)
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

        $title = "Check Out";
        $sub_title = "Detail of Reservation";
        $reservation = Reservation::findOrFail($id);

        $breakfast_price = ($breakfast * ($reservation->adult)) + (($breakfast/2) * $reservation->children);

        $payment = Payment::where('reservation_id', $id)->first();

        $in = new DateTime($reservation->check_in);
        $out = new DateTime(date('Y-m-d'));
        $date = $in->diff($out);
        $qty = $date->format('%a');
        if ($qty == 0) {
            $qty = $qty+1;
        }

        $discount = $reservation->room->price*($reservation->discount->value/100);

        return view('backend.reservation.check-out.create', compact('title', 'sub_title', 'reservation', 'qty', 'discount', 'payment', 'apk_name', 'hotel_name', 'pict', 'bed', 'breakfast', 'breakfast_price'));
    }

    public function checkout_store(Request $request, $id)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            notify()->error($request->validator->messages()->first(), 'Error !!');
            return back();
        }

        $reservation = Reservation::findOrFail($id);
        $reservation->update(['check_out' => date('Y-m-d')]);

        $room = Room::findOrFail($request->room_id);
        $room->update(['is_booked' => 0]);

        $payment = Payment::where('reservation_id', $id)->first();
        $payment->update(['payment_total' => $request->payment_total]);

        notify()->success('Berhasil Check Out.', 'Horayy !!');

        return redirect()->route('checkout');
    }

    public function billing($id)
    {
        $getsetting = SettingHotel::latest('id')->first();
        $apk_name = 'default';
        $hotel_name = 'default';
        $pict = 'default';
        $breakfast = 0;
        if (!empty($getsetting)) {
            $apk_name = $getsetting->apk_name;
            $hotel_name = $getsetting->hotel_name;
            $pict = $getsetting->pict;
            $breakfast = $getsetting->breakfast;
        }

        $reservation = Reservation::findOrFail($id);
        $payment = Payment::where('reservation_id', $id)->first();

        $breakfast_price = ($breakfast * ($reservation->adult)) + (($breakfast/2) * $reservation->children);

        $in = new DateTime($reservation->check_in);
        $out = new DateTime(date('Y-m-d'));
        $date = $in->diff($out);
        $qty = $date->format('%a');
        if ($qty == 0) {
            $qty = $qty+1;
        }

        return view('backend.reservation.billing', compact('reservation', 'payment', 'qty', 'apk_name', 'hotel_name', 'pict', 'getsetting', 'breakfast', 'breakfast_price'));
    }

    public function stroke($id)
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

        $reservation = Reservation::findOrFail($id);
        $payment = Payment::where('reservation_id', $id)->first();

        $in = new DateTime($reservation->check_in);
        $out = new DateTime(date('Y-m-d'));
        $date = $in->diff($out);
        $qty = $date->format('%a');
        if ($qty == 0) {
            $qty = $qty+1;
        }

        return view('backend.reservation.stroke', compact('reservation', 'payment', 'qty', 'apk_name', 'hotel_name', 'pict', 'getsetting'));
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
