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
                    <h2 class="h5 no-margin-bottom">Add Product</h2>
                </div>
            </div>
            <section>
                <div class="col-lg-12">
                    <div class="block">
                        <div class="div_deg">
                            <!-- {{print_r($category)}} -->
                            <form action="{{url('upload_product')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="">
                                    <label for="">Product Title</label>
                                    <input type="text" class="" name="title" id="">
                                </div>
                                <div class="">
                                    <label for="">Description</label>
                                    <textarea name="description" id="" cols="30" rows="5"></textarea>
                                </div>
                                <div class="">
                                    <label for="">Image</label>
                                    <input type="file" name="image" id="">
                                </div>
                                <div class="">
                                    <label for="">Price</label>
                                    <input type="text" name="price" id="">
                                </div>
                                <div class="">
                                    <label for="">Category</label>
                                    <select name="category" id="">
                                        @foreach($category as $cateData)
                                            <option value="{{$cateData->id}}">{{$cateData->category_name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="">
                                    <label for="">Quantity</label>
                                    <input type="text" name="quantity" id="">
                                </div>
                                <div class="">
                                <label for=""></label>
                                    <input type="submit" class="btn btn-success" value="Add Product">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- Start Footer -->
         @include('admin.footer')
        <!-- End Footer -->
     
  </body>
</html>