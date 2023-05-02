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
                        <h2>All Deleted Products</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-3">
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
                                                <a href="{{'product/re-store/'.$product['id']}}"><i class="btn btn-xs btn-primary re-store_product">Re-store</i></a>
                                                <a href="{{'products-pr/delete/'.$product['id']}}" class="btn btn-xs btn-danger delete_product"  data-id="" data-subcat=""><i>Permanent Delete</i></a>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                    @endforeach
                                </tbody>
                            </table>
                                <div class="pagination-outer">
                                    {{ $products->links()}}
                                </div>
                            </div>
                        @else
                            <div class="not-found clearfix">!!! No Products Found !!!</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
