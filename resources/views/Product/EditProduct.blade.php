<html>

    <body>

<center>

        <form method="post" action='/UpdateProduct/{{ $product->P_id }}' enctype="multipart/form-data">

    {{@csrf_field()}}

    @method('PUT')

        Product Name: <input type="text" name="P_name" placeholder="Product Name" value="{{$product->P_name}}"><br>

 <br>



     Product Description:<input type="text" name="P_description" value="{{$product->P_description}}"></input><br>
<br>

        Price: <input type="text" name="P_price" value="{{$product->P_price}}" placeholder="Product Price"><br>

<br>
        <input type="file" name="P_photo">

        <img src="{{asset('storage/profile_images/'.$product->P_photo)}}" width="80px" height="90px" alt="image">

<br>

        <br><input type="submit" value="Update Product"><br>
    </form>


</center>

    </body>

</html>