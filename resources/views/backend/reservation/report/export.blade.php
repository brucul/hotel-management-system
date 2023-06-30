<table>
    <thead>
        <tr>
            <th width="5">No</th>
            <th width="20">Tipe Kamar</th>
            <th width="15">No. Kamar</th>
            <th width="20">Harga Kamar</th>
            <th width="20">Extra Bed</th>
            <th width="20">Breakfast</th>
            <th width="20">Diskon Kamar</th>
            <th width="20">Total</th>
        </tr>
    </thead>
    <tbody>
        @php
        $no = 1;
        $total = 0;
        @endphp
        @foreach ($reservations as $reservation)
        @php
        $total = $total+$reservation->payment->payment_total-(($breakfast * ($reservation->adult)) + (($breakfast/2) * $reservation->children));
        @endphp
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $reservation->room->category->name }}</td>
            <td>{{ $reservation->room->number }}</td>
            <td>
                @currency($reservation->room->price)
            </td>
            <td>+ @currency($reservation->bed*$bed)</td>
            <td>
                - @currency(
                    ($breakfast * ($reservation->adult)) + (($breakfast/2) * $reservation->children)
                )
            </td>
            <td>{{ $reservation->discount->value }}% (@currency($reservation->room->price*$reservation->discount->value/100))</td>
            <td>@currency($reservation->payment->payment_total - (($breakfast * ($reservation->adult)) + (($breakfast/2) * $reservation->children)))</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="7" align="center"><b>Total</b></th>
            <th><b>@currency($total)</b></th>
        </tr>
    </tfoot>
</table>