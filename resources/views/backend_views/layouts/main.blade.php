<!DOCTYPE html>
<html lang="en">
@include('backend_views.layouts.head')
<body class="hold-transition sidebar-mini">
    <!--preloader
       <div id="preloader">
          <div id="status"></div>
       </div> -->
       <!-- Site wrapper -->
       <div class="wrapper">
@include('backend_views.layouts.header')
@include('backend_views.layouts.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="fa fa-dashboard"></i>
      </div>
      <div class="header-title">
        
     <h1>Ranthambore National Park</h1>
   
      </div>
   </section>
@yield('main-section')

@include('backend_views.layouts.footer')
       </div>
</body>
</html>