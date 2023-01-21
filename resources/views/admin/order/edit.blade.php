<div class="order-detalils p-4">
    <div class="row">
        <div class="col-lg-6">
            <p>Customer Name: {{$order->c_name}}</p>
            <p>Customer Phone: {{$order->c_phone}}</p>
            <p>Customer Email: {{$order->c_email}}</p>
            <p>Customer Country: {{$order->c_country}}</p>
            <p>Customer Zipcode: {{$order->c_zipcode}}</p>
        </div>
        <div class="col-lg-6">
            <p>Customer Address: {{$order->c_address}}</p>
            <p>Customer Extra Phone: {{$order->c_extra_phone}}</p>
            <p>Customer City: {{$order->c_city}}</p>
            <p>Customer Subtotal: {{$order->subtotal}}</p>
            <p>Customer Total: {{$order->total}}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order_details as $item)
                    <tr>
                        <td>{{$item->product_name}}</td>
                        <td>{{$item->color}}</td>
                        <td>{{$item->size}}</td>
                        <td>{{$item->quantity}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforeach

                    <tr>
                        <td scope="row"></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <form action="{{route('order.status.update')}}" method="post" >
        @csrf
        <div class="form-group">
            <label for="">Status</label>
            <select class="form-control" name="status" id="">
                <option value="0" @if($order->status==0) selected @endif>Pending</option>
                <option value="1" @if($order->status==1) selected @endif>Recieved</option>
                <option value="2" @if($order->status==2) selected @endif>Shipped</option>
                <option value="3" @if($order->status==3) selected @endif>Completed</option>
                <option value="4" @if($order->status==4) selected @endif>Return</option>
                <option value="5" @if($order->status==5) selected @endif>Canccel</option>
            </select>
            <input type="hidden" name="id" value="{{$order->id}}">
        </div>
    
        <input type="submit" name="submit" value="Update">
    </form>
</div>
