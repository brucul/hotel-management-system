<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Billing - {{ $getsetting->apk_name }}</title>
  @include('templates._header_admin')
</head>

<body>
  <h2 class="page-header">
    {{ $getsetting->hotel_name }}
    <span class="small"></span>
    <span class="lead text-red pull-right"><b>INVOICE</b></span>
  </h2>
  <h6>
    {{ $getsetting->address }}
    <br/><b>Telp :</b> {{ $getsetting->phone }} - <b>Fax :</b> {{ $getsetting->number_fax }} - <b>Email :</b> {{ $getsetting->email }}
    <br/><b>{{ $getsetting->website }}</b>
  </h6>
  <br/>
  <br/>
  <address>
    <p>Ditujukan Kepada : <span class="pull-right"><b>NOMOR INVOICE : </b></span></p>

    <p><strong>{{ $reservation->guest->name }}</strong><span class="lead pull-right">{{ $reservation->payment->invoice }}</span></p>
    {{ $reservation->guest->address }}<br/>
    <p>{{ $reservation->guest->city }} - {{ $reservation->guest->country }} <b class="pull-right">Tanggal Terbit :</b></p>
    <p>Nomor Telp : {{ $reservation->guest->phone }} <span class="lead pull-right"><?php echo date('d M Y'); ?></span></p>
  </address>
  <br/>
  <span class="pull-right">Oleh : {{auth()->user()->profile->name}}</span>
  <br/>
  <br/>


  <h3>RINCIAN TAGIHAN</h3>
  <table class="table table-bordered table-striped table-responsive">
    <thead>
      <tr>
        <th>Produk / Layanan</th>
        <th>Harga</th>
        <th>Qty</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Nomor Kamar : {{ $reservation->room->number }} - Tipe Kamar : {{ $reservation->room->category->name }}</td>
        <td>@currency($reservation->room->price)</td>
        <td>{{$qty}} Malam</td>
        <td>@currency($reservation->room->price * $qty)</td>
      </tr>
      <tr>
        <td>Kasur Tambahan</td>
        <td>@currency($getsetting->bed)</td>
        <td>{{$reservation->bed}} Buah</td>
        <td>@currency($getsetting->bed * $reservation->bed)</td>
      </tr>
      {{--<tr>
        <td>Breakfast</td>
        <td>@currency($breakfast)</td>
        <td>{{ ($reservation->adult) }} (Adult) + {{ $reservation->children }} (Children 50%)</td>
        <td>@currency($breakfast_price * $qty)</td>
      </tr>--}}
    </tbody>
  </table>
  @php
  $diskon = ($reservation->room->price * ($reservation->discount->value/100));
  @endphp
  <div class="row">
    <div class="col-sm-6">
      <table class="table table-bordered table-responsive">
        <tr>
          <td><b>Sub-Total</b></td>
          <td>@currency(($reservation->room->price * $qty) + ($getsetting->bed * $reservation->bed))</td>
        </tr>
        <tr>
          <td>Discount</td>
          <td>{{ $reservation->discount->value }}% (@currency($diskon*$qty))</td>
        </tr>
        <tr>
          <td><b>Grand Total</b></td>
          <td><b>@currency( (($reservation->room->price - $diskon)*$qty) + ($getsetting->bed * $reservation->bed))</b></td>
        </tr>
      </table>
    </div>
    <div class="col-sm-6">
      <p class="text-muted well well-sm no-shadow">
        <b>Catatan :</b> Mohon simpan bukti pembayaran ini sebaik mungkin. Pihak hotel tidak akan melayani keluhan-keluhan tamu yang tidak memiliki bukti pembayaran resmi oleh Pihak Hotel
      </p>
    </div>
  </div>
  @include('templates._footer_admin')
  <script type="text/javascript">
    window.print();
  </script>
</body>
</html>