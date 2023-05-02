@extends('backend.vendor.layouts.common')

@section('title', 'Edit Product')

@section('header')
    @parent
@endsection

@section('content')
    <div class="admin-content-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-3">
                    <div class="card-body">
                        <h2>Edit Product</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-3">
                    <div class="card-body">
                        <form action="{{route('vendor-product.update',[$product->id])}}" method="post" enctype="multipart/form-data">
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
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="product-tab" data-toggle="tab" href="#product" role="tab">Product</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="description-tab" data-toggle="tab" href="#descriptions" role="tab">Description</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="status-tab" data-toggle="tab" href="#status" role="tab">Product Status</a>
                                    </li>
                                </ul>
                                <div class="tab-content border p-3" id="myTabContent">
                                    <div class="tab-pane fade show active" id="product" role="tabpanel">
                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Product Name</label>
                                                    <input type="text" name="name" value="{{$product->name}}" class="form-control" placeholder="Product Name" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Select Sub-Category (Eg: Brands)</label>
                                                    <select class="form-control" name="sub_category_id">
                                                        <option value="{{$product->sub_category_id}}">{{$product->subcategory->name}}</option>
                                                            @foreach(App\Models\Subcategory::where('vendor_id',Auth::user()->id)->get() as $subcategory)
                                                                <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Custom URL (Slug)</label>
                                                    <input type="text" name="url" value="{{$product->url}}" class="form-control" placeholder="Custom URL" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Small Description</label>
                                                    <textarea rows="4" id="summernote_desc" class="form-control" name="small_description" placeholder="Small Description About Product">{{$product->small_description}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mt-3">
                                                    <label>Product Image</label>
                                                    <input type="file" class="product_image form-control" name="image">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <img id="image" src="{{asset($product->image)}}" class="mt-2" width="150px" height="150px"/>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Original Price</label>
                                                    <input type="number" name="original_price" value="{{$product->original_price}}" placeholder="Original Price" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Offer Price</label>
                                                    <input type="number" name="offer_price" value="{{$product->offer_price}}" placeholder="Offer Price" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Quantity</label>
                                                    <input type="number" name="quantity" value="{{$product->quantity}}" placeholder="Quantity" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Priority</label>
                                                    <input type="number" name="priority" value="{{$product->priority}}" placeholder="Priority" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="descriptions" role="tabpanel">
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>High Lights</label>
                                                    <input type="text" name="p_highlight_heading" value="{{$product->p_highlight_heading}}" placeholder="High-Light Heading" class="form-control" />
                                                    <textarea name="p_highlights" id="summernote_highlight" rows="4" class="form-control" placeholder="High-Light Description">{{$product->p_highlights}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Product Description</label>
                                                    <input type="text" name="p_description_heading" value="{{$product->p_description_heading}}" placeholder="Product Description Heading" class="form-control" />
                                                    <textarea name="p_description" id="summernote_p_description" rows="4" class="form-control" placeholder="Product Description">{{$product->p_description}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Product Details/Specification</label>
                                                    <input type="text" name="p_details_heading" value="{{$product->p_details_heading}}" placeholder="Product Details/Specification Heading" class="form-control" />
                                                    <textarea name="p_details" id="summernote_p_specification" rows="4" class="form-control" placeholder="Product Details/Specification">{{$product->p_details}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="status" role="tabpanel">
                                        <div class="row mt-3">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>New Arrival</label>
                                                    <input type="checkbox" name="new_product" {{ $product->new_product == '1' ? 'checked' : '' }} class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Featured Products</label>
                                                    <input type="checkbox" name="featured_products" {{ $product->featured_products == '1' ? 'checked' : '' }} class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Popular Products</label>
                                                    <input type="checkbox" name="popular_products" {{ $product->popular_products == '1' ? 'checked' : '' }} class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Offer Products</label>
                                                    <input type="checkbox" name="offer_products" {{ $product->offer_products == '1' ? 'checked' : '' }} class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Show/Hide</label>
                                                    <input type="checkbox" name="status" {{ $product->status == '1' ? 'checked' : '' }} class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3 text-right">
                                    <input type="submit" class="btn add-new" name="submit" value="Submit">
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#summernote_desc').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 100
        });
        $('#summernote_highlight').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 100
        });
        $('#summernote_p_description').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 100
        });
        $('#summernote_p_specification').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 100
        });
  </script>
@endsection
