<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <title>موقع صالون التجميل</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <meta content="Author" name="WebThemez">
  <!-- Favicons -->
  <link rel="icon" type="image/x-icon" href={{asset('website/img/favicon.png')}}>
  <link rel="apple-touch-icon" type="image/x-icon" href={{asset('website/img/apple-touch-icon.png')}}>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400;700&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="{{asset('website/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="{{asset('website/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{asset('website/lib/animate/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('website/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('website/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
  <link href="{{asset('website/lib/magnific-popup/magnific-popup.css')}}" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="{{asset('website/css/style.css')}}" rel="stylesheet">

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
    .shape{
      margin: -0px;
      padding: -5px;
      padding-top: 20px;
      font-size: 10px;
    }
    /* ... (الأنماط السابقة) ... */
  .login-buttons {
    margin-left: 0; /* لضمان البدء من أقصى اليسار */
    display: flex;
    align-items: center;
    gap: 10px; /* مسافة بين الأزرار */
  }
  .btn-custom {
    padding: 5px 15px; /* تحسين حجم الزر */
    font-size: 1rem; /* توافق مع حجم الخط العام */
  }
     .shape-text{
      font-size: 1rem; /* Adjusted font size for shape-text */
      font-weight: 700; /* Bold for better visibility */
      padding-right: -30px;
      margin: -20px;
      padding-left: 20px;
      font-size: 10px;
    }
    p, a, li, span, input, textarea {
      font-family: 'Noto Naskh Arabic', serif;
      font-size: 1.1rem;
      line-height: 1.6; /* تحسين المسافة بين الأسطر */
      unicode-bidi: embed; /* دعم أفضل للنصوص العربية */
    }
    /* إصلاح مشاكل عرض الأحرف العربية */
    * {
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }
  </style>
</head>

<body id="body">

  <!--==========================
    Top Bar
  ============================-->
  <section id="topbar" class="d-none d-lg-block">
    <div class="container clearfix">
      <div class="contact-info float-right">
        <i class="fa fa-envelope-o"></i> <a href="mailto:contact@example.com">name@websitename.com</a>
        <i class="fa fa-phone"></i> +1 2345 67855 22
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

  <!--==========================
    Header
  ============================-->
  <!--==========================
    Header
  ============================-->
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





  <!--==========================
    Intro Section
  ============================-->
  <section id="intro">
    <div class="intro-content">
      <h2><span>العناية بالشعر والبشرة</span><br>أفضل صالون في المدينة</h2>
      <div>
        <a href="#about" class="btn-get-started scrollto">العروض</a>
      </div>
    </div>
    <div class="item" style="background-image: url('img/intro-carousel/1.jpg');"></div>
  </section>

  <main id="main">

    <!--==========================
      About Section
    ============================-->
    <section id="about" class="wow fadeInUp sec-padding">
      <div class="container">
        <div class="section-header">
          <h2>عن مرايا</h2>
          <p>لوريم إيبسوم دولور سيت أميت، كونسيكتيتور أديبيسسينغ إليت. دولوريس كواي بورو كونسيكواتير أليكوام، إنسيدونت إيوس ماجني بروفايدنت، دولوريبوس أومنيس مينوس أوفايدنت.</p>
        </div>
        <div class="row">
          <div class="col-lg-6 about-img">
            <img src={{asset('website/img/about-img.png')}} alt="">
          </div>
          <div class="col-lg-6 content">
            <h2>لوريم إيبسوم دولور سيت أميت، كونسيكتيتور أديبيسسينغ</h2>
            <h3>دولوريس كواي بورو كونسيكواتير أليكوام، إنسيدونت إيوس ماجني بروفايدنت، دولوريبوس أومنيس مينوس أوفايدنت</h3>
            <p>كونسيكتيتور أديبيسسينغ إليت. دولوريس كواي بورو كونسيكواتير أليكوام، إنسيدونت فيات. دولوريس كواي بورو كونسيكواتير أليكوام، إنسيدونت فيات كولبا إيس أوتي نولا. ماليس نولا دويس فيات</p>
            <ul>
              <li><i class="icon ion-ios-checkmark-outline"></i> دولوريس كواي بورو كونسيكواتير أليكوام، إنسيدونت فيات كولبا.</li>
              <li><i class="icon ion-ios-checkmark-outline"></i> دولوريس كواي بورو كونسيكواتير أليكوام، كولبا إيس أوتي نولا.</li>
              <li><i class="icon ion-ios-checkmark-outline"></i> دولوريس كواي بورو إيس أوتي نولا. ماليس نولا دويس فيات</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!--==========================
      Services Section
    ============================-->
    <section id="services" class="sec-padding">
      <div class="container">
        <div class="section-header">
          <h2>خدماتنا</h2>
          <p>لوريم إيبسوم دولور سيت أميت، كونسيكتيتور أديبيسسينغ إليت. دولوريس كواي بورو كونسيكواتير أليكوام، إنسيدونت فيات كولبا إيس أوتي نولا. ماليس نولا دويس فيات كولبا إيس أوتي نولا إيبسوم فيليت إكسبورت إيروري مينيم إيلوم فوري</p>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="card wow fadeInRight" style="width: 18rem;">
              <img src={{asset('website/img/services/1.jpg')}} alt="" style="card-img-top">
              <div class="card-body">
                <h5 class="card-title">الشعر</h5>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card wow fadeInRight" style="width: 18rem;">
              <img src={{asset('website/img/services/2.jpg')}} alt="" style="card-img-top">
              <div class="card-body">
                <h5 class="card-title">البشرة</h5>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card wow fadeInRight" style="width: 18rem;">
              <img src={{asset('website/img/services/3.jpg')}} alt="" style="card-img-top">
              <div class="card-body">
                <h5 class="card-title">الأيدي والأقدام</h5>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="card wow fadeInRight" style="width: 18rem;">
              <img src={{asset('website/img/services/4.jpg')}} alt="" style="card-img-top">
              <div class="card-body">
                <h5 class="card-title">الأساسيات</h5>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card wow fadeInRight" style="width: 18rem;">
              <img src={{asset('website/img/services/5.jpg')}} alt="" style="card-img-top">
              <div class="card-body">
                <h5 class="card-title">الابتكارات</h5>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card wow fadeInRight" style="width: 18rem;">
              <img src={{asset('website/img/services/6.jpg')}} alt="" style="card-img-top">
              <div class="card-body">
                <h5 class="card-title">العروس</h5>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="box wow fadeInLeft" data-wow-delay="0.2s">
              <div class="icon"><i class="fa fa-map"></i></div>
              <h4 class="title"><a href="">الأساسيات</a></h4>
              <p class="description">لوريم إيبسوم دولور سيت أميت، كونسيكتيتور أديبيسسينغ إليت. دولوريس كواي بورو كونسيكواتير أليكوام، إنسيدونت فيات كولبا إيس أوتي نولا.</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="box wow fadeInRight" data-wow-delay="0.2s">
              <div class="icon"><i class="fa fa-shopping-bag"></i></div>
              <h4 class="title"><a href="">الابتكارات</a></h4>
              <p class="description">لوريم إيبسوم دولور سيت أميت، كونسيكتيتور أديبيسسينغ إليت. دولوريس كواي بورو كونسيكواتير أليكوام، إنسيدونت فيات كولبا إيس أوتي نولا.</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="box wow fadeInLeft" data-wow-delay="0.2s">
              <div class="icon"><i class="fa fa-map"></i></div>
              <h4 class="title"><a href="">العروس</a></h4>
              <p class="description">لوريم إيبسوم دولور سيت أميت، كونسيكتيتور أديبيسسينغ إليت. دولوريس كواي بورو كونسيكواتير أليكوام، إنسيدونت فيات كولبا إيس أوتي نولا.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!--==========================
      Price Section
    ============================-->
    <section id="price" class="wow fadeInUp sec-padding">
      <div class="container">
        <div class="section-header">
          <h2>قائمة الأسعار</h2>
          <p>لوريم إيبسوم دولور سيت أميت، كونسيكتيتور أديبيسسينغ إليت. دولوريس كواي بورو كونسيكواتير أليكوام، إنسيدونت فيات كولبا إيس أوتي نولا.</p>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
            <div class="offer offer-default">
              <div class="shape">
                <div class="shape-text">الأفضل</div>
              </div>
              <div class="offer-content">
                <h3 class="lead">الكل في واحد</h3>
                <p>$69</p>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
            <div class="offer offer-success">
              <div class="shape">
                <div class="shape-text">الأفضل</div>
              </div>
              <div class="offer-content">
                <h3 class="lead">تصفيف الشعر</h3>
                <p>$150</p>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
            <div class="offer offer-radius offer-primary">
              <div class="shape">
                <div class="shape-text">الأفضل</div>
              </div>
              <div class="offer-content">
                <h3 class="lead">تنظيف الوجه</h3>
                <p>$250</p>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
            <div class="offer offer-info">
              <div class="shape">
                <div class="shape-text">الأفضل</div>
              </div>
              <div class="offer-content">
                <h3 class="lead">باقة المكياج</h3>
                <p>$99</p>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
            <div class="offer offer-warning">
              <div class="shape">
                <div class="shape-text">الأفضل</div>
              </div>
              <div class="offer-content">
                <h3 class="lead">الأيدي والأرجل</h3>
                <p>$19</p>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
            <div class="offer offer-radius offer-danger">
              <div class="shape">
                <div class="shape-text">الأفضل</div>
              </div>
              <div class="offer-content">
                <h3 class="lead">باقة الوجه</h3>
                <p>$9</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!--==========================
      Clients Section
    ============================-->
    <section id="clients" class="wow fadeInUp sec-padding">
      <div class="container">
        <div class="section-header">
          <h2>المنتجات</h2>
          <p>لوريم إيبسوم دولور سيت أميت، كونسيكتيتور أديبيسسينغ إليت. دولوريس كواي بورو كونسيكواتير أليكوام، إنسيدونت فيات كولبا إيس أوتي نولا.</p>
        </div>
        <div class="owl-carousel clients-carousel">
          <img src={{asset('website/img/clients/client-1.jpg')}} alt="" style="card-img-top">
          <img src={{asset('website/img/clients/client-2.jpg')}} alt="" style="card-img-top">
          <img src={{asset('website/img/clients/client-3.jpg')}} alt="" style="card-img-top">
          <img src={{asset('website/img/clients/client-4.jpg')}} alt="" style="card-img-top">
          <img src={{asset('website/img/clients/client-5.jpg')}} alt="" style="card-img-top">
          <img src={{asset('website/img/clients/client-6.jpg')}} alt="" style="card-img-top">
        </div>
      </div>
    </section>

    <!--==========================
      Our Portfolio Section
    ============================-->
    <section id="portfolio" class="wow fadeInUp sec-padding">
      <div class="container">
        <div class="section-header">
          <h2>معرض أعمالنا</h2>
          <p>لوريم إيبسوم دولور سيت أميت، كونسيكتيتور أديبيسسينغ إليت. دولوريس كواي بورو كونسيكواتير أليكوام، إنسيدونت فيات كولبا إيس أوتي نولا.</p>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row no-gutters">
          <div class="col-lg-3 col-md-4">
            <div class="portfolio-item wow fadeInUp">
              <a href="{{asset('website/img/portfolio/1.jpg')}}" class="portfolio-popup">
                <img src={{asset('website/img/portfolio/1.jpg')}} alt="">
                <div class="portfolio-overlay">
                  <div class="portfolio-info"><h2 class="wow fadeInUp">اسم المعرض</h2></div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-4">
            <div class="portfolio-item wow fadeInUp">
              <a href="{{asset('website/img/portfolio/2.jpg')}}" class="portfolio-popup">
                <img src={{asset('website/img/portfolio/2.jpg')}} alt="">
                <div class="portfolio-overlay">
                  <div class="portfolio-info"><h2 class="wow fadeInUp">اسم المعرض</h2></div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-4">
            <div class="portfolio-item wow fadeInUp">
              <a href="{{asset('website/img/portfolio/3.jpg')}}" class="portfolio-popup">
                <img src={{asset('website/img/portfolio/3.jpg')}} alt="">
                <div class="portfolio-overlay">
                  <div class="portfolio-info"><h2 class="wow fadeInUp">اسم المعرض</h2></div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-4">
            <div class="portfolio-item wow fadeInUp">
              <a href="{{asset('website/img/portfolio/4.jpg')}}" class="portfolio-popup">
                <img src={{asset('website/img/portfolio/4.jpg')}} alt="">
                <div class="portfolio-overlay">
                  <div class="portfolio-info"><h2 class="wow fadeInUp">اسم المعرض</h2></div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-4">
            <div class="portfolio-item wow fadeInUp">
              <a href="{{asset('website/img/portfolio/5.jpg')}}" class="portfolio-popup">
                <img src={{asset('website/img/portfolio/5.jpg')}} alt="">
                <div class="portfolio-overlay">
                  <div class="portfolio-info"><h2 class="wow fadeInUp">اسم المعرض</h2></div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-4">
            <div class="portfolio-item wow fadeInUp">
              <a href="{{asset('website/img/portfolio/6.jpg')}}" class="portfolio-popup">
                <img src={{asset('website/img/portfolio/6.jpg')}} alt="">
                <div class="portfolio-overlay">
                  <div class="portfolio-info"><h2 class="wow fadeInUp">اسم المعرض</h2></div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-4">
            <div class="portfolio-item wow fadeInUp">
              <a href="{{asset('website/img/portfolio/7.jpg')}}" class="portfolio-popup">
                <img src={{asset('website/img/portfolio/7.jpg')}} alt="">
                <div class="portfolio-overlay">
                  <div class="portfolio-info"><h2 class="wow fadeInUp">اسم المعرض</h2></div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-4">
            <div class="portfolio-item wow fadeInUp">
              <a href="{{asset('website/img/portfolio/8.jpg')}}" class="portfolio-popup">
                <img src={{asset('website/img/portfolio/8.jpg')}} alt="">
                <div class="portfolio-overlay">
                  <div class="portfolio-info"><h2 class="wow fadeInUp">اسم المعرض</h2></div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!--==========================
      Testimonials Section
    ============================-->
    <section id="testimonials" class="wow fadeInUp sec-padding">
      <div class="container">
        <div class="section-header">
          <h2>آراء العملاء</h2>
          <p>لوريم إيبسوم دولور سيت أميت، كونسيكتيتور أديبيسسينغ إليت. دولوريس كواي بورو كونسيكواتير أليكوام، إنسيدونت فيات كولبا إيس أوتي نولا.</p>
        </div>
        <div class="owl-carousel testimonials-carousel">
          <div class="testimonial-item">
            <p>دولوريس كواي بورو كونسيكواتير أليكوام، إنسيدونت فيات كولبا إيس أوتي نولا. دويس فيات كولبا إيس أوتي نولا إيبسوم فيليت إكسبورت إيروري مينيم إيلوم فوري</p>
            <h3>ماريو جيمس</h3>
            <h4>الرئيس التنفيذي والمؤسس</h4>
          </div>
          <div class="testimonial-item">
            <p>دولوريس كواي بورو كونسيكواتير أليكوام، إنسيدونت فيات كولبا إيس أوتي نولا. دويس فيات كولبا إيس أوتي نولا إيبسوم فيليت إكسبورت إيروري مينيم إيلوم فوري</p>
            <h3>فينتون جوفنيس</h3>
            <h4>المدير التقني</h4>
          </div>
          <div class="testimonial-item">
            <p>دولوريس كواي بورو كونسيكواتير أليكوام، إنسيدونت فيات كولبا إيس أوتي نولا. دويس فيات كولبا إيس أوتي نولا إيبسوم فيليت إكسبورت إيروري مينيم إيلوم فوري</p>
            <h3>ماركوس كيل</h3>
            <h4>التسويق</h4>
          </div>
          <div class="testimonial-item">
            <p>دولوريس كواي بورو كونسيكواتير أليكوام، إنسيدونت فيات كولبا إيس أوتي نولا. دويس فيات كولبا إيس أوتي نولا إيبسوم فيليت إكسبورت إيروري مينيم إيلوم فوري</p>
            <h3>ويليامز بيلي</h3>
            <h4>الحسابات</h4>
          </div>
          <div class="testimonial-item">
            <p>دولوريس كواي بورو كونسيكواتير أليكوام، إنسيدونت فيات كولبا إيس أوتي نولا. دويس فيات كولبا إيس أوتي نولا إيبسوم فيليت إكسبورت إيروري مينيم إيلوم فوري</p>
            <h3>لاري هانسون</h3>
            <h4>المستثمر</h4>
          </div>
        </div>
      </div>
    </section>

    <!--==========================
      Call To Action Section
    ============================-->
    <section id="call-to-action" class="wow fadeInUp sec-padding">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 text-center text-lg-right">
            <h3 class="cta-title">احصل على خدماتنا</h3>
            <p class="cta-text">لوريم إيبسوم دولور سيت أميت، كونسيكتيتور أديبيسسينغ إليت. دولوريس كواي بورو كونسيكواتير أليكوام، إنسيدونت فيات كولبا إيس أوتي نولا كوبيداتات نون بروايدنت.</p>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="#contact">اتصل بنا</a>
          </div>
        </div>
      </div>
    </section>

    <!--==========================
      Our Team Section
    ============================-->
    <section id="team" class="wow fadeInUp sec-padding">
      <div class="container">
        <div class="section-header">
          <h2>فريقنا</h2>
        </div>
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="member">
              <div class="pic">
                <img src={{asset('website/img/team1.jpg')}} alt="">
              </div>
              <div class="details">
                <h4>جيمس سميث</h4>
                <span>الرئيس التنفيذي</span>
                <div class="social">
                  <a href=""><i class="fa fa-twitter"></i></a>
                  <a href=""><i class="fa fa-facebook"></i></a>
                  <a href=""><i class="fa fa-google-plus"></i></a>
                  <a href=""><i class="fa fa-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="member">
              <div class="pic">
                <img src={{asset('website/img/team2.jpg')}} alt="">
              </div>
              <div class="details">
                <h4>ميشيل كيلون</h4>
                <span>المدير الفني</span>
                <div class="social">
                  <a href=""><i class="fa fa-twitter"></i></a>
                  <a href=""><i class="fa fa-facebook"></i></a>
                  <a href=""><i class="fa fa-google-plus"></i></a>
                  <a href=""><i class="fa fa-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="member">
              <div class="pic">
                <img src={{asset('website/img/team3.jpg')}} alt="">
              </div>
              <div class="details">
                <h4>فرينش لينكون</h4>
                <span>المدير المالي</span>
                <div class="social">
                  <a href=""><i class="fa fa-twitter"></i></a>
                  <a href=""><i class="fa fa-facebook"></i></a>
                  <a href=""><i class="fa fa-google-plus"></i></a>
                  <a href=""><i class="fa fa-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="member">
              <div class="pic">
                <img src={{asset('website/img/team4.jpg')}} alt="">
              </div>
              <div class="details">
                <h4>أماندا جيبسون</h4>
                <span>المحاسب</span>
                <div class="social">
                  <a href=""><i class="fa fa-twitter"></i></a>
                  <a href=""><i class="fa fa-facebook"></i></a>
                  <a href=""><i class="fa fa-google-plus"></i></a>
                  <a href=""><i class="fa fa-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!--==========================
      Contact Section
    ============================-->
    <section id="contact" class="wow fadeInUp sec-padding">
      <div class="container">
        <div class="section-header">
          <h2>اتصل بنا</h2>
          <p>لوريم إيبسوم دولور سيت أميت، كونسيكتيتور أديبيسسينغ إليت. دولوريس كواي بورو كونسيكواتير أليكوام، إنسيدونت فيات كولبا إيس أوتي نولا.</p>
        </div>
        <div class="row contact-info">
          <div class="col-lg-5">
            <div class="contact-address">
              <i class="ion-ios-location-outline"></i>
              <h3>العنوان</h3>
              <address>شارع لينكون MN-12، نيويورك 12356، الولايات المتحدة</address>
            </div>
            <div class="contact-phone">
              <i class="ion-ios-telephone-outline"></i>
              <h3>رقم الهاتف</h3>
              <p><a href="tel:+155895548855">+1 2345 67890 12</a></p>
            </div>
            <div class="contact-email">
              <i class="ion-ios-email-outline"></i>
              <h3>البريد الإلكتروني</h3>
              <p><a href="mailto:info@example.com">name@website.com</a></p>
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
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d387191.33750346623!2d-73.979681!3d40.6974881!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1541477355474" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
    </section>

  </main>

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        © حقوق النشر <strong>توبير</strong>. جميع الحقوق محفوظة
      </div>
      <div class="credits">
        القالب بواسطة <a href="https://webthemez.com/consulting/">WebThemez</a>
      </div>
    </div>
  </footer>

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript -->
  <script src="{{asset('website/lib/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('website/lib/jquery/jquery-migrate.min.js')}}"></script>
  <script src="{{asset('website/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('website/lib/superfish/hoverIntent.js')}}"></script>
  <script src="{{asset('website/lib/superfish/superfish.min.js')}}"></script>
  <script src="{{asset('website/lib/wow/wow.min.js')}}"></script>
  <script src="{{asset('website/lib/owlcarousel/owl.carousel.min.js')}}"></script>
  <script src="{{asset('website/lib/magnific-popup/magnific-popup.min.js')}}"></script>
  <script src="{{asset('website/js/main.js')}}"></script>
  <script src="{{asset('website/lib/sticky/sticky.js')}}"></script>
  <script src="{{asset('website/contact/jqBootstrapValidation.js')}}"></script>
  <script src="{{asset('website/contact/contact_me.js')}}"></script>
  <script src="{{asset('website/js/main.js')}}"></script>

  @include('website.layouts.script')
</body>
</html>