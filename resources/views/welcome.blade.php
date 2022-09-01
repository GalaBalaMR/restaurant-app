<x-guest-layout>


        <!-- ======= About Section ======= -->
        <section id="about" class="about">
          <div class="container-fluid">
    
            <div class="row">
    
              <div class="col-lg-5 align-items-stretch video-box" style='background-image: url("{{ Storage::url('img/about.jpg') }}");'>
                <a href="" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true"></a>
              </div>
    
              <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch">
    
                <div class="content">
                  <div class="About_nadpis">
                    {!!  $contents->where('name', 'About_nadpis')->first()->content  !!}
                  </div>

                  @hasanyrole('Manager|Admin')
                    @include('content.partials.form', ['content' => $contents->where('name', 'About_nadpis')->first()])
                  @endhasanyrole

                  <div class="About_p">
                    {!!  $contents->where('name', 'About_p')->first()->content  !!}
                  </div>
                  
                  @hasanyrole('Manager|Admin')
                    @include('content.partials.form', ['content' => $contents->where('name', 'About_p')->first()])
                  @endhasanyrole
                  
                  {!!  $contents->where('name', 'About_ul')->first()->content  !!}

                  @hasanyrole('Manager|Admin')
                    @include('content.partials.form', ['content' => $contents->where('name', 'About_ul')->first()])
                  @endhasanyrole
                  
                  <p>
                    Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                    velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                    culpa qui officia deserunt mollit anim id est laborum
                  </p>
                </div>
    
              </div>
    
            </div>
    
          </div>
        </section><!-- End About Section -->
    
        <!-- ======= Whu Us Section ======= -->
        <section id="why-us" class="why-us">
          <div class="container">
    
            <div class="section-title">
              <h2>Prečo si vybrať <span>Našu Reštauráciu?</span></h2>
              <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
            </div>
    
            <div class="row">
    
              <div class="col-lg-4">
                <div class="box">
                  <span>01</span>
                  <h4>Lorem Ipsum</h4>
                  <p>Ulamco laboris nisi ut aliquip ex ea commodo consequat. Et consectetur ducimus vero placeat</p>
                </div>
              </div>
    
              <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="box">
                  <span>02</span>
                  <h4>Repellat Nihil</h4>
                  <p>Dolorem est fugiat occaecati voluptate velit esse. Dicta veritatis dolor quod et vel dire leno para dest</p>
                </div>
              </div>
    
              <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="box">
                  <span>03</span>
                  <h4> Ad ad velit qui</h4>
                  <p>Molestiae officiis omnis illo asperiores. Aut doloribus vitae sunt debitis quo vel nam quis</p>
                </div>
              </div>
    
            </div>
    
          </div>
        </section><!-- End Whu Us Section -->
    
        <!-- ======= Menu Section ======= -->
        <section id="menu" class="menu">

            <div class="container">
      
              <div class="section-title">
                <h2>Pozri si naše <span>Menu</span></h2>
              </div>
      
              <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">
                  <ul id="menu-flters">
                    <li data-filter="*" class="filter-active">Show All</li>
                    @foreach($categories as $category)
                    <li data-filter=".filter-{{ $category->id }}">{{ $category->name }}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
      
              <div class="row menu-container">
                
                @foreach($categories as $category)
                    @foreach($category->menus as $menu)
                    <div class="col-lg-6 menu-item filter-{{ $category->id }}">
                        <div class="menu-content">
                            <a>{{ $menu->name }}</a>
                        </div>
                        <div class="menu-ingredients">
                            {{ $menu->description }}
                        </div>
                        <img src="{{ Storage::url($menu->image) }}" class="img-thumbnail" alt="..." style="height: 100px; width: 150px;">
                    </div>
                    @endforeach
                @endforeach
      
              </div>

              {{-- Search in menu --}}
              <h2 class="text-center m-3">Vyhľadať v menu</h2>

              @if (session()->has('search'))
                <div id="flash-message" class="alert alert-{{ session('type')}} col-8 m-auto mt-3">
                    <p>
                        {{session('search')}}
                    </p>
                </div>
              @endif

              {{-- Form for searching in menu base on ingredients --}}
              <form action="{{ route('menu.search') }}" method="POST" class="m-auto text-center mt-3">
                @csrf

                <div class="col-lg-4 col-md-6 form-group mt-3 mt-md-0 m-auto">
                  <input type="input" class="form-control" name="ingredient" id="ingredient" placeholder="Napíš ingredienciu napr. ryža" :value="old('ingredient')" required autofocus>
                </div>

                <button type="submit" class="book-a-table-btn border border-none mt-2">Vyhľadať</button>

              </form>
              {{-- Result from searching --}}
              @if (session()->has('menuSearch'))
              <div class="row menu-container">
                @foreach( Session::get('menuSearch') as $menu)
                  <div class="col-lg-6 menu-item">
                    <div class="menu-content">
                        <a>{{ $menu->name }}</a>
                    </div>
                    <div class="menu-ingredients">
                        {{ $menu->description }}
                    </div>
                    <img src="{{ Storage::url($menu->image) }}" class="img-thumbnail" alt="..." style="height: 100px; width: 150px;">
                  </div>
                @endforeach
                </div>
              @endif

      
            </div>
        </section><!-- End Menu Section -->
    
        {{-- <!-- ======= Specials Section ======= -->
        <section id="specials" class="specials">
          <div class="container">
    
            <div class="section-title">
              <h2>Check our <span>Specials</span></h2>
              <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
            </div>
    
            <div class="row">
              <div class="col-lg-3">
                <ul class="nav nav-tabs flex-column">
                  <li class="nav-item">
                    <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">Modi sit est</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tab-2">Unde praesentium sed</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tab-3">Pariatur explicabo vel</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tab-4">Nostrum qui quasi</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tab-5">Iusto ut expedita aut</a>
                  </li>
                </ul>
              </div>
              <div class="col-lg-9 mt-4 mt-lg-0">
                <div class="tab-content">
                  <div class="tab-pane active show" id="tab-1">
                    <div class="row">
                      <div class="col-lg-8 details order-2 order-lg-1">
                        <h3>Architecto ut aperiam autem id</h3>
                        <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata raqer a videna mareta paulona marka</p>
                        <p>Et nobis maiores eius. Voluptatibus ut enim blanditiis atque harum sint. Laborum eos ipsum ipsa odit magni. Incidunt hic ut molestiae aut qui. Est repellat minima eveniet eius et quis magni nihil. Consequatur dolorem quaerat quos qui similique accusamus nostrum rem vero</p>
                      </div>
                      <div class="col-lg-4 text-center order-1 order-lg-2">
                        <img src="assets/img/specials-1.jpg" alt="" class="img-fluid">
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="tab-2">
                    <div class="row">
                      <div class="col-lg-8 details order-2 order-lg-1">
                        <h3>Et blanditiis nemo veritatis excepturi</h3>
                        <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata raqer a videna mareta paulona marka</p>
                        <p>Ea ipsum voluptatem consequatur quis est. Illum error ullam omnis quia et reiciendis sunt sunt est. Non aliquid repellendus itaque accusamus eius et velit ipsa voluptates. Optio nesciunt eaque beatae accusamus lerode pakto madirna desera vafle de nideran pal</p>
                      </div>
                      <div class="col-lg-4 text-center order-1 order-lg-2">
                        <img src="assets/img/specials-2.jpg" alt="" class="img-fluid">
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="tab-3">
                    <div class="row">
                      <div class="col-lg-8 details order-2 order-lg-1">
                        <h3>Impedit facilis occaecati odio neque aperiam sit</h3>
                        <p class="fst-italic">Eos voluptatibus quo. Odio similique illum id quidem non enim fuga. Qui natus non sunt dicta dolor et. In asperiores velit quaerat perferendis aut</p>
                        <p>Iure officiis odit rerum. Harum sequi eum illum corrupti culpa veritatis quisquam. Neque necessitatibus illo rerum eum ut. Commodi ipsam minima molestiae sed laboriosam a iste odio. Earum odit nesciunt fugiat sit ullam. Soluta et harum voluptatem optio quae</p>
                      </div>
                      <div class="col-lg-4 text-center order-1 order-lg-2">
                        <img src="assets/img/specials-3.jpg" alt="" class="img-fluid">
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="tab-4">
                    <div class="row">
                      <div class="col-lg-8 details order-2 order-lg-1">
                        <h3>Fuga dolores inventore laboriosam ut est accusamus laboriosam dolore</h3>
                        <p class="fst-italic">Totam aperiam accusamus. Repellat consequuntur iure voluptas iure porro quis delectus</p>
                        <p>Eaque consequuntur consequuntur libero expedita in voluptas. Nostrum ipsam necessitatibus aliquam fugiat debitis quis velit. Eum ex maxime error in consequatur corporis atque. Eligendi asperiores sed qui veritatis aperiam quia a laborum inventore</p>
                      </div>
                      <div class="col-lg-4 text-center order-1 order-lg-2">
                        <img src="assets/img/specials-4.jpg" alt="" class="img-fluid">
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="tab-5">
                    <div class="row">
                      <div class="col-lg-8 details order-2 order-lg-1">
                        <h3>Est eveniet ipsam sindera pad rone matrelat sando reda</h3>
                        <p class="fst-italic">Omnis blanditiis saepe eos autem qui sunt debitis porro quia.</p>
                        <p>Exercitationem nostrum omnis. Ut reiciendis repudiandae minus. Omnis recusandae ut non quam ut quod eius qui. Ipsum quia odit vero atque qui quibusdam amet. Occaecati sed est sint aut vitae molestiae voluptate vel</p>
                      </div>
                      <div class="col-lg-4 text-center order-1 order-lg-2">
                        <img src="assets/img/specials-5.jpg" alt="" class="img-fluid">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
    
          </div>
        </section><!-- End Specials Section --> --}}
    
        {{-- <!-- ======= Events Section ======= -->
        <section id="events" class="events">
          <div class="container">
    
            <div class="section-title">
              <h2>Organize Your <span>Events</span> in our Restaurant</h2>
            </div>
    
            <div class="events-slider swiper">
              <div class="swiper-wrapper">
    
                <div class="swiper-slide">
                  <div class="row event-item">
                    <div class="col-lg-6">
                      <img src="assets/img/event-birthday.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 content">
                      <h3>Birthday Parties</h3>
                      <div class="price">
                        <p><span>$189</span></p>
                      </div>
                      <p class="fst-italic">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                        magna aliqua.
                      </p>
                      <ul>
                        <li><i class="bi bi-check-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                        <li><i class="bi bi-check-circle"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                        <li><i class="bi bi-check-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                      </ul>
                      <p>
                        Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                        velit esse cillum dolore eu fugiat nulla pariatur
                      </p>
                    </div>
                  </div>
                </div><!-- End testimonial item -->
    
                <div class="swiper-slide">
                  <div class="row event-item">
                    <div class="col-lg-6">
                      <img src="assets/img/event-private.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 content">
                      <h3>Private Parties</h3>
                      <div class="price">
                        <p><span>$290</span></p>
                      </div>
                      <p class="fst-italic">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                        magna aliqua.
                      </p>
                      <ul>
                        <li><i class="bi bi-check-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                        <li><i class="bi bi-check-circle"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                        <li><i class="bi bi-check-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                      </ul>
                      <p>
                        Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                        velit esse cillum dolore eu fugiat nulla pariatur
                      </p>
                    </div>
                  </div>
                </div><!-- End testimonial item -->
    
                <div class="swiper-slide">
                  <div class="row event-item">
                    <div class="col-lg-6">
                      <img src="assets/img/event-custom.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 content">
                      <h3>Custom Parties</h3>
                      <div class="price">
                        <p><span>$99</span></p>
                      </div>
                      <p class="fst-italic">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                        magna aliqua.
                      </p>
                      <ul>
                        <li><i class="bi bi-check-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                        <li><i class="bi bi-check-circle"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                        <li><i class="bi bi-check-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                      </ul>
                      <p>
                        Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                        velit esse cillum dolore eu fugiat nulla pariatur
                      </p>
                    </div>
                  </div>
                </div><!-- End testimonial item -->
    
              </div>
              <div class="swiper-pagination"></div>
            </div>
    
          </div>
        </section><!-- End Events Section --> --}}
    
        <!-- ======= Gallery Section ======= -->
        <section id="gallery" class="gallery">
          <div class="container-fluid">
    
            <div class="section-title">
              <h2>Some photos from <span>Our Restaurant</span></h2>
              <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
            </div>
    
            <div class="row g-0">
    
              <div class="col-lg-3 col-md-4">
                <div class="gallery-item">
                  <a href="{{ Storage::url('img/gallery/gallery-1.jpg') }}" class="gallery-lightbox">
                    <img src="{{ Storage::url('img/gallery/gallery-1.jpg') }}" alt="" class="img-fluid">
                  </a>
                </div>
              </div>
    
              <div class="col-lg-3 col-md-4">
                <div class="gallery-item">
                  <a href="{{ Storage::url('img/gallery/gallery-2.jpg') }}" class="gallery-lightbox">
                    <img src="{{ Storage::url('img/gallery/gallery-2.jpg') }}" alt="" class="img-fluid">
                  </a>
                </div>
              </div>
    
              <div class="col-lg-3 col-md-4">
                <div class="gallery-item">
                  <a href="{{ Storage::url('img/gallery/gallery-3.jpg') }}" class="gallery-lightbox">
                    <img src="{{ Storage::url('img/gallery/gallery-3.jpg') }}" alt="" class="img-fluid">
                  </a>
                </div>
              </div>
    
              <div class="col-lg-3 col-md-4">
                <div class="gallery-item">
                  <a href="{{ Storage::url('img/gallery/gallery-4.jpg') }}" class="gallery-lightbox">
                    <img src="{{ Storage::url('img/gallery/gallery-4.jpg') }}" alt="" class="img-fluid">
                  </a>
                </div>
              </div>
    
              <div class="col-lg-3 col-md-4">
                <div class="gallery-item">
                  <a href="{{ Storage::url('img/gallery/gallery-5.jpg') }}" class="gallery-lightbox">
                    <img src="{{ Storage::url('img/gallery/gallery-5.jpg') }}" alt="" class="img-fluid">
                  </a>
                </div>
              </div>
    
              <div class="col-lg-3 col-md-4">
                <div class="gallery-item">
                  <a href="{{ Storage::url('img/gallery/gallery-6.jpg') }}" class="gallery-lightbox">
                    <img src="{{ Storage::url('img/gallery/gallery-6.jpg') }}" alt="" class="img-fluid">
                  </a>
                </div>
              </div>
    
              <div class="col-lg-3 col-md-4">
                <div class="gallery-item">
                  <a href="{{ Storage::url('img/gallery/gallery-7.jpg') }}" class="gallery-lightbox">
                    <img src="{{ Storage::url('img/gallery/gallery-7.jpg') }}" alt="" class="img-fluid">
                  </a>
                </div>
              </div>
    
              <div class="col-lg-3 col-md-4">
                <div class="gallery-item">
                  <a href="{{ Storage::url('img/gallery/gallery-8.jpg') }}" class="gallery-lightbox">
                    <img src="{{ Storage::url('img/gallery/gallery-8.jpg') }}" alt="" class="img-fluid">
                  </a>
                </div>
              </div>
    
            </div>
    
          </div>
        </section><!-- End Gallery Section -->
    
        {{-- <!-- ======= Chefs Section ======= -->
        <section id="chefs" class="chefs">
          <div class="container">
    
            <div class="section-title">
              <h2>Our Proffesional <span>Chefs</span></h2>
              <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
            </div>
    
            <div class="row">
    
              <div class="col-lg-4 col-md-6">
                <div class="member">
                  <div class="pic"><img src="assets/img/chefs/chefs-1.jpg" class="img-fluid" alt=""></div>
                  <div class="member-info">
                    <h4>Walter White</h4>
                    <span>Master Chef</span>
                    <div class="social">
                      <a href=""><i class="bi bi-twitter"></i></a>
                      <a href=""><i class="bi bi-facebook"></i></a>
                      <a href=""><i class="bi bi-instagram"></i></a>
                      <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                  </div>
                </div>
              </div>
    
              <div class="col-lg-4 col-md-6">
                <div class="member">
                  <div class="pic"><img src="assets/img/chefs/chefs-2.jpg" class="img-fluid" alt=""></div>
                  <div class="member-info">
                    <h4>Sarah Jhonson</h4>
                    <span>Patissier</span>
                    <div class="social">
                      <a href=""><i class="bi bi-twitter"></i></a>
                      <a href=""><i class="bi bi-facebook"></i></a>
                      <a href=""><i class="bi bi-instagram"></i></a>
                      <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                  </div>
                </div>
              </div>
    
              <div class="col-lg-4 col-md-6">
                <div class="member">
                  <div class="pic"><img src="assets/img/chefs/chefs-3.jpg" class="img-fluid" alt=""></div>
                  <div class="member-info">
                    <h4>William Anderson</h4>
                    <span>Cook</span>
                    <div class="social">
                      <a href=""><i class="bi bi-twitter"></i></a>
                      <a href=""><i class="bi bi-facebook"></i></a>
                      <a href=""><i class="bi bi-instagram"></i></a>
                      <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                  </div>
                </div>
              </div>
    
            </div>
    
          </div>
        </section><!-- End Chefs Section --> --}}
    
        <!-- ======= Testimonials Section ======= -->
        <section id="testimonials" class="testimonials">
          <div class="container position-relative">
    
            <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
              <div class="swiper-wrapper">
    
                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <img src="{{ Storage::url('img/testimonials/testimonials-1.jpg') }}" class="testimonial-img" alt="">
                    <h3>Saul Goodman</h3>
                    <h4>Ceo &amp; Founder</h4>
                    <div class="stars">
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p>
                      <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                      Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                      <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                    </p>
                  </div>
                </div><!-- End testimonial item -->
    
                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <img src="{{ Storage::url('img/testimonials/testimonials-2.jpg') }}" class="testimonial-img" alt="">
                    <h3>Sara Wilsson</h3>
                    <h4>Designer</h4>
                    <div class="stars">
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p>
                      <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                      Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                      <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                    </p>
                  </div>
                </div><!-- End testimonial item -->
    
                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <img src="{{ Storage::url('img/testimonials/testimonials-3.jpg') }}" class="testimonial-img" alt="">
                    <h3>Jena Karlis</h3>
                    <h4>Store Owner</h4>
                    <div class="stars">
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p>
                      <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                      Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                      <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                    </p>
                  </div>
                </div><!-- End testimonial item -->
    
                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <img src="{{ Storage::url('img/testimonials/testimonials-4.jpg') }}" class="testimonial-img" alt="">
                    <h3>Matt Brandon</h3>
                    <h4>Freelancer</h4>
                    <div class="stars">
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p>
                      <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                      Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
                      <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                    </p>
                  </div>
                </div><!-- End testimonial item -->
    
                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <img src="{{ Storage::url('img/testimonials/testimonials-5.jpg') }}" class="testimonial-img" alt="">
                    <h3>John Larson</h3>
                    <h4>Entrepreneur</h4>
                    <div class="stars">
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p>
                      <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                      Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
                      <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                    </p>
                  </div>
                </div><!-- End testimonial item -->
    
              </div>
              <div class="swiper-pagination"></div>
            </div>
    
          </div>
        </section><!-- End Testimonials Section -->
    
        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
          <div class="container">
    
            <div class="section-title">
              <h2><span>Contact</span> Us</h2>
              <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
            </div>
          </div>
    
          <div class="container mt-5">
    
            <div class="info-wrap">
              <div class="row">
                <div class="col-lg-3 col-md-6 info">
                  <i class="bi bi-geo-alt"></i>
                  <h4>Location:</h4>
                  <p>A108 Adam Street<br>New York, NY 535022</p>
                </div>
    
                <div class="col-lg-3 col-md-6 info mt-4 mt-lg-0">
                  <i class="bi bi-clock"></i>
                  <h4>Open Hours:</h4>
                  <p>Monday-Saturday:<br>11:00 AM - 2300 PM</p>
                </div>
    
                <div class="col-lg-3 col-md-6 info mt-4 mt-lg-0">
                  <i class="bi bi-envelope"></i>
                  <h4>Email:</h4>
                  <p>info@example.com<br>contact@example.com</p>
                </div>
    
                <div class="col-lg-3 col-md-6 info mt-4 mt-lg-0">
                  <i class="bi bi-phone"></i>
                  <h4>Call:</h4>
                  <p>+1 5589 55488 51<br>+1 5589 22475 14</p>
                </div>
              </div>
            </div>
    
            <form action="{{ route('email.index') }}" method="post" id="info-mail">
              @csrf
              <div class="row">

                {{-- if is user auth, add value for name and email input --}}
                @auth

                  <div class="col-md-6 form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Vaše meno" value="{{ auth()->user()->name }}" required>
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Váš email" value="{{ auth()->user()->email }}" required>
                  </div>

                @endauth

                @guest

                  <div class="col-md-6 form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Vaše meno" required>
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Váš email" required>
                  </div> 

                @endguest
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Hlavička" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Správa" required></textarea>
              </div>
              <div class="text-center"><button type="submit">Poslať správu</button></div>
            </form>
    
          </div>
        </section><!-- End Contact Section -->
    
      </main><!-- End #main -->
</x-guest-layout>