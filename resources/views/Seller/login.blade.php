<html>
    <body>
        <head></head>
 <form method="post" action="">
    {{@csrf_field()}}
       

        Email: <input type="text" name="email" placeholder="ID" value="{{old('email')}}"><br>
        @error('email')
            {{$message}} <br>
        @enderror
        
        Password: <input type="password" name="password"><br>
        @error('password')
            {{$message}}<br>
        @enderror
     <input type="submit" value="Sign In">
     <br>
     
    
</form>
<a href="/sellerregister">Don't Have An Account?</a>

</body>
    </html>
