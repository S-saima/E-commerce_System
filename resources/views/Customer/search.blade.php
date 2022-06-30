


<!DOCTYPE html>
<html>
<head>
    <body>
    @extends('layouts.customermain')
@section('content')
<h3>Welcome Mr {{$user->C_name}}</h3>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 12px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
</style>
</head>
<body>

<table border='2'>
    
  <tr>
    <th>Product Name</th>
        <th>Product Description</th>
        <th>Product Price</th>
        <th>Product Picture</th>
        <th>Click to Add on Cart</th>
  </tr>
  
    
@foreach ($product as $products)
<tr>
<td>{{$products->P_name}}</td>
<td><text>{{$products->P_description}}</text></td>
    <td>BDT. {{$products->P_price}}</td>
    <td>
      <a><img src="{{asset('storage/profile_images/'.$products->P_image)}}" width="100px" height="150px" alt="">
</a></td>

<td>

<!--Add on Cart table-->
    <form action="/add_to_cart" method="POST">
        {{@csrf_field()}}

        <input type="hidden" name="p_id"  value="{{$products->P_id}}">
        <input type="submit" value="Add to Cart">
</form></td>
</tr>
@endforeach

  
</table>
@endsection
</body>
</html>
