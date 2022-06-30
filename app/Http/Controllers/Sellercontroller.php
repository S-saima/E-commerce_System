<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Models\UMSSeller;
use App\Models\UMSCustomer;
use App\Models\UMSProducts;
use App\Models\UMSCart;
use App\Models\UMSOrders;
use App\Models\UMSConfirm_order;

class Sellercontroller extends Controller
{
    //
    function signup(){

        return view("Seller.signup");
    }

    function signupvalidate(Request $req){
        $this->validate($req,
            [
                "name"=>"required",
                "id"=>"required|unique:customers,c_id|integer",
                "email"=>"required|unique:customers,c_id",
                "phone"=>"required",
                "address"=>"required",
                'password' => 'required',
                "conf_password"=>"required|same:password",
                "S_photo"=>"required|mimes:jpg,png,jpeg",
            ],
            [
                "name.required"=>"Please provide your name",
                "id.exists"=>"This id is already taken",
                //"id.regex"=>"Id must be in integer",
                //"name.regex"=>"Only alphabetic",
                //"password.regex"=>"Password minimum 8 characters, contains a uppercase, a lowercase, a number & a special character"
            ]);
            $customer = new UMSSeller();
            $customer->S_name = $req->name;
            $customer->S_id =$req->id;
            $customer->S_email =$req->email;
            $customer->S_phone =$req->phone;
            $customer->S_address =$req->address;
            $customer->S_password = $req->password;

            $file =$req->file('S_photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file ->move('storage/seller_image/',$filename);
            $customer->S_image = $filename;
            $customer->save();
            //session()->flash('msg','successfull');
            //return back();
            return redirect()->route("sellerloginpage");
 
    }


    function login(){
        $user = UMSSeller::where('S_id',session()->get('loggeds'))->first();
        if($user){
            session()->put('loggeds',$user->S_id);
                return redirect()->route('sellerproductdetails');
       
        }
        else
         {
            return view("Seller.login");
         }
    }

    function loginSubmit(Request $req){
        $this->validate($req,
            [
             
                "email"=>"required|exists:sellers,s_email",
                'password' => 'required|exists:sellers,s_password',
                
            ],
            [
                "email.required"=>"Please provide your email",
                "email.exists"=>"Please type your email properly",

                //"nasme.regex"=>"Only alphabetic",
                //"password.regex"=>"Password minimum 8 characters, contains a uppercase, a lowercase, a number & a special character"
            ]);
            $user =UMSSeller::where('S_email',$req->email)
            ->where('S_password',$req->password)->first();

            if($user){
                //session()->flash('msg','User Exists');
                session()->put('loggeds',$user->S_id);
                
                return redirect()->route('sellerproductdetails');
        }
            else {
              session()->flash('msg','User not valid');
            return back();
            } 
    }

    function createproduct(){
        return view('Seller.CreateProduct');
      }

    function productSubmit(Request $req){

        $this->validate($req,

        [

            "p_name"=>"required",

            "P_description"=>"required",

            "P_price"=>"required",

            "P_photo"=>"required|mimes:jpg,png,jpeg",

        ]);
        $user = UMSSeller::where('S_id',session()->get('loggeds'))->first();
        $user=session()->get('loggeds');
        $st = new UMSProducts();
        $st->p_name = $req->p_name;
        $st->P_description =$req->P_description;
        $st->P_price = $req->P_price;
       
              $file =$req->file('P_photo');
              $extension = $file->getClientOriginalExtension();
              $filename = time().'.'.$extension;
              $file ->move('storage/profile_images/',$filename);
              $st->P_image = $filename;
              $st->S_id = $user;
              
        $st->save();
        return redirect()->route('sellerproductdetails');  

    }


    
        function view(){
            

            $users = UMSSeller::where('S_id',session()->get('loggeds'))->first();
            $user=session()->get('loggeds');
   
        //$product = UMSProducts;
        $product=DB::table('products')
      ->join('sellers','products.S_id','=','sellers.S_id')
      ->where('products.S_id',$user)
      ->select('products.*','sellers.*')
      ->get();
      return view('Seller.plist')->with('product',$product)
                                   ->with ('user',$users);
       

            return view('Seller.plist',['product'=>$product]);
        }



        public function editproduct($P_id)

    {
        $product = UMSProducts::find($P_id);
        //return redirect()->route('product.EditProduct');
        return view('product.EditProduct', compact('product'));

    }
    public function update(Request $req, $P_id){
        $product = UMSProducts::find($P_id);
        $product->P_name = $req->P_name;
        $product->P_description =$req->P_description;
        $product->P_price = $req->P_price;
        if($req->hasfile('P_Photo'))
        {
            $destination = 'storage/profile_images/'.$product->P_photo;
             if(File::exists($destination))
            {
                File::delete($destination);

            }
            $file =$req->file('P_photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file ->move('storage/profile_images/',$filename);
            $product->P_image = $filename;
        }
        $product->update();
        return redirect()->route('sellerproductdetails');
   //return redirect()->route('productdetails');    

    }
    

         function everyorder(){
            $users = UMSSeller::where('S_id',session()->get('loggeds'))->first();
            $user=session()->get('loggeds');
           
 
        $allorders=DB::table('confirm_order')
      ->join('products','confirm_order.P_id','=','products.P_id')
      ->join('customers','confirm_order.C_id','=','customers.C_id')
      ->where('products.S_id',$user)
      ->select('products.*','confirm_order.*','customers.*')
      ->get();
      return view('Seller.allorder')->with('allorders',$allorders)
                                   ->with ('user',$users);
        
    }

    public function delivered($CO_id) {
        UMSConfirm_order::destroy($CO_id);
         return redirect()->back();
     }

     public function deleteproduct($P_id) {
        UMSProducts::destroy($P_id);
         return redirect()->back();
     }
    
}
