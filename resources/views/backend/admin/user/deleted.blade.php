@extends('backend.admin.layouts.common')

@section('title', 'Users')

@section('header')
    @parent
@endsection

@section('content')
    <div class="admin-content-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-4">
                    <div class="card-body">
                        <h2>All Deleted Users</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-4">
                    <div class="card-body">
                        @if(count($users)!=0)
                            <table id="datatable1" class="table table-striped table-hover table-bordered">
                            <thead>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th >Action</th>
                                </thead>
                                <tbody>
                                    <?php $i=1 ?>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->mobile}}</td>
                                        <td>{{$user->address}}</td>
                                        <td>{{$user->role}}</td>
                                        <td>
                                            @if($user->status=='Unblock')
                                                <span class="label" style="background-color:#04AA6D;color:white;padding:5px;border-radius:18px">{{$user->status}}</span>
                                            @else
                                                <span class="label" style="background-color:#f6c23e;color:white;padding:5px;border-radius:18px">{{$user->status}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{'user/re-store/'.$user['id']}}" class="btn btn-xs btn-primary re-store_user" data-id=""><i>Re-store</i></a>
                                            <a href="{{'user-pr/delete/'.$user['id']}}" class="btn btn-xs btn-danger delete_user" data-id=""><i>Permanent Delete</i></a>
                                        </td>
                                    </tr>
                                    <?php $i++ ?>

                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="not-found clearfix">!!! No Users Found !!!</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="user-detail" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <!-- /Modal -->
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
        $('#datatable1').DataTable();
        } );
    </script>
@endsection
