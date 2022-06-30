


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
  border: 0.4px solid #ddd;
}

th, td {
  text-align: left;
  padding: 0.02px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
</style>
</head>
<body>

<table border='1'>
    
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
      <a><img src="{{asset('storage/profile_images/'.$products->P_image)}}" width="120px" height="100px" alt="">
</a></td>

<td>

<!--Add on Cart table-->
    <form action="/add_to_cart" method="POST" onsubmit="myFunction()">
        {{@csrf_field()}}

        <input type="hidden" name="p_id"  value="{{$products->P_id}}">
        <input type="submit" value="Add to Cart">
</form>
<script>
function myFunction() {
  alert("The product is added on the cart!");
}
</script>
</td>

</tr>
@endforeach

  
</table>
<span>
    {{$product->links()}}
</span>
<style>
    .w-5{
     display:none;
}
</style>
@endsection
</body>
</html>
