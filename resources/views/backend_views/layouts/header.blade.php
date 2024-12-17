<header class="main-header">
    <a href="{{url('admin/dashboard')}}" class="logo">
       <!-- Logo -->
       <span class="logo-mini">
       <img src="{{asset('public/backend/assets/dist/img/ico/png-24.png') }}" class="img-circle" width="45" height="45" alt="user">
       </span>
       <span class="logo-lg">
       <img src="{{asset('public/rantham-textNew.webp') }}" style="width:100%">
       <!--<h2 class="text-success">Seven Safar</h2>-->
       </span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
         <!-- Sidebar toggle button-->
         <span class="sr-only">Toggle navigation</span>
         <span class="pe-7s-angle-left-circle"></span>
      </a>
      <!-- searchbar-->
      <div class="navbar-custom-menu">
         <ul class="nav navbar-nav">
            <!-- Orders -->
            <li class="dropdown dropdown-help hidden-xs">
               <a class="text-white" style="margin-top:15px;">
               </a>
            </li>
            <!-- user -->
            <li class="dropdown dropdown-user">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <img src="{{ asset('public/backend/assets/dist/img/avatar5.png') }}" class="img-circle" width="45" height="45" alt="user"></a>
               <ul class="dropdown-menu" >
                  <li><a href="{{url('logout')}}">
                     <i class="fa fa-sign-out"></i> Signout</a>
                  </li>
               </ul>
            </li>
         </ul>
      </div>
   </nav> 
 </header>