@extends('backend.main')
@section('content')
<section id="dashboard-analytics" class="content">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="box">
                <div class="box-content">
                    <img src="{{ asset('templates/backend/app-assets/images/elements/decore-left.png') }}" class="img-left pull-left" alt="card-img-left">
                        <img src="{{ asset('templates/backend/app-assets/images/elements/decore-right.png') }}" class="img-right pull-right" alt="card-img-right">
                        <div class="avatar avatar-xl bg-primary shadow mt-0">
                            <div class="avatar-content">
                                <i class="feather icon-award white font-large-1"></i>
                            </div>
                        </div>
                        <div class="text-center">
                            <img src="{{ asset('storage/backend/setting/pict/'.$pict) }}" width="30%">
                            <h1 class="mb-2 text-white">Selamat Datang {{auth()->user()->profile->name}}</h1>
                            <p class="m-auto w-75">Semoga Hari Anda Selalu Menyenangkan</p><hr/>
                        </div>
                </div>
            </div>
        </div>

        @include('backend.home.chart')
    </div>
</section>
@endsection
