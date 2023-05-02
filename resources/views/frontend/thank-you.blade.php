@extends('layouts.common')

@section('title', 'Thank You')

@section('header')
    @parent
@endsection
@section('content')

<section class="section py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-2">
                    <div class="card-body">
                        <h2 class="section-head mb-1">
                            Home / Thank You
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="card mt-2" style="height: 300px">
                    <div class="card-body">
                        <h2 class="p-5" style="background-color: darkcyan;">Thank You for Shopping here.</h2>
                        @if (session('status'))
                            <h3>{{ session('status') }}</h3>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div><!-- /.container -->
</section>
@endsection
