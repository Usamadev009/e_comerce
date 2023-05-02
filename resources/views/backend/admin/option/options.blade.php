@extends('backend.admin.layouts.common')

@section('title', 'Options')

@section('header')
    @parent
@endsection
@php
$options = App\Models\Option::first();
@endphp
@section('content')
    <div class="admin-content-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-2">
                    <div class="card-body">
                        <h2 class="admin-heading mb-1">Options</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-2">
                    <div class="card-body">
                        <form action="{{route('options.update', [$options->id])}}" class="add-post-form row" method="post" enctype="multipart/form-data">
                            @csrf
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control site_name" name="id" value="{{$options['id']}}" placeholder="Site Name"/>
                                        <label for="">Site Name</label>
                                        <input type="text" class="form-control site_name" name="site_name" value="{{$options?$options->site_name:''}}" placeholder="Site Name"/>
                                        <input type="hidden" name="s_no" value=""/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Site Title</label>
                                        <input type="text" class="form-control site_title" name="site_title" value="{{$options?$options->site_title:''}}" placeholder="Site Title"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Site Description</label>
                                        <textarea name="site_desc" value="" class="form-control site_desc" cols="30" rows="3">{{ $options?$options->site_desc:''}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label>Contact Email</label>
                                        <input type="email" class="form-control email" name="contact_email" value="{{$options?$options->contact_email:''}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact Phone Number</label>
                                        <input type="text" class="form-control phone" name="contact_phone" value="{{$options?$options->contact_phone:''}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Site Logo</label>
                                        <input type="file" class="new_logo" name="site_logo" />
                                        <input type="hidden" class="old_logo" name="old_logo" value="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        @if (isset($options->site_logo))
                                            <img id="image" src="{{ asset($options->site_logo?$options->site_logo:'') }}" alt="" width="100px"/>
                                        @else
                                            <img src="" style="height:50px;width:50px;">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="">Footer Text</label>
                                        <input type="text" class="form-control footer_text" name="footer_text" value="{{$options?$options->footer_text:''}}">
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Currency Format</label>
                                        <input type="text" class="form-control currency" name="currency_format" value="{{$options?$options->currency_format:''}}">
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact Address</label>
                                        <textarea name="contact_address" type="text" class="form-control address" cols="30" rows="3" value="">{{ $options?$options->contact_address:''}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="submit" class="btn add-new" name="submit" value="Update">
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
