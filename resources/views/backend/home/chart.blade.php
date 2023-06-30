<section class="content">
    <div class="row">
        <div class="col-sm-3">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$guests}}</h3>
                    <p>Guest History</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a class="small-box-footer" href="{{route('guest.index')}}">Lihat Selengkapnya</a>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{$rooms}}</h3>
                    <p>Room Status</p>
                </div>
                <div class="icon">
                    <i class="fa fa-bed"></i>
                </div>
                <a class="small-box-footer" href="{{route('check')}}">Lihat Selengkapnya</a>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{$check_in}}</h3>
                    <p>Guest In House</p>
                </div>
                <div class="icon">
                    <i class="fa fa-suitcase"></i>
                </div>
                <a class="small-box-footer" href="{{ route('guest.inhouse') }}">Lihat Selengkapnya</a>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{$profiles}}</h3>
                    <p>Staff Aktif</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user-plus"></i>
                </div>
                <a class="small-box-footer" href="{{route('staff.index')}}">Lihat Selengkapnya</a>
            </div>
        </div>
    </div>
</section>
