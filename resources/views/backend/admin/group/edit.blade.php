@extends('backend.admin.layouts.common')

@section('title', 'Edit Groups')

@section('header')
    @parent
@endsection

@section('content')
    <div class="admin-content-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-3">
                    <div class="card-body">
                        <h3>Edit Group</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-3">
                    <div class="card-body">
                        <!-- Form -->
                        <form action="{{route('admin-group.update',[$group->id])}}" class="" method="POST" autocomplete="off">
                            @csrf
                                <div class="row">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" value="{{$group->name}}" class="form-control" placeholder="Enter Name"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Custom URL (Slug)</label>
                                            <input type="text" name="url" value="{{$group->url}}" class="form-control" placeholder="Custom URL" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea rows="4" class="form-control" name="description" placeholder="Enter Description">{{$group->description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Show / Hide</label>
                                            <input type="checkbox" name="status" {{ $group->status == "1" ? 'checked' : '' }} />
                                        </div>
                                    </div>
                                    <input type="submit" name="update" class="btn add-new ml-3" value="Update"/></button>
                                </div>
                        </form>
                        <!-- /Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
