<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style>
        input[type='text']{
            width: 400px;
            height: 50px
        }
        .div_design{
            display: flex;
            justify-content: center;
            align-items: center;
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
            <h1 style='color: white;'>Add Category</h1>
            <!-- Start Category -->
                <div class="div_design">
                    <form action="{{url('add_category')}}" method="post">
                        @csrf
                            <div>
                                <input type="text" name="category" id="">
                                <input type="submit" name="add_category" class="btn btn-primary" value="Add Category" id="">
                            </div>
                        </form>
                </div>
            <!-- End Category -->
             <!-- Start List Categrories -->
              <section>
                <!-- {{print_r($data)}} -->
                  <div class="col-lg-12">
                    <div class="block">
                      <div class="title"><strong>Categories</strong></div>
                      <div class="table-responsive"> 
                        <table class="table table-striped table-hover">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Category Name</th>
                              <th>Created At</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $categroyData)
                            <tr>
                              <td>{{$categroyData->id}}</td>
                              <td>{{$categroyData->category_name}}</td>
                              <td>{{$categroyData->created_at}}</td>
                              <td>
                              <!-- Edit Data -->
                              <a class="btn btn-success" href="{{url('edit_category',$categroyData->id)}}">Edit</a>
                              <!-- Deleted Data -->
                                <a class="btn btn-danger" href="{{url('delete_category',$categroyData->id)}}" onclick="confirmation(event)">Delete</a>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
              </section>
             <!-- End List Categrories -->
          </div>
        </div>
       
        <!-- Start Footer -->
        <script>
          function confirmation(event){
            event.preventDefault();
            //alert("deleted");
            var urlToRedirect = event.currentTarget.getAttribute('href'); // Get the current url for target.
            console.log(urlToRedirect);
            // Use the sweet Alert
            swal({
              title : "Are you sure to delete Category",
              text : "This delete will be parmanent",
              icon : "warning",
              buttons : true,
              dangerMode : true,
            }).then((willCancel)=>{
              if(willCancel){
                window.location.href = urlToRedirect; 
              }
            })
          }
        </script>
         @include('admin.footer')
        <!-- End Footer -->
    
  </body>
</html>