<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Email</title>
</head>
<body style="font-family:Arial,Helvetica,sana-serif; font-size:16px;">
    
    @if ($mailData['userType'] == 'customer')
    <h1>Thanks for your order!!</h1>
    <h2>Your order Id Is:#{{$mailData['order']->id}}</h2>
    @else
    <h1>Your have received an order::</h1>
    <h2>Order id:#{{$mailData['order']->id}}</h2>
    @endif
    
    <h2>Product</h2>


    <table>
        <thead>
            <tr style="background: #ccc;">
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>                                        
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mailData['order']->items as $item)
            <tr>
                <td>{{$item->name}}</td>
                <td>${{number_format($item->price,2)}}</td>                                        
                <td>{{$item->qty}}</td>
                <td>${{number_format($item->total,2)}}</td>
            </tr>
            @endforeach
     
         
            <tr>
                <th colspan="3" class="text-right">Subtotal:</th>
                <td>${{number_format($mailData['order']->subtotal,2)}}</td>
            </tr>
            
            <tr>
                <th colspan="3" class="text-right">Discount:</th>
                <td>${{number_format($mailData['order']->discount,2)}}</td>
            </tr>
            <tr>
                <th colspan="3" class="text-right">Shipping:</th>
                <td>${{number_format($mailData['order']->shipping,2)}}</td>
            </tr>
            <tr>
                <th colspan="3" class="text-right">Grand Total:</th>
                <td>${{number_format($mailData['order']->grand_total,2)}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
