@extends('layouts.app')

@section('css')
    <style>
        body {
            background-color: #d9d9d9;
        }
    </style>
@endsection

@section('content')
    <div class="container my-5">
        <div class="row gy-5">
            <!-- Account sidebar start -->
            @include('includes.account.sidebar')
            <!-- Account sidebar end -->

            <section class="col col-12 col-md-9 bg-white rounded-3 py-5 p-md-5">
                @yield('account-content')
            </section>
        </div>
    </div>
@endsection