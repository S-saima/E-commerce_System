
    <!DOCTYPE html>
<html>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
     width: 100%;
  }
}
</style>
<body>

<form method="post" action="" style="border:1px solid #ccc">
{{@csrf_field()}}
  <div class="container">
   
    
  <h2>Registration Page</h2>
    <p>Please fill in this form to create an account.</p>
    <hr>
      Name: <input type="text" name="name" placeholder="Name" value="{{old('name')}}"><br>
        @error('name')
            {{$message}}<br>
        @enderror

        ID: <input type="text" name="id" placeholder="id" value="{{old('id')}}"><br>
        @error('id')
            {{$message}} <br>
        @enderror
     
        Email: <input type="text" name="email" placeholder="email" value="{{old('email')}}"><br>
        @error('email')
            {{$message}} <br>
        @enderror
         
        Phone: <input type="text" name="phone" placeholder="phone" value="{{old('phone')}}"><br>
        @error('phone')
            {{$message}} <br>
        @enderror
           
        Address: <input type="text" name="address" placeholder="address" value="{{old('address')}}"><br>
        @error('address')
            {{$message}} <br>
        @enderror
                    
        Password: <input type="password" name="password"><br>
        @error('password')
            {{$message}}<br>
        @enderror
          
        Confirm Password: <input type="password" name="conf_password"><br>
        @error('conf_password')
            {{$message}}<br>
        @enderror
             
    

    <div class="clearfix">
      <button type="button" class="cancelbtn">Cancel</button>
      <button type="submit" class="signupbtn" value="Sign In">Sign Up</button>
    </div>
  </div>
</form>

</body>
</html>

