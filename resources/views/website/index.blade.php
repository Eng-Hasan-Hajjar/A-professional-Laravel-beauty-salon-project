<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <title>موقع صالون التجميل</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="صالون تجميل، خدمات العناية بالشعر والبشرة" name="keywords">
  <meta content="صالون مرايا يقدم أفضل خدمات العناية بالشعر والبشرة بأيدي خبراء محترفين" name="description">
  <meta content="Author" name="WebThemez">
  <!-- Favicons -->
  <link rel="icon" type="image/x-icon" href="{{ asset('website/img/favicon.png') }}">
  <link rel="apple-touch-icon" type="image/x-icon" href="{{ asset('website/img/apple-touch-icon.png') }}">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400;700&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="{{ asset('website/lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="{{ asset('website/lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('website/lib/animate/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('website/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('website/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('website/lib/magnific-popup/magnific-popup.css') }}" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="{{ asset('website/css/style.css') }}" rel="stylesheet">

  <style>
    body, html {
      direction: rtl;
      font-family: 'Noto Naskh Arabic', serif;
      font-size: 1.1rem;
      text-align: right;
    }
    .float-left { float: right !important; }
    .float-right { float: left !important; }
    .pull-left { float: right !important; }
    .pull-right { float: left !important; }
    .text-lg-left { text-align: right !important; }
    .nav-menu { text-align: right; }
    .btn-primary.pull-right { float: left !important; }
    h1, h2, h3, h4, h5, h6 {
      font-family: 'Noto Naskh Arabic', serif;
      font-size: 1.2em;
    }
    .shape {
      margin: 0;
      padding: 20px 0 0 0;
      font-size: 10px;
    }
    .login-buttons {
      margin-left: 0;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .btn-custom {
      padding: 5px 15px;
      font-size: 1rem;
    }
    .shape-text {
      font-size: 1rem;
      font-weight: 700;
      padding-right: 20px;
      margin: 0;
    }
    p, a, li, span, input, textarea {
      font-family: 'Noto Naskh Arabic', serif;
      font-size: 1.1rem;
      line-height: 1.6;
      unicode-bidi: embed;
    }
    * {
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }
    .portfolio-item img {
      width: 100%;
      height: 250px;
      object-fit: cover;
    }
    .offer-content p {
      font-size: 1.2rem;
      color: #0053c0;
    }
  </style>
</head>

<body id="body">

  <!-- Top Bar -->
  <section id="topbar" class="d-none d-lg-block">
    <div class="container clearfix">
      <div class="contact-info float-right">
        <i class="fa fa-envelope-o"></i> <a href="mailto:contact@miraya.com">contact@miraya.com</a>
        <i class="fa fa-phone"></i> +966 123 456 789
      </div>
      <div class="social-links float-left">
        <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
        <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
        <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
        <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
        <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
      </div>
    </div>
  </section>

  <!-- Header -->
  <header id="header">
    <div class="container">
      <div id="logo" class="pull-left">
        <h1><a href="#body" class="scrollto"><span>م</span>رايا</a></h1>
      </div>

      @if (Route::has('login'))
        <div class="pull-right login-buttons">
          @auth
            <div class="d-none d-lg-block">
              <a data-scroll-nav='1' href="{{ url('/dashboard') }}" class="btn btn-custom">لوحة التحكم</a>
            </div>
            <a href="{{ route('logout') }}" 
               class="btn btn-custom rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
               تسجيل الخروج
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
          @else
            <div class="d-flex gap-2">
              <div class="book_btn d-none d-lg-block">
                <a class="btn btn-outline-primary btn-custom" href="{{ route('login') }}">تسجيل الدخول</a>
              </div>
              @if (Route::has('register'))
                <div class="book_btn d-none d-lg-block">
                  <a class="btn btn-outline-success btn-custom" href="{{ route('register') }}">إنشاء حساب</a>
                </div>
              @endif
            </div>
          @endauth
        </div>
      @endif

      <nav id="nav-menu-container pull-left">
        <ul class="nav-menu">
          <li><a href="#price">الأسعار</a></li>
          <li><a href="#team">فريقنا</a></li>
          <li><a href="#contact">اتصل بنا</a></li>
          <li><a href="#services">الخدمات</a></li>
          <li><a href="#about">من نحن</a></li>
          <li><a href="#portfolio">معرض الأعمال</a></li>
          <li class="menu-active"><a href="#body">الرئيسية</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Intro Section -->
  <section id="intro">
    <div class="intro-content">
      <h2><span>العناية بالشعر والبشرة</span><br>أفضل صالون في المدينة</h2>
      <div>
        <a href="#price" class="btn-get-started scrollto">العروض</a>
      </div>
    </div>
    <div class="item" style="background-image: url('{{ asset('website/img/intro-carousel/1.jpg') }}');"></div>
  </section>

  <main id="main">

    <!-- About Section -->
    <section id="about" class="wow fadeInUp sec-padding">
      <div class="container">
        <div class="section-header">
          <h2>عن مرايا</h2>
          <p>صالون مرايا يقدم خدمات تجميل احترافية تشمل العناية بالشعر والبشرة والأظافر بأحدث التقنيات، مع فريق من الخبراء المدربين لضمان تجربة لا تُنسى.</p>
        </div>
        <div class="row">
          <div class="col-lg-6 about-img">
            <img src="{{ asset('website/img/about-img.png') }}" alt="صالون مرايا">
          </div>
          <div class="col-lg-6 content">
            <h2>نقدم تجربة تجميل استثنائية</h2>
            <h3>نسعى لإبراز جمالك الطبيعي من خلال خدمات مصممة خصيصًا لك</h3>
            <p>نستخدم أفضل المنتجات وأحدث التقنيات لتقديم خدمات عالية الجودة، مع التركيز على راحتك ورضاك.</p>
            <ul>
              <li><i class="icon ion-ios-checkmark-outline"></i> خدمات احترافية بأيدي خبراء.</li>
              <li><i class="icon ion-ios-checkmark-outline"></i> منتجات آمنة وعالية الجودة.</li>
              <li><i class="icon ion-ios-checkmark-outline"></i> تجربة مخصصة تلبي احتياجاتك.</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="sec-padding">
      <div class="container">
        <div class="section-header">
          <h2>خدماتنا</h2>
          <p>استمتعي بمجموعة واسعة من خدمات التجميل التي نقدمها باحترافية عالية.</p>
        </div>
        <div class="row">
          @forelse ($services as $service)
            <div class="col-lg-4">
              <div class="card wow fadeInRight" style="width: 18rem;">
                @if ($service->image)
                  <img src="{{ asset($service->image) }}" alt="{{ $service->name }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                @else
                  <div class="placeholder-image" style="height: 200px; background: #e9ecef; display: flex; align-items: center; justify-content: center; color: #adb5bd;">
                    <i class="fas fa-image fa-3x"></i>
                  </div>
                @endif
                <div class="card-body">
                  <h5 class="card-title">{{ $service->name }}</h5>
                </div>
              </div>
            </div>
          @empty
            <div class="col-12 text-center text-muted p-4">
              <i class="fas fa-exclamation-triangle fa-2x"></i><br>
              لا توجد خدمات متاحة حاليًا
            </div>
          @endforelse
        </div>
      </div>
    </section>

    <!-- Price Section -->
    <section id="price" class="wow fadeInUp sec-padding">
      <div class="container">
        <div class="section-header">
          <h2>قائمة العروض</h2>
          <p>استفيدي من عروضنا الحصرية على خدمات التجميل المتنوعة.</p>
        </div>
        <div class="row">
          @forelse ($offers as $offer)
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
              <div class="offer offer-{{ $loop->index % 2 == 0 ? 'primary' : 'success' }}">
                <div class="shape">
                  <div class="shape-text">مميز </div>
                </div>
                <div class="offer-content">
                  <h3 class="lead">{{ $offer->name }}</h3>
                  <p>{{ $offer->discount_percentage }} % خصم </p>
                  <p>  يبدأ بتاريخ  :    {{ $offer->start_date }}  </p>
                  <p>   ينتهي بتاريخ :             {{ $offer->end_date }}   </p>
                   <p>{{ $offer->description }}   </p>
                </div>
              </div>
            </div>
          @empty
            <div class="col-12 text-center text-muted p-4">
              <i class="fas fa-exclamation-triangle fa-2x"></i><br>
              لا توجد عروض متاحة حاليًا
            </div>
          @endforelse
        </div>
      </div>
    </section>

    <!-- Clients Section (Products) -->
    <section id="clients" class="wow fadeInUp sec-padding">
      <div class="container">
        <div class="section-header">
          <h2>المنتجات</h2>
          <p>اكتشفي مجموعتنا المميزة من منتجات العناية بالشعر والبشرة.</p>
        </div>
        <div class="owl-carousel clients-carousel">
          @forelse ($products as $product)
            @if ($product->image)
              <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="card-img-top" style="height: 150px; object-fit: cover;">
            @else
              <div class="placeholder-image" style="height: 150px; background: #e9ecef; display: flex; align-items: center; justify-content: center; color: #adb5bd;">
                <i class="fas fa-box fa-3x"></i>
              </div>
            @endif
          @empty
            <div class="text-center text-muted p-4">
              <i class="fas fa-exclamation-triangle fa-2x"></i><br>
              لا توجد منتجات متاحة حاليًا
            </div>
          @endforelse
        </div>
      </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="wow fadeInUp sec-padding">
      <div class="container">
        <div class="section-header">
          <h2>معرض أعمالنا</h2>
          <p>شاهدي أعمالنا المميزة التي قمنا بها لعملائنا.</p>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row no-gutters">
          @forelse ($works as $work)
            <div class="col-lg-3 col-md-4">
              <div class="portfolio-item wow fadeInUp">
                <a href="{{ route('web_works_single', $work->id) }}" class="portfolio-popup">
                  @if ($work->main_image)
                    <img src="{{ asset($work->main_image) }}" alt="{{ $work->title }}">
                  @else
                    <div class="placeholder-image" style="height: 250px; background: #e9ecef; display: flex; align-items: center; justify-content: center; color: #adb5bd;">
                      <i class="fas fa-briefcase fa-3x"></i>
                    </div>
                  @endif
                  <div class="portfolio-overlay">
                    <div class="portfolio-info"><h2 class="wow fadeInUp">{{ $work->title }}</h2></div>
                  </div>
                </a>
              </div>
            </div>
          @empty
            <div class="col-12 text-center text-muted p-4">
              <i class="fas fa-exclamation-triangle fa-2x"></i><br>
              لا توجد أعمال مسجلة حاليًا
            </div>
          @endforelse
        </div>
      </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="wow fadeInUp sec-padding">
      <div class="container">
        <div class="section-header">
          <h2>آراء العملاء</h2>
          <p>تعرفي على تجارب عملائنا مع خدماتنا.</p>
        </div>
        <div class="owl-carousel testimonials-carousel">
          @forelse ($reviews as $review)
            <div class="testimonial-item">
              <p>{{ $review->comment }}</p>
              <h3>{{ $review->user->name ?? 'عميل' }}</h3>
              <h4>تقييم: {{ $review->rating }}/5</h4>
            </div>
          @empty
            <div class="text-center text-muted p-4">
              <i class="fas fa-exclamation-triangle fa-2x"></i><br>
              لا توجد مراجعات متاحة حاليًا
            </div>
          @endforelse
        </div>
      </div>
    </section>

    <!-- Call To Action Section -->
    <section id="call-to-action" class="wow fadeInUp sec-padding">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 text-center text-lg-right">
            <h3 class="cta-title">احجزي موعدك الآن</h3>
            <p class="cta-text">استمتعي بتجربة تجميل استثنائية مع فريقنا المحترف.</p>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="{{ route('register') }}">احجزي الآن</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Team Section -->
    <section id="team" class="wow fadeInUp sec-padding">
      <div class="container">
        <div class="section-header">
          <h2>فريقنا</h2>
          <p>تعرفي على فريقنا المحترف من خبراء التجميل.</p>
        </div>
        <div class="row">
          @forelse ($employees as $employee)
            <div class="col-lg-3 col-md-6">
              <div class="member">
                <div class="pic">
                  @if ($employee->user->profile_photo_path)
                    <img src="{{ asset($employee->user->profile_photo_path) }}" alt="{{ $employee->user->name }}">
                  @else
                    <div class="placeholder-image" style="height: 200px; background: #e9ecef; display: flex; align-items: center; justify-content: center; color: #adb5bd;">
                      <i class="fas fa-user fa-3x"></i>
                    </div>
                  @endif
                </div>
                <div class="details">
                  <h4>{{ $employee->user->name ?? 'غير متوفر' }}</h4>
                  <span>{{ $employee->job_title ?? 'خبير تجميل' }}</span>
                  <div class="social">
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                  </div>
                </div>
              </div>
            </div>
          @empty
            <div class="col-12 text-center text-muted p-4">
              <i class="fas fa-exclamation-triangle fa-2x"></i><br>
              لا يوجد موظفون مسجلون حاليًا
            </div>
          @endforelse
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="wow fadeInUp sec-padding">
      <div class="container">
        <div class="section-header">
          <h2>اتصل بنا</h2>
          <p>تواصلوا معنا للحجز أو للاستفسار عن خدماتنا.</p>
        </div>
        <div class="row contact-info">
          <div class="col-lg-5">
            <div class="contact-address">
              <i class="ion-ios-location-outline"></i>
              <h3>العنوان</h3>
              <address>شارع فيصل، حلب، سوريا </address>
            </div>
            <div class="contact-phone">
              <i class="ion-ios-telephone-outline"></i>
              <h3>رقم الهاتف</h3>
              <p><a href="tel:+966123456789">+963 123 456 789</a></p>
            </div>
            <div class="contact-email">
              <i class="ion-ios-email-outline"></i>
              <h3>البريد الإلكتروني</h3>
              <p><a href="mailto:contact@miraya.com">contact@miraya.com</a></p>
            </div>
          </div>
          <div class="col-lg-7">
            <div class="container">
              <div class="form">
                <form name="sentMessage" class="well" id="contactForm" novalidate>
                  <div class="control-group">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="الاسم الكامل" id="name" required data-validation-required-message="يرجى إدخال اسمك">
                      <p class="help-block"></p>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="controls">
                      <input type="email" class="form-control" placeholder="البريد الإلكتروني" id="email" required data-validation-required-message="يرجى إدخال بريدك الإلكتروني">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="controls">
                      <textarea rows="10" cols="100" class="form-control" placeholder="الرسالة" id="message" required data-validation-required-message="يرجى إدخال رسالتك" minlength="5" data-validation-minlength-message="الحد الأدنى 5 أحرف" maxlength="999" style="resize:none"></textarea>
                    </div>
                  </div>
                  <div id="success"></div>
                  <button type="submit" class="btn btn-primary pull-left">إرسال</button><br>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container mb-4 map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3623.99682787337!2d46.6977773150571!3d24.682993984134263!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f03890d489d25%3A0x1432796e9e5d8d2f!2sKing%20Abdulaziz%20Rd%2C%20Riyadh%20Saudi%20Arabia!5e0!3m2!1sen!2ssa!4v1698765432109" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
    </section>

  </main>

  <!-- Footer -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        © حقوق النشر <strong>مرايا</strong>. جميع الحقوق محفوظة
      </div>
     
    </div>
  </footer>

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript -->
  <script src="{{ asset('website/lib/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('website/lib/jquery/jquery-migrate.min.js') }}"></script>
  <script src="{{ asset('website/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('website/lib/superfish/hoverIntent.js') }}"></script>
  <script src="{{ asset('website/lib/superfish/superfish.min.js') }}"></script>
  <script src="{{ asset('website/lib/wow/wow.min.js') }}"></script>
  <script src="{{ asset('website/lib/owlcarousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('website/lib/magnific-popup/magnific-popup.min.js') }}"></script>
  <script src="{{ asset('website/js/main.js') }}"></script>
  <script src="{{ asset('website/lib/sticky/sticky.js') }}"></script>
  <script src="{{ asset('website/contact/jqBootstrapValidation.js') }}"></script>
  <script src="{{ asset('website/contact/contact_me.js') }}"></script>

  @include('website.layouts.script')
</body>
</html>