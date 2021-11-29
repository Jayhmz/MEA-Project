  <aside data-v-247f14f8="" id="leftsidebar" class="sidebar">
    <div class="navbar-brand"><button type="button" class="btn-menu ls-toggle-btn"><i class="zmdi zmdi-menu"></i></button><a href="index.html"><img src="{{asset('images/logo.png')}}" width="25" alt="Aero"><span class="m-l-10">Mission Enablers</span></a></div>
    <div class="menu">
      <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: calc(100vh - 65px);">
        <ul class="list" style="overflow-x: hidden; width: auto; height: calc(100vh - 65px);">
          <li>
            <div class="user-info">
              <div class="detail">
                <h4></h4><small>Administrator</small>
              </div>
            </div>
          </li>
          <li><a href="http://localhost:8080/app" class=" waves-effect waves-block"><i class="zmdi zmdi-home"></i><span>Dashboard</span>
            </a></li>
          <li><a href="javascript:void(0);" class="menu-toggle waves-effect waves-block"><i class="fa fa-building"></i><span>Agencies</span></a>
            <ul class="ml-menu">
              <li><a href="http://localhost:8080/app" class=" waves-effect waves-block">View All</a></li>
              <li><a href="http://localhost:8080/app" class=" waves-effect waves-block">Add New</a></li>
            </ul>
          </li>
          <li><a href="javascript:void(0);" class="menu-toggle waves-effect waves-block"><i class="fa fa-industry"></i><span>Missionaries</span></a>
            <ul class="ml-menu">
              <li><a href="/app/missionaries" class=" waves-effect waves-block">View All</a></li>
              <li><a href="/app/newmissionary" class=" waves-effect waves-block">Add New</a></li>
              <li><a href="/app/adoptions" class=" waves-effect waves-block">View Adoption History</a></li>
            </ul>
          </li>
          <li><a href="javascript:void(0);" class="menu-toggle waves-effect waves-block"><i class="fa fa-tasks"></i><span>Projects</span></a>
            <ul class="ml-menu">
              <li><a href="/app/projectcategories" class=" waves-effect waves-block">Projects Categories</a></li>
              <li><a href="/app/projects" class=" waves-effect waves-block">Projects</a></li>
            </ul>
          </li>
          <li><a href="/app/trips" class=" waves-effect waves-block"><i class="fa fa-plane-departure"></i><span>Trips</span></a></li>
          <li><a href="javascript:void(0);" class="menu-toggle waves-effect waves-block"><i class="fa fa-calendar"></i><span>Event</span></a>
            <ul class="ml-menu">
              <li><a href="/app/events" class=" waves-effect waves-block">Events</a></li>
              <li><a href="/app/event-categories" class=" waves-effect waves-block">Event Categories</a></li>
            </ul>
          </li>
          <li><a href="javascript:void(0);" class="menu-toggle waves-effect waves-block"><i class="fa fa-question-circle"></i><span>Enquiries</span></a>
            <ul class="ml-menu">
              <li><a href="/app/enquiries" class=" waves-effect waves-block">View all</a></li>
            </ul>
          </li>
          <li><a href="javascript:void(0);" class="menu-toggle waves-effect waves-block"><i class="fa fa-pray"></i><span>Prayer requests</span></a>
            <ul class="ml-menu">
              <li><a href="/app/prayerneeds" class=" waves-effect waves-block">View all</a></li>
            </ul>
          </li>
          <li><a href="javascript:void(0);" class="menu-toggle waves-effect waves-block"><i class="fa fa-handshake"></i><span>Partnerships</span></a>
            <ul class="ml-menu">
              <li><a href="/app/partnerships" class=" waves-effect waves-block">View all</a></li>
            </ul>
          </li>
          <li><a href="javascript:void(0);" class="menu-toggle waves-effect waves-block"><i class="fa fa-donate"></i><span>Donations</span></a>
            <ul class="ml-menu">
              <li><a href="/app/donations" class=" waves-effect waves-block">View all</a></li>
            </ul>
          </li>
          <li><a data-v-506d2460="" href="/app/videos" class=" waves-effect waves-block"><i data-v-506d2460="" class="fa fa-video"></i><span data-v-506d2460="">Videos</span></a></li>

          <li><a href="javascript:void(0);" class="menu-toggle waves-effect waves-block"><i class="far fa-tasks"></i><span>Reports</span></a>
            <ul class="ml-menu">
              <li><a href="{{route('view-reports')}}" class=" waves-effect waves-block">Manage Reports</a></li>
              <li><a href="{{route('report')}}" class=" waves-effect waves-block">Upload New Report</a></li>
            </ul>
          </li>
          <li><a href="javascript:void(0);" class="menu-toggle waves-effect waves-block"><i class="fas fa-calendar-edit"></i><span>Event Records</span></a>
            <ul class="ml-menu">
              <li><a href="{{route('admin.event-gallery')}}" class=" waves-effect waves-block">Manage Photos</a></li>
              <li><a href="{{route('admin.view-event-story')}}" class=" waves-effect waves-block">New Upload</a></li>
            </ul>
          </li>
          <!---->
          <li>
            <hr><a class=" waves-effect waves-block"><i class="fa fa-sign-out"></i><span>Logout</span></a>
          </li>
        </ul>

        <div class="slimScrollBar" style="background: rgb(238, 238, 238); width: 1px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 3px; z-index: 99; right: 1px; height: 499.868px;"></div>
        <div class="slimScrollRail" style="width: 1px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 0px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
      </div>
    </div>
    <div tabindex="0" aria-label="Loading" class="vld-overlay is-active is-full-page" style="display: none;">
      <div class="vld-background"></div>
      <div class="vld-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" height="40" width="40" fill="blue">
          <rect x="0" y="13" width="4" height="5">
            <animate attributeName="height" attributeType="XML" values="5;21;5" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
            <animate attributeName="y" attributeType="XML" values="13; 5; 13" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
          </rect>
          <rect x="10" y="13" width="4" height="5">
            <animate attributeName="height" attributeType="XML" values="5;21;5" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>
            <animate attributeName="y" attributeType="XML" values="13; 5; 13" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>
          </rect>
          <rect x="20" y="13" width="4" height="5">
            <animate attributeName="height" attributeType="XML" values="5;21;5" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
            <animate attributeName="y" attributeType="XML" values="13; 5; 13" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
          </rect>
        </svg></div>
    </div>
  </aside>
  </body>

  </html>