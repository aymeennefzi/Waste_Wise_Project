<!--Start sidebar-wrapper-->
<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
      <a href="index.html">
       <img src="{{ asset('Back_office/assets/images/loder.png')}}" class="logo-icon" alt="logo icon">
       <h5 class="logo-text">Waste wise</h5>
     </a>
   </div>
   <ul class="sidebar-menu do-nicescrol">
      <li class="sidebar-header">MAIN NAVIGATION</li>
      <li>
    <a href="{{ route('dashboard') }}">
        <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
    </a>
</li>

      <li>
        <a href="profile.html">
          <i class="zmdi zmdi-face"></i> <span>Collecte</span>
        </a>
      </li>
      <li>
        <a  href="{{ route('admin.adviceType') }}" >
          <i class="zmdi zmdi-book"></i> <span>Advice Types</span>
        </a>
      </li>

      <li>
        <a href="{{ route('admin.WasteTips') }}">
          <i class="zmdi zmdi-format-list-bulleted"></i> <span>Waste tips</span>
        </a>
      </li>

      <li>
        <a href="{{ route('admin.collectionCenter') }}">
          <i class="zmdi zmdi-grid"></i> <span>Centre de collecte</span>
        </a>
      </li>

      <li>
        <a href="calendar.html">
          <i class="zmdi zmdi-calendar-check"></i> <span>Chauffeur</span>
        </a>
      </li>

    

      <li>
        <a href="login.html" target="_blank">
          <i class="zmdi zmdi-lock"></i> <span>Login</span>
        </a>
      </li>

       <li>
        <a href="register.html" target="_blank">
          <i class="zmdi zmdi-account-circle"></i> <span>Registration</span>
        </a>
      </li>

      <li class="sidebar-header">LABELS</li>
      <li><a href="javaScript:void();"><i class="zmdi zmdi-coffee text-danger"></i> <span>Important</span></a></li>
      <li><a href="javaScript:void();"><i class="zmdi zmdi-chart-donut text-success"></i> <span>Warning</span></a></li>
      <li><a href="javaScript:void();"><i class="zmdi zmdi-share text-info"></i> <span>Information</span></a></li>

    </ul>
   
   </div>
   <!--End sidebar-wrapper-->