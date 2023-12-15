<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Items;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class AllUserController extends Controller
{
    public function UserAccount(){
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.userdashboard.account_details',compact('userData'));

    } // End Method 


    public function UserChangePassword(){
         return view('frontend.userdashboard.user_change_password' );
    } // End Method 


    public function UserOrderPage(){
        $id = Auth::user()->id;
        $orders = Order::where('user_id',$id)->orderBy('id','DESC')->get();
          return view('frontend.userdashboard.user_order_page',compact('orders'));
    }// End Method 
    
    public function UserItems(){
        $id = Auth::user()->id;
        $items = Items::latest()->get();
         return view('frontend.userdashboard.user_items',compact('items'));
    }

    public function UserCart(){
       //will be added
       return view('frontend.userdashboard.user_cart');
    }


    public function AddToCartDetailsItem(Request $request, $id)
    {
        try {
            // Validate the input
            // $request->validate([
            //     'selected_items' => 'required|array',
            //     'selected_items.*' => 'exists:items,id', // Assuming your items are in a table named "items"
            // ]);
    
            // Perform your logic for each selected item
            //foreach ($request->selected_items as $id) {
                $product = Items::findOrFail($id);
    
                Cart::add([
                    'id' => $id,
                    'name' => $product->item_name, // Update to use the item name from the database
                    'qty' => 1,
                    'price' => $product->parent_category,
                    'weight' => 1,
                    'options' => [
                        'company_name' => $product->company_name, // Update to use the company name from the database
                    ],
                ]);
            //}
    
            return response()->json(['success' => 'Successfully Added on Your Cart']);
        } catch (\Exception $e) {
            \Log::error('AddToCartDetailsItem Error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to add item(s) to cart'], 500);
        }
    }
    
    public function AddMiniCart(){

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,  
            'cartTotal' => $cartTotal

        ));
    }// End Method

    public function RemoveMiniCart($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Remove From Cart']);

    }// End Method


    public function MyCart(){

        return view('frontend.mycart.view_mycart');

    }// End Method
    
    

    public function UserOrderDetails($order_id){

        $order = Order::with('division','district','state','user')->where('id',$order_id)->where('user_id',Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        return view('frontend.order.order_details',compact('order','orderItem'));

    }// End Method 


    public function UserOrderInvoice($order_id){

        $order = Order::with('division','district','state','user')->where('id',$order_id)->where('user_id',Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        $pdf = Pdf::loadView('frontend.order.order_invoice', compact('order','orderItem'))->setPaper('a4')->setOption([
                'tempDir' => public_path(),
                'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');

    }// End Method 



    public function ReturnOrder(Request $request,$order_id){

        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,
            'return_order' => 1, 
        ]);

        $notification = array(
            'message' => 'Return Request Send Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('user.order.page')->with($notification); 

    }// End Method 


    public function ReturnOrderPage(){

        $orders = Order::where('user_id',Auth::id())->where('return_reason','!=',NULL)->orderBy('id','DESC')->get();
        return view('frontend.order.return_order_view',compact('orders'));

    }// End Method 


    public function UserTrackOrder(){
        return view('frontend.userdashboard.user_track_order');
    }// End Method 

    public function OrderTracking(Request $request){

        $invoice = $request->code;

        $track = Order::where('invoice_no',$invoice)->first();

        if ($track) {
           return view('frontend.traking.track_order',compact('track'));

        } else{

            $notification = array(
            'message' => 'Invoice Code Is Invalid',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification); 

        }

    }// End Method 

}
 