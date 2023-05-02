@extends('backend.admin.layouts.common')

@section('title', 'Orders')

@section('header')
    @parent
@endsection

@section('content')
    <div class="admin-content-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="">All Orders</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-2 mb-2">
                    <div class="card-body">
                        @if (count($orders)!=0)
                            <table id="datatable1" class="table table-striped table-hover table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>Tracking No</th>
                                    <th>Customer Name</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>Proceed</th>
                                </thead>
                                <tbody>
                                    <?php $i=1 ?>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $order->tracking_no }}</td>
                                        <td>{{ $order->users->name .' '. $order->users->lname }}</td>
                                        <td>{{ $order->users->mobile }}</td>
                                        <td>
                                            @if($order->order_status == '0')
                                                <span class="label" style="background-color:#f6c23e;color:white;padding:5px;border-radius:18px">Pending</span>
                                            @elseif ($order->order_status == '1')
                                                <span class="label" style="background-color:#04AA6D;color:white;padding:5px;border-radius:18px">Completed</span>
                                            @else
                                                <span class="label" style="background-color:red;color:white;padding:5px;border-radius:18px">Cancelled</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('order-view/'.$order->id) }}" class="btn btn-primary btn-sm">View</a>
                                        </td>
                                        <td>
                                            <a href="{{ url('order-proceed/'.$order->id) }}" class="btn btn-success btn-sm">Proceed</a>
                                        </td>
                                    </tr>
                                    <?php $i++ ?>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="not-found">!!! No Orders Found !!!</div>
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
