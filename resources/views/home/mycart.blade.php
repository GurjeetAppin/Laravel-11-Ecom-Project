<!DOCTYPE html>
<html>

<head>
  @include('home.css')
  <style>
    .cart-box .table thead th {
        background-color: #000;
        color: #fff;
    }
    .order_deg{
        margin-top:10%;
    }
    label{
        display : inline-block;
        width: 130px;
    }
   
  </style>
</head>
<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
    </div>
    <div class="container">
        <div class="row">
        
        <div class="col-md-7">
          <div class="box cart-box">
           
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Remove</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $value = 0; ?>
                    @foreach($cart as $cartData)
                        <tr>
                            <td>{{$cartData->product->id}}</td>
                            <td>{{$cartData->product->title}}</td>
                            <td>{{$cartData->product->price}}</td>
                            <td><img src="../products/{{$cartData->product->image}}" alt="" srcset="" width="100px" height="100px"></td>
                            <td><a href="" class="btn btn-danger">Remove</a></td>
                        </tr>
                        <?php
                            $value = $value + $cartData->product->price;                           
                        ?>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <h3>Total value of Cart is : ${{$value}}</h3>
            </div>
        </div>
        <div class="col-md-4">
        <div class="order_deg">
                <form action="{{url('confirm_order')}}" method="post">
                    @csrf
                    <div class="div_gap">
                        <label for="">Receiver Name</label>
                        <input type="text" name="name" id="" value="{{Auth::user()->name}}">
                    </div>
                    <div class="div_gap">
                        <label for="">Receiver Address</label>
                        <textarea name="address" id="" cols="22" rows="10">{{Auth::user()->address}}</textarea>
                    </div>
                    <div class="div_gap">
                        <label for="">Receiver Phone</label>
                        <input type="text" name="phone" id="" value="{{Auth::user()->phone}}">
                    </div>
                    <div>
                        
                        <input type="submit" name="" class="btn btn-primary" value="Cash on Delivery" id="">
                        <a class="btn btn-success" href="{{url('stripe',$value)}}">Pay using Card</a>
                    </div>
                </form>
            </div>
        </div>
        </div>
       
    </div>
    
    @include('home.footer')
</body>
</html>