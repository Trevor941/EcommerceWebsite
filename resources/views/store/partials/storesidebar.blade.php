          
                    <!-- Side Bar Start -->
                    <div class="col-lg-4 sidebar">
                        <div class="sidebar-widget category">
                            <h2 class="title">Category</h2>
                            <nav class="navbar bg-light">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-female"></i>Fashion & Beauty</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-child"></i>Kids & Babies Clothes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-tshirt"></i>Men & Women Clothes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-mobile-alt"></i>Gadgets & Accessories</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-microchip"></i>Electronics & Accessories</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        
                        <div class="sidebar-widget widget-slider">
                            <div class="sidebar-slider normal-slider">
                              @foreach ($sliderproducts as $product)
                              <div class="product-item">
                                <div class="product-title">
                                    <a href="#">{{$product->name}}</a>
                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <div class="product-image">
                                    <a href="{{route('store.productdetail', $product->id)}}">
                                        <img src="{{asset('images/featuredimg/'.$product->featuredimage)}}" alt="Product Image">
                                    </a>
                                </div>
                                <div class="product-price">
                                    <h3><span>$</span>{{$product->regularprice}}</h3>
                                    <a class="btn" href="{{route('store.productdetail', $product->id)}}"><i class="fa fa-shopping-cart"></i>Buy</a>
                                </div>
                            </div>
                              @endforeach
                            </div>
                        </div>
                        
                        <div class="sidebar-widget tag">
                            <h2 class="title">Tags Cloud</h2>
                            @foreach ($alltags as $tag)
                            <a href="#">{{$tag->name}}</a>
                            @endforeach
                        </div>
                    </div>
                    <!-- Side Bar End -->