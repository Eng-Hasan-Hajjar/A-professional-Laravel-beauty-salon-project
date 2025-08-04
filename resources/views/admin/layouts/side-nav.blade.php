    @if(auth()->user()->hasRole('admin')|| auth()->user()->hasRole('manager'))
          <aside class="main-sidebar sidebar-dark-primary elevation-4" style="text-align: right">
    @else
            <aside class="main-sidebar sidebar-light-primary elevation-4">
    @endif
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      @if(auth()->user()->profile_image)
      <img src="{{ asset('storage/'. auth()->user()->profile_image) }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      @else
          <p></p>
      @endif
      <span class="brand-text font-weight-light"> نظام إدارة الصالون </span>
    </a>


    <br>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-6 pb-6 mb-6 d-flex">
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }} - {{ auth()->user()->roles->pluck('name')->implode(', ') }} </a>
          <span class="text-muted"></span>
          <!-- صلاحيات المستخدم -->
        </div>
      </div>
    
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
            
              <p>
                   
                لوحة التحكم
           
              </p>
                <i class="nav-icon fas fa-tachometer-alt"></i>
            </a>
            <ul class="nav nav-treeview">
             
              <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                 
                  <p>الرئيسية</p>
                </a>
              </li>
              @if(auth()->user()->hasRole('admin')|| auth()->user()->hasRole('user'))
                  
              

              
              <li class="nav-item">
                <a href="{{ route('service-categories.index') }}" class="nav-link">
            
                  <p> فئات الخدمات  </p>
                </a>
              </li> 

             <li class="nav-item">
                <a href="{{ route('services.index') }}" class="nav-link">
                 
                  <p>  الخدمات  </p>
                </a>
              </li> 
          
           
            <li class="nav-item">
                <a href="{{ route('inventories.index') }}" class="nav-link">
              
                  <p>  المخزونات  </p>
                </a>
            </li> 

     

            <li class="nav-item">
                <a href="{{ route('clients.index') }}" class="nav-link">
                  
                  <p>  الزبائن </p>
                </a>
            </li> 

            <li class="nav-item">
                <a href="{{ route('appointments.index') }}" class="nav-link">
                
                  <p>  المواعيد </p>
                </a>
            </li> 

            <li class="nav-item">
                <a href="{{ route('appointment-services.index') }}" class="nav-link">
                
                  <p>   مواعيد خدمات </p>
                </a>
            </li> 

         
            <li class="nav-item">
                <a href="{{ route('notifications.index') }}" class="nav-link">
           
                  <p>    الإشعارات  </p>
                </a>
            </li> 

            <li class="nav-item">
                <a href="{{ route('offers.index') }}" class="nav-link">
             
                  <p>    العروض  </p>
                </a>
            </li> 

        
            <li class="nav-item">
                <a href="{{ route('reviews.index') }}" class="nav-link">
              
                  <p>    التقييمات  </p>
                </a>
            </li> 

        
            <li class="nav-item">
                <a href="{{ route('service-inventories.index') }}" class="nav-link">
               
                  <p>    مخزونات الخدمات  </p>
                </a>
            </li> 



            <li class="nav-item">
                <a href="{{ route('works.index') }}" class="nav-link">
              
                  <p>   أعمالنا   </p>
                </a>
            </li> 




            @endif
            @if(auth()->user()->hasRole('admin'))


                        <li class="nav-item">
                          <a href="{{ route('users.index') }}" class="nav-link">
                         
                            <p>المستخدمين</p>
                          </a>
                        </li>


                         
                        <li class="nav-item">
                            <a href="{{ route('employees.index') }}" class="nav-link">
                          
                              <p>  الموظفون  </p>
                            </a>
                        </li> 

                        <li class="nav-item">
                            <a href="{{ route('employee-schedules.index') }}" class="nav-link">
                           
                              <p>   جدولة الموظفين </p>
                            </a>
                        </li> 

   <li class="nav-item">
                <a href="{{ route('works.index') }}" class="nav-link">
              
                  <p>   أعمالنا   </p>
                </a>
            </li> 

             
               @endif
              <li class="nav-item">
                <a  href="/" class="nav-link">
                 
                  <p> الموقع</p>
                </a>
              </li>
              <li class="nav-item" style="margin-bottom: 10px">
                
                <a class="nav-link"style="margin-bottom: 10px" href="{{ route('logout') }}" 
                    onclick="event.preventDefault(); 
                    document.getElementById('logout-form').submit();">
                  
               
                    {{ __('تسجيل خروج') }} 
                </a>
                 <form id="logout-form" action="{{ route('logout') }}" 
                 method="POST" class="d-none">@csrf
                </form>
              </li>
             
            </ul>
            
          </li>
     
        
       
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>