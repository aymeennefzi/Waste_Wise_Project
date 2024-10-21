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
<a href="{{ route('donations.admin.index') }}">
<i class="zmdi zmdi-money"></i>
 <span>Donations</span>
    </a>
</li>
<li>
<a href="{{ route('admin.campaigns.index') }}">
<i class="zmdi zmdi-assignment"></i><span>Campaigns</span>
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
    <a href="{{ route('communities.index') }}">
        <i class="zmdi zmdi-group"></i> <span>Communities</span>
    </a>
</li>
<li>
    <a href="{{ route('tasks.index') }}">
        <i class="zmdi zmdi-assignment"></i> <span>Tasks</span>
    </a>
</li>
      <li>
        <a href="{{ route('admin.itemposts.index') }}">
          <i class="zmdi zmdi-grid"></i> <span>Posts</span>
        </a>
      </li>
      <li>
        <a href="{{ route('events.index') }}">
            <i class="zmdi zmdi-calendar"></i> <span>Events</span>
        </a>
    </li>

    <li>
        <a href="{{ route('taskse.index') }}">
            <i class="zmdi zmdi-check-square"></i> <span>Event's Tasks</span>
        </a>
    </li>

    <li>
        <a href="{{ route('recycling_centers.admin')}}">
          <i class="zmdi zmdi-grid" ></i> <span>Recycling centers</span>
        </a>
      </li>
      <li>
        <a href="{{ route('materials.index')}}">
          <i class="zmdi zmdi-grid" ></i> <span>Materials</span>
        </a>
      </li>
    </ul>

   </div>
   <!--End sidebar-wrapper-->
