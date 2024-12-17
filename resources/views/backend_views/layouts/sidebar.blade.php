<style>
         .sidebar {
    position: fixed;
    height: 100vh; /* Full height of viewport */
    overflow-y: auto; /* Only vertical scroll */
}

.sidebar-menu {
    max-height: calc(100vh - 50px); /* Adjust this if you have a header above */
    overflow-y: auto;
    padding-bottom: 20px; /* Extra space at the bottom for smooth scrolling */
}

.sidebar-menu::-webkit-scrollbar {
    width: 8px;
}

.sidebar-menu::-webkit-scrollbar-thumb {
    background-color: #888; /* Custom scrollbar color */
    border-radius: 4px;
}
      </style>
<aside class="main-sidebar">

            <!-- sidebar -->

            <div class="sidebar">

               <!-- sidebar menu -->

               <ul class="sidebar-menu">
               @if(session('admin-auth.role') === 'admin')

               <li class="active">

                     <a href="{{route('admin_dashboard')}}"><i class="fa fa-tachometer"></i><span>Dashboard</span>

                     <span class="pull-right-container">

                     </span>

                     </a>

                  </li>

                  <li class="treeview">

                     <a href="{{route('show_details')}}">

                     <i class="fa fa-phone"></i><span>Contact Details</span>

                     </a>

                  </li> 

                  <li class="treeview">

                     <a href="{{route('show_enquiry_details')}}">

                     <i class="fa fa-phone"></i><span>Tour Enquiry Details</span>

                     </a>

                  </li> 

                  <li class="treeview">

                     <a href="{{route('quick_safari_booking_details')}}">

                     <i class="fa fa-phone"></i><span>Quick Safari Booking Queries</span>

                     </a>

                  </li> 

                  <li class="treeview">

                     <a href="{{route('show_safari_details')}}">

                     <i class="fa fa-info-circle"></i><span>Online Safari Booking Details</span>

                     </a>

                  </li> 
                  <li class="treeview">

                     <a href="{{route('show_safari_enquiry')}}">

                     <i class="fa fa-info-circle"></i><span>Online Safari Booking Enquiry</span>

                     </a>

                  </li>

                  <li class="treeview">

                     <a href="{{route('show_hotel_booking_details')}}">

                     <i class="fa fa-home"></i><span>Resort Booking Details</span>

                     </a>

                  </li> 
                  @elseif(session('admin-auth.role') === 'blogadmin')
                  <li class="treeview">

                     <a href="#">

                     <i class="fa fa-newspaper-o"></i><span>Blog Gallery</span>

                     <span class="pull-right-container">

                     <i class="fa fa-angle-left pull-right"></i>

                     </span>

                     </a>

                     <ul class="treeview-menu">

                        <li><a href="{{route('add_blog_gallery')}}">Add Images</a></li>

                        <li><a href="{{route('blog_gallery_details')}}">View Images</a></li>

                     </ul>

                    </li>

                  <li class="treeview">

                     <a href="#">

                     <i class="fa fa-newspaper-o"></i><span>News</span>

                     <span class="pull-right-container">

                     <i class="fa fa-angle-left pull-right"></i>

                     </span>

                     </a>

                     <ul class="treeview-menu">

                        <li><a href="{{route('news')}}">Add News</a></li>

                        <li><a href="{{route('show_news_details')}}">News Details</a></li>

                     </ul>

                    </li>

               
               @else

                  <li class="active">

                     <a href="{{route('admin_dashboard')}}"><i class="fa fa-tachometer"></i><span>Dashboard</span>

                     <span class="pull-right-container">

                     </span>

                     </a>

                  </li>

                  <li class="treeview">

                     <a href="{{route('show_details')}}">

                     <i class="fa fa-phone"></i><span>Contact Details</span>

                     </a>

                  </li> 

                  <li class="treeview">

                     <a href="{{route('show_enquiry_details')}}">

                     <i class="fa fa-phone"></i><span>Tour Enquiry Details</span>

                     </a>

                  </li> 

                  <li class="treeview">

                     <a href="{{route('quick_safari_booking_details')}}">

                     <i class="fa fa-phone"></i><span>Quick Safari Booking Queries</span>

                     </a>

                  </li> 

                  <li class="treeview">

                     <a href="{{route('show_safari_details')}}">

                     <i class="fa fa-info-circle"></i><span>Online Safari Booking Details</span>

                     </a>

                  </li> 
                  <li class="treeview">

                     <a href="{{route('show_safari_enquiry')}}">

                     <i class="fa fa-info-circle"></i><span>Online Safari Booking Enquiry</span>

                     </a>

                  </li>

                  <li class="treeview">

                     <a href="{{route('show_hotel_booking_details')}}">

                     <i class="fa fa-home"></i><span>Resort Booking Details</span>

                     </a>

                  </li> 

                  <!--<li class="treeview">-->

                  <!--   <a href="{{route('show_package_booking_details')}}">-->

                  <!--   <i class="fa fa-home"></i><span>Package Booking Details</span>-->

                  <!--   </a>-->

                  <!--</li> -->

                  <li class="treeview">

                   <a href="#">

                   <i class="fa fa-list"></i><span>Tour Management</span>

                   <span class="pull-right-container">

                   <i class="fa fa-angle-left pull-right"></i>

                   </span>

                   </a>

                   <ul class="treeview-menu">

                      <li><a href="{{route('show_add_tour_package')}}">Add Tour Package</a></li>

                      <li><a href="{{route('show_tour_package_details')}}">Tour Package Details</a></li>

                   </ul>

                  </li>

                  <li class="treeview">

                     <a href="#">

                     <i class="fa fa-list"></i><span>Hotel Management</span>

                     <span class="pull-right-container">

                     <i class="fa fa-angle-left pull-right"></i>

                     </span>

                     </a>

                     <ul class="treeview-menu">

                        <li><a href="{{route('show_hotel_form')}}">Add Hotel</a></li>

                        <li><a href="{{route('show_hotel_details')}}">Hotel Details</a></li>

                     </ul>

                  </li>

                  <li class="treeview">

                     <a href="#">

                     <i class="fa fa-newspaper-o"></i><span>Blog Gallery</span>

                     <span class="pull-right-container">

                     <i class="fa fa-angle-left pull-right"></i>

                     </span>

                     </a>

                     <ul class="treeview-menu">

                        <li><a href="{{route('add_blog_gallery')}}">Add Images</a></li>

                        <li><a href="{{route('blog_gallery_details')}}">View Images</a></li>

                     </ul>

                    </li>

                  <li class="treeview">

                     <a href="#">

                     <i class="fa fa-newspaper-o"></i><span>News</span>

                     <span class="pull-right-container">

                     <i class="fa fa-angle-left pull-right"></i>

                     </span>

                     </a>

                     <ul class="treeview-menu">

                        <li><a href="{{route('news')}}">Add News</a></li>

                        <li><a href="{{route('show_news_details')}}">News Details</a></li>

                     </ul>

                    </li>

                    <li class="treeview">

                     <a href="#">

                     <i class="fa fa-newspaper-o"></i><span>Tiger Story</span>

                     <span class="pull-right-container">

                     <i class="fa fa-angle-left pull-right"></i>

                     </span>

                     </a>

                     <ul class="treeview-menu">

                        <li><a href="{{route('add_tiger_story')}}">Add Tiger Story</a></li>

                        <!-- <li><a href="">News Details</a></li> -->

                     </ul>

                  </li>
                 

                  <li class="treeview">

                     <a href="{{url('payment_details')}}">

                     <i class="fa fa-credit-card"></i><span>Payment Details</span>

                     </a>

                  </li>

                  <li class="treeview">

                  <a href="{{url('user_lists')}}">

                  <i class="fa fa-credit-card"></i><span>User list</span>

                  </a>

                  </li>
                 

               @endif

               </ul>

            </div>

            <!-- /.sidebar -->

         </aside>

       