@extends('backend.admin.layouts.common')

@section('title', 'Banners')

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
                <div class="card mb-2">
                    <div class="card-body">
                        <h2 class="admin-heading mb-1">All Deleted Banners</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-2">
                    <div class="card-body">
                        @if(count($banners)!=0)
                            <div class="row scrollmenu">
                                <table id="productsTable" class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Photo</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>

                                        <?php $i = 1 ?>
                                    @foreach ($banners as $banner)
                                        <tr>
                                            <td><b>{{$i}}</b></td>
                                            <td>{{$banner->title}}</td>
                                            <td>{{$banner->description}}</td>
                                            <td>
                                                <img src="{{ asset($banner->photo) }}" alt="" width="50px" height="50px"/>
                                            </td>
                                            <td>
                                                @if($banner->status=='Publish')
                                                    <span class="label" style="background-color:#04AA6D;color:white;padding:5px;border-radius:18px">{{$banner->status}}</span>
                                                @else
                                                    <span class="label" style="background-color:#f6c23e;color:white;padding:5px;border-radius:18px">{{$banner->status}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{'banner/re-store/'.$banner['id']}}"><i class="btn btn-xs btn-primary re-store_banner">Re-store</i></a>
                                                <a href="{{'banners-pr/delete/'.$banner['id']}}" class="btn btn-xs btn-danger delete_banner"  data-id="" data-subcat=""><i>Permanent Delete</i></a>
                                            </td>
                                        </tr>
                                    <?php $i++ ?>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination-outer">
                                    {{ $banners->links()}}
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
