<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style>
        .div_deg{
            display: flex;
            justify-content : center;
            align-item : center;
            margin : 60px;
        }
        input[type='text']{
            width: 400px;
            height : 40px;
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
            <!-- {{print_r($data)}} -->
            <h1>Update Category</h1>
            <div class="div_deg">
                
                <form action='{{url("update_category",$data->id)}}'  method="post">
                    @csrf
                    <input type="text" name="category" value="{{$data->category_name}}" id="">
                    <input type="submit" name="submit" class="btn btn-primary" value="Update" id="update_btn">
                </form>
            </div>
          </div>
        </div>
        
        <!-- Start Footer -->
         @include('admin.footer')
        <!-- End Footer -->
         <script>
            /* function updateCategory(event){
                event.preventDefault();
                swal({
                    title : "Do want to Update category",
                    text : "Category updated.",
                    buttons : true,
                    successMode : true,
                });
            } */

            $("update_btn").on('click', function(){
                event.preventDefault();
                swal({
                    title : "Do want to Update category",
                    text : "Category updated.",
                    buttons : true,
                    successMode : true,
                });
            })
         </script>
     
  </body>
</html>