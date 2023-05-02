@extends('backend.admin.layouts.common')

@section('title', 'Products')

@section('header')
    @parent
@endsection

@section('content')
<style>
    label {
        font-weight: bold !important;
    }
    div.scrollmenu {
    overflow: auto;
    white-space: nowrap;
    }

    div.scrollmenu a {
    display: inline-block;
    color: white;
    text-align: center;
    text-decoration: none;
    }
</style>
    <div class="admin-content-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-3">
                    <div class="card-body">
                        <h2 style="margin-bottom: -15px">All Products</h2>
                        <a class="add-new pull-right ml-2" style="margin-top: -15px" href="{{url('product/create')}}">Add New</a>
                        <a class="btn btn-danger pull-right" style="margin-top: -15px" href="{{url('deleted-product')}}">Deleted Old</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{session('status')}}
                        </div>
                    @endif
                    <div class="card-body">
                        @if(count($products)!=0)
                            <table id="producttable" class="table table-striped table-hover table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Sub Category Name</th>
                                    <th>Image</th>
                                    <th>Show/Hide</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td><b>{{$i}}</b></td>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->subcategory?$product->subcategory->name:''}}</td>
                                            <td>
                                                <img src="{{ asset($product->image) }}" alt="" width="60px" height="60px"/>
                                            </td>
                                            <td>
                                                <input type="checkbox" {{ $product->status == '1' ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <a href="{{'product/edit/'.$product['id']}}"><i class="btn btn-xs btn-primary fa fa-edit"></i></a>
                                                <a href="{{'products/delete/'.$product['id']}}" class="btn btn-xs btn-danger delete_product"  data-id="" data-subcat=""><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="not-found clearfix">!!! No Products Found !!!</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
        $('#producttable').DataTable();
        } );
    </script>
@endsection
