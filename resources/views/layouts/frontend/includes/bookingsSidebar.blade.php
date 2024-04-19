<div class="sidebar">
    <div class="logo_details">
      <i class="bx bxl-audible icon"></i>
      <div class="logo_name">Duck Inc.</div>
      <i class="bx bx-menu" id="btn"></i>
    </div>
    <ul class="nav-list">
      <li>
        <i class="bx bx-search"></i>
        <input type="text" placeholder="Search...">
         <span class="tooltip">Search</span>
      </li>
      <li>
        <a href="{{route('bookings')}}">
          <i class="bx bx-grid-alt"></i>
          <span class="link_name">Dashboard</span>
        </a>
        <span class="tooltip">Dashboard</span>
      </li>
      <li>
        <a href="{{route('trips')}}">
          <i class="bx bx-folder"></i>
          <span class="link_name">Trips</span>
        </a>
        <span class="tooltip">Trips</span>
      </li>
      
      <li>
        <a href="{{route('message')}}">
          <i class="bx bx-chat"></i>
          <span class="link_name">Message</span>
        </a>
        <span class="tooltip">Message</span>
      </li>


      <li class="profile">
        <a href="{{ route('home') }}" class="bx bx-log-out" id="log_out"></a>
      </li>
    </ul>
  </div>


