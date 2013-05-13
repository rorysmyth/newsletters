<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">

  	<div class="row-fluid fluid-nav">
    <a class="brand" href="{{URL::to_route('newsletters_all')}}">Newsletters (dev)</a>
    
    {{-- ------------------------   Main Nav   ------------------------ --}}
    <ul class="nav">  
      <li class="dropdown">
        <a href="" class="dropdown-toggle" data-toggle="dropdown">
          Newsletters
          <b class="caret"></b>
          <ul class="dropdown-menu">
            <li><a href="{{URL::to_route('newsletters_all')}}">View All</a></li>
            <li class="divider"></li>
            <li><a href="{{URL::to_route('newsletters_new')}}">Add New</a></li>
          </ul>
        </a>
      </li>
      <li class="dropdown">
        <a href="" class="dropdown-toggle" data-toggle="dropdown">
          Templates
          <b class="caret"></b>
          <ul class="dropdown-menu">
            <li><a href="/templates">View All</a></li>
            <li class="divider"></li>
            <li><a href="/templates/new">Add New</a></li>
            <li><a href="{{URL::to_route('template_make')}}">Make</a></li>
          </ul>
        </a>
      </li>
      <li class="dropdown">
        <a href="" class="dropdown-toggle" data-toggle="dropdown">
          Sites
          <b class="caret"></b>
          <ul class="dropdown-menu">
            <li><a href="/sites">View All</a></li>
            <li class="divider"></li>
            <li><a href="/sites/new">Add New</a></li>
          </ul>
        </a>
      </li>
      <li class="dropdown">
        <a href="" class="dropdown-toggle" data-toggle="dropdown">
          Admin
          <b class="caret"></b>
          <ul class="dropdown-menu">
            <li><a href="{{URL::to_route('users')}}">Users</a></li>
            <li><a href="{{URL::to_route('roles')}}">Roles</a></li>
            <li><a href="{{URL::to_route('permissions')}}">Permissions</a></li>
          </ul>
        </a>
      </li>
    </ul>
    {{-- ------------------------   Main Nav   ------------------------ --}}
    
    <form class="navbar-search pull-left">
      <input id="type" type="text" class="search-query" data-provide="typeahead">
    </form>


    <div class="pull-right">
      <ul class="nav pull-right">
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, {{ Auth::user()->username }} <b class="caret"></b></a>
              <ul class="dropdown-menu">
                  <li><a href="#"><i class="icon-question-sign"></i> Help</a></li>
                  <li class="divider"></li>
                  <li class="nav-header">bugs</li>
                  <li><a href="{{URL::to_route('bugs')}}"><i class="icon-eye-open"></i> View Bugs</a></li>
                  <li><a href="{{URL::to_route('bug_new')}}"><i class="icon-plus"></i> Report Bug</a></li>
                  <li class="divider"></li>
                  <li><a href="/logout"><i class="icon-off"></i> Logout</a></li>
              </ul>
          </li>
      </ul>
    </div>

    </div>


  </div>
</div>