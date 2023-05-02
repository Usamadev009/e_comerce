<html>
    <head>

    </head>
    <body>
        <h4>PROJECT : Welcome to Master Furniture inline purchase</h4>

        <h4>First Name : {{ $order_data['name'] }}</h4>
        <h4>Last Name : {{ $order_data['lname'] }}</h4>
        <h4>Phone : {{ $order_data['mobile'] }}</h4>
        <h4>Address : {{ $order_data['address'] }}</h4>
        <h4>City : {{ $order_data['city'] }}</h4>
        <h4>State : {{ $order_data['state'] }}</h4>
        <h4>Pincode : {{ $order_data['pincode'] }}</h4>
        <h4>Email : {{ $order_data['email'] }}</h4>

        <table cellpadding="1" cellspacing="1" border="1">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Qty</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @php    $total = 0  @endphp
                @foreach ($items_in_cart as $data)
                <tr>
                    <td>{{ $data['item_name'] }}</td>
                    <td>{{ $data['item_quantity'] }}</td>
                    <td>{{ $data['item_price'] }}</td>
                </tr>
                @php    $total = $total + ($data['item_quantity'] * $data['item_price'])    @endphp
                @endforeach
                <tr>
                    <td colspan="2">Grand Total: </td>
                    <td>Rs: {{ number_format($total, 2) }} </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
