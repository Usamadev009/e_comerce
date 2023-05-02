@extends('backend.vendor.layouts.common')

@section('title', 'Add Sub-Category')

@section('header')
    @parent
@endsection

@section('content')
    <div class="admin-content-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-3">
                    <div class="card-body">
                        <h2>Add New Sub Category</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Form -->
                        <form action="store" class="" method="POST" enctype="multipart/form-data" autocomplete="off">
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
                                                <option value="">Select</option>
                                                @foreach (App\Models\Category::where('vendor_id',Auth::user()->id)->get() as $gitem)
                                                    <option value="{{ $gitem->id }}">{{ $gitem->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Enter Name"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Custom URL (Slug)</label>
                                            <input type="text" name="url" class="form-control" placeholder="Custom URL" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea rows="4" class="form-control" name="description" placeholder="Enter Description"></textarea>
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
                                            <img id="image" src="" class="mt-2" width="150px" height="150px"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Prioritty</label>
                                            <input type="number" name="priority" class="form-control" placeholder="Enter Name"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Show / Hide</label>
                                            <input type="checkbox" name="status" />
                                        </div>
                                    </div>
                                    <input type="submit" name="save" class="btn add-new ml-3" value="Submit"/></button>
                                </div>
                        </form>
                        <!-- /Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
