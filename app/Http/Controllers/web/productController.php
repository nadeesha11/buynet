<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Omnipay\Omnipay;

class productController extends Controller
{
   private $gateway;

   public function __construct() {
       $this->gateway = Omnipay::create('PayPal_Rest');
       $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
       $this->gateway->setSecret(env('PAYPAL_SECRET_ID'));
       $this->gateway->setTestMode(true);
   }

    public function detailed($id){
        $detailed_product = DB::table('product')
        ->where('product.id',$id)
        ->join('product_images', 'product.id', '=', 'product_images.product_id')
        ->join('category', 'product.cat_id', '=', 'category.id')
        ->join('sub_category', 'product.sub_cat_id', '=', 'sub_category.id')
        ->select('product_images.name as img_name', 'product.*','category.name as cat_name','sub_category.name as sub_cat_name',)
        ->get();

        $approved_review = DB::table('review')->where('status',1)->where('product_id',$id)->get();

       return view('web.detailed',compact('detailed_product','approved_review'));
        }

     public function displayCheckout(){
        return view('web.checkout');
     }  
     
     public function Checkout(Request $request){
      $request->validate([
       'fname' => 'required',
       'lname' => 'required',
       'address_1' => 'required',
       'address_2' => 'required',
       'postal' => 'required|numeric',
       'phone' => 'required|numeric',
       'email' => 'required|email',
       'district' => 'required',
       'additional_info' => 'required|max:1000',
      ]);

      $queryParams = $request->all();
      session(['checkout_data' => $queryParams]);
      return redirect()->route('web.paypal');
   }  

   public function paypal(){
      try {

         $customerData = session()->get('customer_data');
         $final_price = DB::table('cart')->where('user_id',$customerData->id)->sum('total');

         $response = $this->gateway->purchase(array(
             'amount' => $final_price,
             'currency' => env('PAYPAL_CURRENCY'),
             'returnUrl' => route('web.success'),
             'cancelUrl' => route('web.error')
         ))->send();

         if ($response->isRedirect()) {
             $response->redirect();
            // dd("redirect");
         }
         else{
             return $response->getMessage();
         }

     } catch (\Throwable $th) {
         return $th->getMessage();
     }
   }  

   public function success(){
    
      DB::beginTransaction();
      try {
        $customerData = session()->get('customer_data');
        $checkout_data = session()->get('checkout_data');

        $cartData = DB::table('cart')->where('user_id',$customerData->id)->get();
        
        $final_price = DB::table('cart')->where('user_id',$customerData->id)->sum('total');

        $inserted_order = DB::table('orders')->insertGetId([
        'total' => $final_price,
        'adress_1' => $checkout_data['address_1'],
        'adress_2' => $checkout_data['address_2'],
        'district' => $checkout_data['district'],
        'status' => 0, // order status
        'user_id' => $customerData->id,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),

        'fname' => $checkout_data['fname'],
        'lname' => $checkout_data['lname'],
        'postal' => $checkout_data['postal'],
        'phone' => $checkout_data['phone'],
        'email' => $checkout_data['email'],
        'additional_info' => $checkout_data['additional_info'],
        ]);

        foreach($cartData as $item){
        DB::table('order_list')->insert([
         'qty' => $item->qty,
         'sub_total' => $item->total,
         'product_id' => $item->pro_id,
         'order_id' => $inserted_order,
         'created_at' => Carbon::now(),
         'updated_at' => Carbon::now(),
        ]);
        $idsToDelete[] = $item->id;
        }

        DB::table('cart')->whereIn('id', $idsToDelete)->delete();
        DB::commit();
      
        return view('web.paymentSuccess');
      } catch (\Throwable $th) {
         DB::rollBack();
         return $th->getMessage();
      }
   }

   public function error(){
      return view('web.paymentError');
   }

   public function voiceSearch(Request $request){
      $keyword = $request->keyword;
      // $keyword = "apple 6s"; // For testing purposes
      $keywords = explode(" ", $keyword);

      $query = DB::table('product')
         ->join('category', 'product.cat_id', '=', 'category.id')
         ->join(DB::raw('(SELECT product_id, MIN(name) AS name FROM product_images GROUP BY product_id) AS pi'), function($join) {
            $join->on('product.id', '=', 'pi.product_id');
         })
         ->select('product.*', 'pi.name as image_name','category.name')
         ->where('product.status', 1);

      foreach ($keywords as $key => $word) {
         // Convert both the keyword and the database field to lowercase
         $query->whereRaw('LOWER(product_title) LIKE ?', ['%' . strtolower($word) . '%']);
      }

      $products = $query->get();

      return view('web.voiceSearch', compact('products'));

   }

   public function imageSearch(Request $request){
      try {
      $api = 'UMIDKJCkmZBRmCmmbzTWB8JPq3wMbd1b';
    
      $client = new Client();

      $image = time().rand(1,1000).'.'.$request->image->extension();
      $request->image->move(public_path('search_images'),$image);
      
      //get all active products
      $candidateLabels = DB::table('product')
      ->where('status', 1)
      ->pluck('product_title')
      ->toArray();

      $imagePath = public_path('search_images') . '/' . $image; // Assuming $image contains the filename

      $imageFile = fopen($imagePath, 'r');
      if (!$imageFile) {
      throw new Exception("Failed to open image file: $imagePath");
      }

      // Prepare the request body
      $body = [
            [
                  'name' => 'image',
                  'contents' => fopen($imagePath, 'r'), // Read the image file
                 
            ],
            [
                  'name' => 'candidate_labels',
                  'contents' => json_encode($candidateLabels),
            ],
    
      ];
    
      // Prepare the request headers
      $headers = [
         'Authorization' => 'Bearer ' . $api,
      ];
      $response = $client->post('https://api.deepinfra.com/v1/inference/openai/clip-vit-base-patch32', [
         'headers' => $headers,
         'multipart' => $body,
     ]);
 
     // Handle the response
     $statusCode = $response->getStatusCode();
     $responseData = json_decode($response->getBody(), true);
     return redirect()->route('web.imageSearchResults',['title' => $responseData['results'][0]['label']]);
   //   dd($responseData['results'][0]['label']);
      } catch (\Throwable $th) {
        return $th->getMessage();
      }
     
   }

   public function imageSearchResults($title){

    $products = DB::table('product')
         ->join('category', 'product.cat_id', '=', 'category.id')
         ->join(DB::raw('(SELECT product_id, MIN(name) AS name FROM product_images GROUP BY product_id) AS pi'), function($join) {
            $join->on('product.id', '=', 'pi.product_id');
         })
         ->select('product.*', 'pi.name as image_name','category.name')
         ->where('product_title',$title)
         ->where('product.status', 1)
         ->get();
 

    return view('web.voiceSearch', compact('products'));
   }

   public function voice_command(Request $request){
   
      if (strpos($request->voice, 'home') !== false) {
         return redirect()->route('web.home');
     }
 
     if (strpos($request->voice, 'contact') !== false) {
         return redirect()->route('web.contact');
     }
     if (strpos($request->voice, 'login') !== false) {
      return redirect()->route('web.login');
      }
      if (strpos($request->voice, 'register') !== false) {
         return redirect()->route('web.register');
      }
      if (strpos($request->voice, 'products') !== false) {
         return redirect()->route('web.product.all');
      }

     return redirect()->back(); 
   }

   public function allProducts(){
      $products = DB::table('product')
      ->join('category', 'product.cat_id', '=', 'category.id')
      ->join(DB::raw('(SELECT product_id, MIN(name) AS name FROM product_images GROUP BY product_id) AS pi'), function($join) {
          $join->on('product.id', '=', 'pi.product_id');
      })
      ->select('product.*', 'pi.name as image_name','category.name')
      ->where('product.status',1)
      ->get();

      return view('web.all_products',compact('products'));
   }

   public function categorySpecified($id){
      $products = DB::table('product')
      ->join('category', 'product.cat_id', '=', 'category.id')
      ->join(DB::raw('(SELECT product_id, MIN(name) AS name FROM product_images GROUP BY product_id) AS pi'), function($join) {
         $join->on('product.id', '=', 'pi.product_id');
      })
      ->select('product.*', 'pi.name as image_name','category.name')
      ->where('product.cat_id', $id)
      ->where('product.status', 1)
      ->get();

      return view('web.categorySpecified',compact('products'));

   }

   public function order_moreDetails($id){
        $order = DB::table('orders')->find($id);
        $order_list =  DB::table('order_list')
        ->join('product', 'order_list.product_id', '=', 'product.id')
        ->select('order_list.*','product.product_title','product.product_price',)
        ->where('order_id',$id)->get();

        return view('web.orderDetails',compact('order','order_list'));
   }
}
