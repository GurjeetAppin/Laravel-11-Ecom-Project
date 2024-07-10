<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
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
            <h2 class="h5 no-margin-bottom">All Orders</h2>
          </div>
        </div>
         <!-- Start List Categrories -->
         <section>
                <!-- {{print_r($data)}} -->
                  <div class="col-lg-12">
                    <div class="block">
                      <div class="title"><strong></strong></div>
                      <div class="table-responsive"> 
                        <table class="table table-striped table-hover table-sm">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Customer Name</th>
                              <th>Address</th>
                              <th>Phone</th>
                              <th>Product title</th>
                              <th>Price</th>
                              <th>Image</th>
                              <th>Payment Status</th>
                              <th>Status</th>
                              <th>Change Status</th>
                              <th>Print PDF</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $orderData)
                            <tr>
                              <td>{{$orderData->id}}</td>
                              <td>{{$orderData->name}}</td>
                              <td>{{$orderData->rec_address}}</td>
                              <td>{{$orderData->phone}}</td>
                              <td>{{$orderData->product->title}}</td>
                              <td>{{$orderData->product->price}}</td>
                              <td><img src="products/{{$orderData->product->image}}" width="50px" height="50px" alt=""></td>
                              <td>{{$orderData->payment_status}}</td>
                              <td>
                                    @if($orderData->status == 'in progress')
                                        <span style="color:red">{{$orderData->status}}</span>
                                    @elseif($orderData->status == 'On the way')
                                        <span style="color:skyblue">{{$orderData->status}}</span>
                                    @else
                                        <span style="color:yellow">{{$orderData->status}}</span>
                                    @endif

                              </td>
                             
                              <td>
                              <a class="btn btn-primary statusChange" href="{{url('onTheWay',$orderData->id)}}" >On the way</a>
                              <a class="btn btn-success" href="{{url('delivered',$orderData->id)}}">Deleverd</a>
                              </td>
                              <td>
                                <a href="{{url('print_pdf',$orderData->id)}}" class="btn btn-secondary">Print PDF</a>
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
        
        <!-- Start Footer -->
         
         @include('admin.footer')
         
        <!-- End Footer -->
     
  </body>
</html>