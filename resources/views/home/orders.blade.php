<!DOCTYPE html>
<html>
<head>
  @include('home.css')
</head>
<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
  </div>
  <!-- end hero area -->
  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Orders Details
        </h2>
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Id</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Delivery Status</th>
                <th>Image</th>
            </tr>
            </thead>
            <tbody>
                @foreach($order as $orders)
                <tr>
                    <td>{{$orders->id}}</td>
                    <td>{{$orders->product->title}}</td>
                    <td>{{$orders->product->price}}</td>
                    <td>{{$orders->status}}</td>
                    <td><img src="products/{{$orders->product->image}}" width="50px" height="50px" alt="" srcset=""></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    </div>
</section>
  <!-- info section -->
    @include('home.footer')
</body>
</html>