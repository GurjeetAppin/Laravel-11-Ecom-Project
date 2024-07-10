<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
   
            <style>
        .div_deg{
            display : flex;
            justify-content : center;
            align-items : center;
            margin-top : 60px;
        }
        h1{
            color : white;
        }
        label{
            width: 200px;
            display : inline-block;
            font-size : 18px !important;
            color : white !important;
        }
        
   
    </style>
  </head>
  <body>
    <header class="header">   
     @include('admin.header')
    </header>
    <div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Product List</h2>
          </div>
        </div>
        <section>
            <div class="col-lg-12">
                <div class="block">
                   <div class="div_deg">
                    <form action="{{url('edit_product',$product->id)}}" method="post" enctype="multipart/form-data" onclick="confirmation(event)">
                        @csrf
                        <div class="">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="{{$product->title}}" id="">
                        </div>
                        <div class="">
                            <label for="description">Description</label>
                            <textarea name="description" id="" cols="30" rows="5">{{$product->description}}</textarea>
                         </div>
                         <div class="">
                            <label for="">Current Image</label>
                            <img src="../products/{{$product->image}}" alt="" height="50" width="50">
                        </div>
                        <div class="">
                            <label for="">Image</label>
                            <input type="file" name="image" id="">
                        </div>
                        <div class="">
                            <label for="">Price</label>
                            <input type="text" name="price" value="{{$product->price}}" id="">
                        </div>
                        <div class="">
                        <label for="">Category</label>
                            <select name="category" id="">
                                @foreach($categories as $category)
                                    @if($category->id == $product->category)
                                        <option value="{{$category->id}}" selected>{{$category->category_name}}</option>
                                    @else
                                        <option value="{{$category->id}}" >{{$category->category_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="">
                            <label for="">Quantity</label>
                            <input type="text" name="quantity" value="{{$product->quantity}}" id="">
                        </div>
                        <div class="">
                        <label for=""></label>
                            <input type="submit" class="btn btn-success" value="Update Product" >
                        </div>
                    </form>
                   </div>
                </div>
            </div>
        </section>
    </div>
        <script>
            function confirmation(event){
                event.preventDefault();
                var urlToRedirect = event.currentTarget.getAttribute('href');
                console.log(urlToRedirect);
                swal({
                    title : 'Are you want to Update the product',
                    text : 'The product Updated',
                    icon : 'warning',
                    button : true,
                    dangerMode : true
                }).then((cancel){
                    if(cancel){
                        window.location.href = urlToRedirect;
                    }
                });
            }
        </script>
    
        <!-- Start Footer -->
        @include('admin.footer')
    <!-- End Footer -->
  </body>
</html>