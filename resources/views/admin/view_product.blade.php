<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style>
        input[type='text']{
            width: 400px;
            height: 50px
        }
        .serachFrm{
            width: 400px;
            height: 42px;
            margin-bottom: 3%;
        }
        .div_design{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .div_deg{
            display : flex;
            justify-content : center;
            align-items : center;
            margin-top : 60px;
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
                    <div class="table-responsive"> 
                        <form action="{{url('product_serach')}}" method="get">
                            @csrf
                            <input type="search" name="search" class="serachFrm" id="">
                            <input type="submit" class="btn btn-success" value="Search">
                        </form>
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($productList as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->title}}</td>
                            <!-- <td>{{$product->description}}</td> -->
                            <!--    Show the short description with 
                                    1 :- {!!Str::limit($product->description, 50)!!} 
                                    2 :- {!!Str::words($product->description, 50)!!}
                            -->
                            <td>{!!Str::limit($product->description, 20)!!}</td>
                            <td><img src="products/{{$product->image}}" alt="" height="50" width="50"></td>
                            <td>{{$product->price}}</td>
                            <td>
                                @foreach($categories as $category)
                                    @if($category->id == $product->category) 
                                        {{ $category->category_name }} 
                                    @endif 
                                @endforeach</td>
                            <td>{{$product->quantity}}</td>
                            <td>
                            <!-- Edit Data -->
                            <a class="btn btn-success" href="{{url('update_product',$product->slug)}}">Edit</a>
                            <!-- Deleted Data -->
                            <a class="btn btn-danger" href="{{url('delete_product',$product->id)}}" onclick="confirmation(event)" id="delete">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                    <div class="div_deg">{{$productList->onEachSide(1)->links()}}</div>
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
                title : 'Are sure you want to delete this!',
                text : 'This delete will be parmanent',
                icon : "warning",
                buttons : true,
                dangerMode : true,
            }).then((cancel) => {
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