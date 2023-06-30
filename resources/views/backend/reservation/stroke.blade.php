<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Billing - {{$apk_name}}</title>
  @include('templates._header_admin')
</head>

<body>
  <h2 class="page-header">
    Grand Dian Hotel
    <span class="small"></span>
    <span class="lead text-red pull-right"><b>INVOICE</b></span>
  </h2>
  <h6>
    {{ $getsetting->address }}
    <br/><b>Telp :</b> {{ $getsetting->phone }} - <b>Fax :</b> {{ $getsetting->number_fax }} - <b>Email :</b> {{ $getsetting->email }}
    <br/><b>{{ $getsetting->website }}</b>
    <p class="pull-right">
      <span class="lead">Invoice No. {{ $payment->invoice }}</span><br/>
      <span>Oleh : {{auth()->user()->profile->name}}</span>
    </p>
  </h6>
  <br/>
  <br/>
  <br/>
  <br/>

<table class="table table-bordered table-striped table-responsive">
  <tbody>
    <tr>
      <td>Telah Menerima Dari : </td>
      <td>{{$reservation->guest->name}}</td>
    </tr>
    <tr>
      <td>Banyaknya Uang : </td>
      <td>@currency($payment->payment_total)</td>
    </tr>
    <tr>
      <td>Metode Pembayaran : </td>
      <td>{{$payment->method}}</td>
    </tr>
  </tbody>
</table>

<p>
  <span class="pull-right">{{date('d M Y')}}</span>
  <h2>Jumlah @currency($payment->payment_total)</h2>
</p>
@include('templates._footer_admin')
<script type="text/javascript">
  window.print();
</script>
</body>
</html>
