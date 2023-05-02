@extends('backend.vendor.layouts.common')

@section('title', 'Edit Sub_Category')

@section('header')
    @parent
@endsection

@section('content')
    <div class="admin-content-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-3">
                    <div class="card-body">
                        <h3>Edit Sub Category</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-3">
                    <div class="card-body">
                        <!-- Form -->
                        <form action="{{route('vendor-sub-categorie.update', [$subcategory->id])}}" class="" method="POST" enctype="multipart/form-data" autocomplete="off">
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
                                            <label>Category Id (Name)</label>
                                            <select name="category_id" class="form-control">
                                                <option value="{{ $subcategory->category_id }}">{{$subcategory->category->name}}</option>
                                                @foreach (App\Models\Category::get() as $gitem)
                                                    <option value="{{ $gitem->id }}">{{ $gitem->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" value="{{ $subcategory->name }}" class="form-control" placeholder="Enter Name"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Custom URL (Slug)</label>
                                            <input type="text" name="url" value="{{ $subcategory->url }}" class="form-control" placeholder="Custom URL" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea rows="4" class="form-control" name="description" placeholder="Enter Description">{{ $subcategory->description }}"</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mt-4">
                                            <label>Image</label>
                                            <input type="file" class="product_image form-control" name="image">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <img id="image" src="{{ asset($subcategory->image?$subcategory->image:'') }}" class="mt-2" width="150px" height="150px"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Prioritty</label>
                                            <input type="number" name="priority" value="{{ $subcategory->priority }}" class="form-control" placeholder="Enter Name"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Show / Hide</label>
                                            <input type="checkbox" {{$subcategory->status == '1'?'checked':''}} name="status" />
                                        </div>
                                    </div>
                                    <input type="submit" name="save" class="btn add-new ml-3" value="Update"/></button>
                                </div>
                        </form>
                        <!-- /Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
