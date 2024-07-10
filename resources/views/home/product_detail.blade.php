<!DOCTYPE html>
<html>

<head>
  @include('home.css')
  <style>
    .div_center{
        display:flex;
        justify-content:center;
        align-items:center;
        padding:15px
    }
    .detail-box{
        padding:15px
    }
  </style>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
  </div>
  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      <div class="row">
        <div class="col-md-10">
          <div class="box">
              <div class="div_center">
                <img width="400px" src="../products/{{$product->image}}" alt="">
              </div>
              <div class="detail-box">
                <h6>
                  {{$product->title}}
                </h6>
                <h6>Price :<span>${{$product->price}}</span></h6>
              </div>
              <div class="detail-box">
                <h6>Category : {{$categoryName->category_name}}</h6>
                <h6>Avaliabe Quantity : <span>${{$product->quantity}}</span></h6>
              </div>
              <div class="detail-box">
                <span>{{$product->description}}</span>
              </div>
              <div class="detail-box">
                <a href="{{url('add_cart',$product->id)}}" class="btn btn-primary">Add to Cart</a>
              </div>
              <div class="new">
                <span>
                  New
                </span>
              </div>
             
          </div>
        </div>
      </div>
    </div>
  </section>

    @include('home.footer')

</body>

</html>