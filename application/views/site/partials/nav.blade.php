<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
  	<div class="row-fluid fluid-nav">
    <a class="brand" href="{{URL::to_route('newsletters_all')}}">Newsletters</a>
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
            <li><a href="/bricks">View All</a></li>
            <li class="divider"></li>
            <li><a href="/bricks/new">Add New</a></li>
          </ul>
        </a>
      </li>

    </ul>
    </div>
  </div>
</div>