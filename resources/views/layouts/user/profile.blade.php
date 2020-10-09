@extends('quick::templates.layout.app')


@section('content')
    <div class="card card-profile">
        <img class="img-header" src="http://itsa.edu.co/images/new-slider-117.jpg" alt="imagen">
        <div class="text-center mb-5">
            <div class="avatar">
                <img src="https://i.ibb.co/WVtjJzF/img6.jpg" alt="imagen">
                <span></span>
            </div>
            <h1 class="name">{{ $user->names}} {{ $user->surnames }}</h1>
            <span class="dni text-muted">C.C. 1.080.082.145</span>
        </div>
    </div>


@stop