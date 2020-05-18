<li class="nav-item" ng-if="userLogin"><a class="nav-link pointer color_white" href="/search">Search</a></li>
<li class="nav-item dropdown" ng-if="userLogin&&isAdmin">
    <a class="nav-link pointer dropdown-toggle color_white" id="navbarDropdown1" data-target="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
    <ul class="dropdown-menu background-less-black" aria-labelledby="navbarDropdown1">
        <li><a class="dropdown-item color_white" href="/home">Dashboard</a></li>
        <li><a class="dropdown-item color_white" href="/">Reporting</a></li>
        <li><a class="dropdown-item color_white" href="/home">Car Pool Locations</a></li>
        <li><a class="dropdown-item color_white" href="/vehicles">Car Pool Fleet</a></li>
        <li><a class="dropdown-item color_white" href="/home">User Groups</a></li>
        <li><a class="dropdown-item color_white" href="/home">Cost Centres</a></li>
    </ul>
</li>
<li class="nav-item" ng-if="userLogin"><a class="nav-link pointer" ng-click="logOut()">Log Out</a></li>
<li class="nav-item" ng-if="!userLogin"><a class="nav-link pointer" href="/login">Log In</a></li>