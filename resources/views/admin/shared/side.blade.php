<aside>
      <div id="sidebar" class="nav-collapse ">
      
        <ul class="sidebar-menu">

          <li class="@if(Request::segment(2) == 'home') active @endif">
            <a class="" href="{{route('admin_home')}}">
                  <i class="icon_house_alt"></i>
                  <span>Home</span>
            </a>
          </li>
         
          <li class="@if(Request::segment(2) == 'events') active @endif">
          <a href="{{route('admin_events')}}">
                  <i class="icon_star"></i>
                  <span>Events</span>
            </a>
          </li>

          <li class="@if(Request::segment(2) == 'candidates') active @endif">
          <a href="{{route('admin_get_candidates')}}">
                  <i class="icon_group"></i>
                  <span>Candidates</span>
            </a>
          </li>

          <li class="@if(Request::segment(2) == 'judges-list') active @endif">
          <a href="{{route('admin_judges_list')}}">
                  <i class="icon_pens"></i>
                  <span>Judges</span>
            </a>
          </li>
          
          
          
        </ul>
        
      </div>
    </aside>