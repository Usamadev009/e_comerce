@extends('backend.admin.layouts.common')

@section('title', 'Groups')

@section('header')
    @parent
@endsection
@section('content')
    <div class="admin-content-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-3">
                    <div class="card-body">
                        <h2>All Deleted Groups</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-3">
                    <div class="card-body">
                        @if(count($groups)!=0)
                            <table id="datatable1" class="table table-striped table-hover table-bordered">
                                <thead>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Show / Hide</th>
                                <th style="width: 240px">Action</th>
                                </thead>
                                <tbody>
                                <?php $i = 1 ?>
                                @foreach($groups as $group)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$group->name}}</td>
                                        <td>{{$group->description}}</td>
                                        <td>
                                            <input type="checkbox" {{ $group->status == '1' ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <a href="{{'group/re-store/'.$group['id']}}" class="btn btn-xs btn-primary re-store_brand" data-id=""><i>Re-store</i></a>
                                            <a href="{{'group-pr/delete/'.$group['id']}}" class="btn btn-xs btn-danger delete_brand" data-id=""><i>Permanent Delete</i></a>
                                        </td>
                                    </tr>
                                <?php $i++ ?>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="not-found">!!! No Groups Found !!!</div>
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
        $('#datatable1').DataTable();
        } );
    </script>
@endsection
