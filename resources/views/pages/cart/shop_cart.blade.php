@extends('components.layout')
@section('content')
@extends('components.alert')


<section class="h-100 h-custom" style="background-color: #59AB6E;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="d-flex justify-content-between align-items-center mb-5">
                                        <h1 class="fw-bold mb-0 text-black">Zay Shopping Cart</h1>
                                        <h6 class="mb-0 text-muted">{{count(Cart::content())}} products</h6>
                                    </div>
                                    <?php
                                    $content = Cart::content();
                                    ?>
                                    @if(count(Cart::content()) == 0)
                                    <h2>Your cart is empty!</h2>
                                    @else
                                    @foreach($content as $value)
                                    <hr class="my-4">
                                    @if($value->options->in_stock < $value->qty)
                                    <div class="alert alert-danger">Product in stock is not enough!! Please order less or pick another</div>
                                    @endif
                                    <div class="row mb-4 d-flex justify-content-between align-items-center {{$value->options->in_stock < $value->qty ? 'bg-danger' : ''}}">
                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img src="{{URL::to('/public/upload/product/'.$value->options->image)}}" class="img-fluid rounded-3" alt="Cotton T-shirt">
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <h6 class="text-black mb-0">{{$value->name}}</h6>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-2">
                                            <form action="{{URL::to('/update-cart')}}" method="POST">
                                                @csrf
                                                <input min="1" name="cart_quantity" value="{{$value->qty}}" type="number" class="form-control form-control-sm" />
                                                <input type="hidden" value="{{$value->rowId}}" name="rowId_cart">
                                                <button type="submit" value="Update" name="update_qty" class="btn btn-success"><i class="fa-solid fa-circle-check"></i></button>
                                            </form>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3 offset-lg-1">
                                            <h6 class="mb-0">
                                                <?php
                                                $subtotal = $value->price * $value->qty;
                                                echo number_format($subtotal, 0, ',', '.') . ' ' . 'đ';
                                                ?>
                                            </h6>
                                        </div>
                                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                            <a href="{{URL::to('/delete-cart/'.$value->rowId)}}" class="text-muted"><i class="fas fa-times"></i></a>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-4 bg-grey">
                                <div class="p-5">
                                    <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                                    <hr class="my-4">

                                    <div class="d-flex justify-content-between mb-4">
                                        <h5 class="text-uppercase">products {{count(Cart::content())}}</h5>
                                        <h5>{{Cart::pricetotal(0 , ',' , '.').' '.'VNĐ'}}</h5>
                                    </div>
                                    <div class="d-flex justify-content-between mb-4">
                                        <h5 class="text-uppercase">Taxes</h5>
                                        <h5>{{Cart::tax(0 , ',' , '.').' '.'VNĐ'}}</h5>
                                    </div>
                                    @if(Session::get('coupon'))
                                    @foreach(Session::get('coupon') as $key => $cou)
                                    @if($cou['coupon_condition']==1)
                                    <?php
                                    Cart::setGlobalDiscount($cou['coupon_number']);
                                    ?>
                                    @endif
                                    @endforeach
                                    @endif


                                    @if(Session::get('coupon'))
                                    @foreach(Session::get('coupon') as $key => $cou)
                                    @if($cou['coupon_condition']==1)
                                    <div class="d-flex justify-content-between mb-4">
                                        <h5 class="text-uppercase">Discount<span class="text-muted"><?php echo '( -' . $cou['coupon_number'] . '%)' ?></span></h5>
                                        <h5>{{Cart::discount(0 , ',' , '.').' '.'VNĐ'}}</h5>
                                    </div>
                                    @endif
                                    @endforeach
                                    @else
                                    <div class="d-flex justify-content-between mb-4">
                                        <h5 class="text-uppercase">Discount</h5>
                                        <h5>{{Cart::discount(0 , ',' , '.').' '.'VNĐ'}}</h5>
                                    </div>
                                    @endif

                                    <!-- <h5 class="text-uppercase mb-3">Shipping</h5>

                                    <div class="mb-4 pb-2">
                                        <select class="form-control">
                                            <option value="1">Standard-Delivery- €5.00</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                            <option value="4">Four</option>
                                        </select>
                                    </div> -->

                                    <h5 class="text-uppercase mb-3">Give code</h5>

                                    <form class="card p-2" method="POST" action="{{URL::to('/check-coupon')}}">
                                        @csrf
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="coupon" placeholder="Promo code">
                                            @if(Session::get('coupon') == null)
                                            <button type="submit" class="btn btn-danger check_coupon" name="check_coupon">Add code</button>
                                            @else
                                            <button disabled type="submit" class="btn btn-dark check_coupon" name="check_coupon">Add code</button>
                                            @endif
                                        </div>
                                    </form>

                                    <hr class="my-4">

                                    <div class="d-flex justify-content-between mb-5">
                                        <h5 class="text-uppercase">Total price</h5>
                                        <h5>{{Cart::total(0 , ',' , '.').' '.'VNĐ'}}</h5>
                                    </div>
                                    @if(Session::get('account_id') != null)
                                    <a href="{{URL::to('/check-out')}}" type="button" class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark">Checkout</a>
                                    @else
                                    <a href="{{URL::to('/login')}}" type="button" class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark">Checkout</a>
                                    @endif
                                    @if(Session::get('coupon') != null)
                                    <a style="margin-left: 50px;" href="{{URL::to('/unset-coupon')}}" type="button" class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark">Unset coupon</a>
                                    @endif
                                </div>
                            </div>
                            @endif
                            <h6 class="mb-0"><a href="{{URL::to('/shop')}}" class="btn btn-outline-success"><i class="fas fa-long-arrow-alt-left me-2"></i>Shopping more</a></h6>
                            <hr class="my-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection