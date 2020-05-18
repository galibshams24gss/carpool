<li class="nav-item" ng-if="userLogin"><a class="nav-link pointer color_white font-weight-bold" href="/search">Search</a></li>
<li class="nav-item" ng-if="userLogin"><a class="nav-link pointer color_white font-weight-bold">My Bookings</a></li>
<li class="nav-item dropdown" ng-if="userLogin&&isAdmin">
    <a class="nav-link pointer dropdown-toggle color_white font-weight-bold" id="navbarDropdown1" data-target="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
    <ul class="dropdown-menu background-less-black" aria-labelledby="navbarDropdown1">
        <li><a class="dropdown-item color_white font-weight-bold" href="/home">Dashboard</a></li>
        <li><a class="dropdown-item color_white font-weight-bold" href="/">Reporting</a></li>
        <li><a class="dropdown-item color_white font-weight-bold" href="/home">Car Pool Locations</a></li>
        <li><a class="dropdown-item color_white font-weight-bold" href="/vehicles">Car Pool Fleet</a></li>
        <li><a class="dropdown-item color_white font-weight-bold" href="/home">User Groups</a></li>
        <li><a class="dropdown-item color_white font-weight-bold" href="/home">Cost Centres</a></li>
    </ul>
</li>
<li class="nav-item dropdown" ng-if="userLogin">
    <a class="nav-link pointer dropdown-toggle color_white font-weight-bold" id="navbarDropdown2" data-target="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">My Account</a>
    <ul class="dropdown-menu background-less-black" aria-labelledby="navbarDropdown2">
        <li><a class="dropdown-item color_white font-weight-bold" href="">Reset Password</a></li>
    </ul>
</li>
<li class="nav-item" ng-if="userLogin"><a class="nav-link pointer color_white font-weight-bold" ng-click="logOut()">Log Out</a></li>
<li class="nav-item" ng-if="!userLogin"><a class="nav-link pointer color_white font-weight-bold" href="/login">Log In</a></li>