For Login/Registration using laravel Breeze :- 

    Laravel Breeze
    Laravel Breeze is a minimal, simple implementation of all of Laravel's authentication features, including login, registration, password reset, email verification, and password confirmation. In addition, Breeze includes a simple "profile" page where the user may update their name, email address, and password.
    1 :- composer require laravel/breeze --dev
    2 :- php artisan breeze:install
    3 :- php artisan migrate
    4 :- npm install
    5 :- npm run dev

Goto the database >> create_users_table.php file :- And add these fields
    $table->string('usertype')->default('user');
    $table->string('phone')->nullable();
    $table->string('address')->nullable();

Goto the app >> model >> user.php file :- And these fields that is created inside the database >> create_users_table.php file.
    'phone',
    'address',

Goto the command prompt and run this commands :- 
    1 :- php artisan migrate
    2 :- npm install
    3 :- npm run build

Goto the view >> auth >> register.blade.php :-
    Add the 'phone', 'address', fields.


Make a admin Authentication :-
    1 :- Create a HomeController.
    2 :- Add the route inside the web.php file 
        /* Get the Admin Dashboard */
        Route::get('admin/dashboard',[HomeController::class,'index']); 
    3 :- Goto the app >> controller > auth > AuthenticatedSessionController.php file and changes in side the store function.
        public function store(LoginRequest $request): RedirectResponse
        {
            $request->authenticate();

            $request->session()->regenerate();
            // Start Changes
            if($request->user()->usertype === 'admin'){
                return redirect('admin/dashboard');
            }
            return redirect()->intended(route('dashboard'));
            // End Changes
            //return redirect()->intended(route('dashboard', absolute: false));
        }
Goto to the view > layout > navigation.blade.php file and copy the code of logout and paste it into the admin/index file
   <!--  <form method="POST" action="{{ route('logout') }}">
                            @csrf
        <input type="submit" value="Logout">
    </form> -->

But the login system is not sequre at this time for first we need to write the code for authentication for admin.
    1 :- Make a middleware for admin :- Write this condition inside the function
        public function handle(Request $request, Closure $next): Response
        {   
            /* Start code */
            if(Auth::user()->usertype != 'admin'){
                return redirect('/');
            }
            /* End code */
            return $next($request);
        }
    2 :- Registered the middleware inside the bootstrap > app.php
        ->withMiddleware(function (Middleware $middleware) {
        //
            $middleware->alias(['admin' => \App\Http\Middleware\Admin::class]);
        })
    3 :- Goto the web.php and add the middleware inside the route.

03 :- How to intergrate the html teamplate in laravel.
    1 :- Make home folder inside the view and make a index.blade.php file.
    2 :- Web.php :- Route::get('/',[HomeController::class,'home']);
    3 :- HomeController.php :-  public function home(){
                                    return view('home.index');
                                }
    4 :- Copy all the html and paste into the index.blade.php file. And copy all the js/css/fonts folder and paste into to public folder.


Laravel alerts using laravel flasher :-
    PHPFlasher can handle a variety of notification types to suit different feedback scenarios:
    1 :-
        composer require php-flasher/flasher-toastr-laravel 
        php artisan flasher:install
        1. success : indicates successful completion of an action.
        2. info : provides informational messages to users.
        3. warning : alerts users to potential issues that are not errors.
        4. error : notifies users of errors or problems encountered.

    2 :- composer require php-flasher/flasher-toastr-symfony

    PHPFlasher offers a seamless way to incorporate flash notifications in  Symfony projects, enhancing user feedback with minimal setup.

Part :- 13 Pagination
1 :- Goto the folder provider > AppServiceProvider.php 
    Add this code :-    use Illuminate\Pagination\Paginator;
                        public function boot(): void
                        {
                            //
                            Paginator::useBootstrap();
                        }

Part :- 25 Cart functionality is used for get the data from deferent table using the foreign key
        Cart.php Model
            public function user(){
            return $this->hasOne('App\Models\User','id','user_id');
            }
            public function product(){
                return $this->hasOne('App\Models\Product','id','product_id');
            }
        mycart.blade.php :- To showing the data with cart.php model funcation name
            @foreach($cart as $cartData)
                <tr>
                    <td> {{$cartData->product->id}}</td>
                    <td> {{$cartData->product->title}}</td>
                    <td> {{$cartData->product->price}}</td>
                    <td> <img src="../products/{{$cartData->product->image}}" alt="" srcset=""></td>
                </tr>
            @endforeach

27 :- To get the data from product table using the id from orders table.
    Order.php model file.
    function user(){
        return $this->hasOne('App\Models\User','id','user_id');
    }
    function product(){
        return $this->hasOne('App\Models\Product','id','product_id');
    }

29 :- Laravel PDF libaray for download PDF
    composer require barryvdh/laravel-dompdf

32 :- Reset Password
    1. env file and change the MAIL_MAILER=log to MAIL_MAILER=smtp
        MAIL_MAILER=log
        MAIL_HOST=127.0.0.1
        MAIL_PORT=2525
        MAIL_USERNAME=null
        MAIL_PASSWORD=null
        MAIL_ENCRYPTION=null
        MAIL_FROM_ADDRESS="hello@example.com"
        MAIL_FROM_NAME="${APP_NAME}"

       Change to the 

        MAIL_MAILER=smtp
        MAIL_HOST=smtp.gmail.com
        MAIL_PORT=465
        MAIL_USERNAME=gurjeetappin@gmail.com
        MAIL_PASSWORD=null // Goto the gmail and setting 2step verification >> click next >> App Password >> App name :- add app name >> Generate password copy the password and past it here.
        MAIL_ENCRYPTION=ssl
        MAIL_FROM_ADDRESS="gurjeetappin@gmail.com"
        MAIL_FROM_NAME="Hello Mail" // You can add any name here

Part :- 33 Email verification
        Model >> user.php :- Remove the comment from MustVerifyMail 
        Add this code with class :- class User extends Authenticatable implements MustVerifyEmail
Part :- 34 Stripe payment method integration.
        Make column inside the orders table :- 
        php artisan make:migration add_payment_status_to_orders_table --table=orders

        Migration >> payment_status

             public function up(): void
            {
                Schema::table('orders', function (Blueprint $table) {
                    //
                    $table->string('payment_status')->after('product_id')->default('cash on delivery');
                });
            }

            /**
            * Reverse the migrations.
            */
            public function down(): void
            {
                Schema::table('orders', function (Blueprint $table) {
                    //
                    $table->dropColumn('payment_status');
                });
            }

            2 :- Add the stripe extension >> composer require stripe/stripe-php
            3 :-    .env
                    STRIPE_KEY=pk_test_reFxwbsm9cdCKASdTfxAR
                    STRIPE_SECRET=sk_test_oQMFWteJiPd4wj4AtgApY

            4 :- HomeController.php

                public function stripe()
                {
                    return view('stripe');
                }
                public function stripePost(Request $request)
                {
                    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                
                    Stripe\Charge::create ([
                            "amount" => 100 * 100,
                            "currency" => "usd",
                            "source" => $request->stripeToken,
                            "description" => "Test payment from itsolutionstuff.com." 
                    ]);
                
                    Session::flash('success', 'Payment successful!');
                        
                    return back();
                }

Part :- 37 Generate Slug
        1. Install extension :- cviebrock is used for generate the slug.
                             composer require cviebrock\eloquent-sluggable
        2. Goto the command prompt and create a new column 'slug' in the table.
            2.1 :- Create a migration :- php artisan make:migration add_slug_column_to_products_table
            2.2 :- Model >> product.php write this code
                    /* For slug */
                    use Cviebrock\EloquentSluggable\Sluggable;
                    class Product extends Model
                    {
                        use HasFactory;
                        /* For slug */
                        use Sluggable;
                        public function Sluggable():array{
                            return  [
                                        'slug' => [
                                            'source' => 'title'
                                        ]
                                    ];
                        }
                    }
            2.3 :- Goto the view page and update the data accroding to slug. Add the column 'slug' for update :- $product->slug
            2.4 :- Goto the web.php add the 'slug' column name inside the update route.
            2.5 :- Goto the controller and change the code of update.
                    /* public function update_product($id) */
                    public function update_product($slug){
                        //$data = Product::find($id);
                        $data = Product::where('slug', $slug)->get()->first();
                        $categoryData = Category::all();
                        return view('admin.update_product',['product' => $data, 'categories' => $categoryData]);

                    }
