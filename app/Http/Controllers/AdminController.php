<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/* Model */
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;

/* Generate the PDF */
use Barryvdh\DomPDF\Facade\Pdf;


class AdminController extends Controller
{
    //
    public function view_category(){
        $data =  Category::all(); // Get all data from database table
       /*  return view('admin.category', compact('data')); */ // This is another way to show the data into the table
        return view('admin.category', ['data' => $data]);
    }

    public function add_category(Request $request){
        $category = new Category;
        $category->category_name = $request->category;
        // Save the data into the database
        $category->save();
        toastr()->closeButton()->timeOut(5000)->success('Category Add Successfully.');
        // Return to the same page using back() function
        return redirect()->back();
    }

    /* Delete Data */
    public function delete_category($id){
        //echo "Deleted"; die();
        $data = Category::find($id);
       /*  echo "<pre>";
        print_r($data); */
        $data->delete();
        toastr()->closeButton()->timeOut(5000)->warning("Category Deleted Successfully.");
        return redirect()->back();

    }

    /* Edit category */
    public function edit_category($id){
        $data = Category::find($id);
        return view('admin.edit_category', ["data" => $data]);
    }

    public function update_category(Request $request, $id){
        $data = Category::find($id);
        $data->category_name = $request->category;
        $data->save();
        toastr()->closeButton()->timeOut(5000)->success("Category update successfully.");
        return redirect('/view_category');
    }

    public function add_product(){
        $categoryData = Category::all();
        return view('admin.add_product', ['category' => $categoryData]);
    }

    public function upload_product(Request $request){
        $productData = new Product;
        $productData->title = $request->title;
        $productData->description = $request->description;
        
        $productData->price = $request->price;
        $productData->category = $request->category;
        $productData->quantity = $request->quantity;
        $image = $request->image;
        if($image){
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('products',$imageName);
            $productData->image = $imageName;
        }
        $productData->save();
        toastr()->closeButton()->timeOut(5000)->success("Product add successfully");
        return redirect()->back();
    }

    public function view_product(){
        //$productList = Product::all();
        /* Create Pagination */
        $productList = Product::paginate(3);
        $categoryData = Category::all();
        return view('admin.view_product', ["productList" => $productList, 'categories' => $categoryData]);
    }

    public function delete_product($id){
        $data = Product::find($id);
        /* Delete the image from folder */
        $image_path = public_path('products/'.$data->image);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $data->delete();
        toastr()->closeButton()->timeOut(5000)->success("Product Deleted successfully");
        return redirect()->back();
    }
    /* public function update_product($id) */
    public function update_product($slug){
        //$data = Product::find($id);
        $data = Product::where('slug', $slug)->get()->first();
        $categoryData = Category::all();
        return view('admin.update_product',['product' => $data, 'categories' => $categoryData]);

    }

    public function edit_product(Request $request, $id){
        $data = Product::find($id);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->category = $request->category;
        $data->quantity = $request->quantity;
       
        $image = $request->image;
        if($image){
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('products',$imageName);
            $data->image = $imageName;
        }
        $data->save();
        toastr()->closeButton()->timeOut(5000)->success("Product Updated successfully.");
        return redirect('/view_product');
    }

    public function product_serach(Request $request){
        $search = $request->search;
        $categoryData = Category::all();
        $categoryName = $categoryId = '';
        foreach($categoryData as $cate){
            if($cate->category_name === $search){
                $categoryName =$cate->category_name;
                $categoryId =$cate->id;
            }
        }
        /* Category Search functionality is pending */
        /* $productList = Product::where('title','LIKE','%'.$search)->orWhere('category','LIKE','%',$categoryId)->paginate(3); */
        $productList = Product::where('title','LIKE','%'.$search)->paginate(3);
        return view('admin.view_product', ['productList' =>  $productList, 'categories' => $categoryData]);
    }

    public function view_orders(){
        $data = Order::all();
        return view('admin.order',['data' => $data]);
    }

    public function onTheWay($id){
        $data = Order::find($id);
        $data->status = "On the way";
        $data->save();
        toastr()->closeButton()->timeOut(5000)->success("Status change successfully.");
        return redirect('view_orders');
    }

    public function delivered($id){
        $data = Order::find($id);
        $data->status = 'Delivered';
        $data->save();
        toastr()->closeButton()->timeOut(5000)->success("Status delivered");
        return redirect('view_orders');
    }

    public function print_pdf($id){
    $data = Order::find($id);
    $pdf = Pdf::loadView('admin.invoice', ['data' => $data]);
    return $pdf->download('invoice.pdf');
    }
}
