@extends('backend.admin.layouts.common')

@section('title', 'Edit Category')

@section('header')
    @parent
@endsection

@section('content')
    <div class="admin-content-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-3">
                    <div class="card-body">
                        <h3>Edit category</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-3">
                    <div class="card-body">
                        <!-- Form -->
                        <form action="{{route('category.update', [$categorie->id])}}"  method ="POST" enctype="multipart/form-data">
                            @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Group Id (Name)</label>
                                            <select name="group_id" class="form-control">
                                                <option value="{{ $categorie->group_id }}">{{$categorie->group->name}}</option>
                                                @foreach (App\Models\Group::where('vendor_id',Auth::user()->id)->get() as $gitem)
                                                    <option value="{{ $gitem->id }}">{{ $gitem->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" value="{{ $categorie->name }}" class="form-control" placeholder="Enter Name"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Custom URL (Slug)</label>
                                            <input type="text" name="url" value="{{ $categorie->url }}" class="form-control" placeholder="Custom URL" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea rows="4" class="form-control" name="description" placeholder="Enter Description">{{ $categorie->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mt-4">
                                            <label>Image</label>
                                            <input type="file" class="product_image form-control" name="image">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <img id="image" src="{{ asset($categorie->image?$categorie->image:'') }}" class="mt-2" width="150px" height="150px"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mt-4">
                                            <label>Icon</label>
                                            <input type="file" name="icon" class="form-control" placeholder="Enter Name"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <img src="{{ asset($categorie->icon?$categorie->icon:'') }}" alt="" class="mt-2" style="width:150px;height:150px" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Show / Hide</label>
                                            <input type="checkbox" {{$categorie->status == '1'?'checked':''}} name="status" />
                                        </div>
                                    </div>
                                    <input type="submit" class="btn add-new ml-3" value="Update"/></button>
                                </div>
                        </form>
                        <!-- /Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
