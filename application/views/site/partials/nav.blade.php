<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">

  	<div class="row-fluid fluid-nav">
    <a class="brand" href="{{URL::to_route('newsletters_all')}}">Newsletters</a>
    
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
    </ul>
    {{-- ------------------------   Main Nav   ------------------------ --}}
    
    <form class="navbar-search pull-left">
      <input id="type" type="text" class="search-query input-xxlarge" data-provide="typeahead">
    </form>


    <div class="pull-right">
      <ul class="nav pull-right">
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, {{ Auth::user()->username }} <b class="caret"></b></a>
              <ul class="dropdown-menu">
                  <li><a href="#"><i class="icon-cog"></i> Preferences</a></li>
                  <li><a href="#"><i class="icon-envelope"></i> Contact Support</a></li>
                  <li class="divider"></li>
                  <li><a href="/logout"><i class="icon-off"></i> Logout</a></li>
              </ul>
          </li>
      </ul>
    </div>

    </div>


  </div>
</div>