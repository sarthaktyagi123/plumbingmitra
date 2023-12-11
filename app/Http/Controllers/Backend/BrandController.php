<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Items;
use App\Models\Item;
use App\Models\Product;
use App\Models\User;
use Image;

class BrandController extends Controller
{
    public function AllBrand(){
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_all',compact('brands'));
    } // End Method 


    public function AddBrand(){
         return view('backend.brand.brand_add');
    } // End Method 


    //item methods
    public function ItemList(){
        $items = Item::latest()->get();
        return view('backend.brand.item_list',compact('items'));
    }

    public function ItemListForShops(){
        $items = Item::latest()->get();
        return view('frontend.home.home_new_product',compact('items'));
    }

    public function ItemAdd(){
        return view('backend.brand.item_add');
    }

    public function StoreItem(Request $request){

        Items::insert([
            'item_name' => $request->item_name,
            'item_slug' => strtolower(str_replace(' ', '-', $request->item_name)),
            'company_name' => $request->company_name,
            'parent_category' => $request->parent_category,
            'other_specialty' => $request->other_specialty ,
            
        ]);
        

       $notification = array(
            'message' => 'Item Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('item.list')->with($notification); 

    }

    public function EditItem($id){
        $items = Item::findOrFail($id);
        return view('backend.brand.item_edit',compact('items'));
    }

    public function UpdateItem(Request $request){

        $item_id = $request->id;
        

         

            Items::findOrFail($item_id)->update([
                'item_name' => $request->item_name,
                'item_slug' => strtolower(str_replace(' ', '-', $request->item_name)),
                'company_name' => $request->company_name,
                'parent_category' => $request->parent_category,
                'other_specialty' => $request->other_specialty ?? 'default_value',
                
            ]);
            
    
           $notification = array(
                'message' => 'Item Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('item.list')->with($notification); 
     

        

    }// End Method 


    //end method


    public function StoreBrand(Request $request){

        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
        $save_url = 'upload/brand/'.$name_gen;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-',$request->brand_name)),
            'brand_image' => $save_url, 
        ]);

       $notification = array(
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.brand')->with($notification); 

    }// End Method 


    public function EditBrand($id){
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit',compact('brand'));
    }// End Method 

    



    public function UpdateBrand(Request $request){

        $brand_id = $request->id;       
       

        Brand::findOrFail($brand_id)->update([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-',$request->brand_name)),
             
        ]);

       $notification = array(
            'message' => 'Company name Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.brand')->with($notification); 

        


    }
    
    public function DeleteItem($id){

        $items = Items::findOrFail($id);
        
         

        Items::findOrFail($id)->delete();

        $notification = array(
            'message' => 'item Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }// End Method 
    
    // End Method 


    public function DeleteBrand($id){

        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;
        unlink($img ); 

        Brand::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }// End Method 
 

}
 