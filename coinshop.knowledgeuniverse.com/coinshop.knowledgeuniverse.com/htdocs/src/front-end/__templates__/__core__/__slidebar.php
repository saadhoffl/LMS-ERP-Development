<div class="d-flex card-barbg flex-column flex-shrink-0 p-4 fixed-top" style="width: 220px; height:100%; margin-top: 80px;">
    <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
        <a href="/" class="nav-link text-white <?=(Session::currentScript() == "index") ? "active" : ""?> d-flex align-items-left" aria-current="page">
        <svg class="bi pe-none me-3 mt-1" width="16" height="16"><use xlink:href="#grid"/></svg>
        Dashboard
        </a>
    </li>
    <li class="mt-2">
        <a href="subcriptions" class="nav-link text-white <?=(Session::currentScript() == "subcriptions") ? "active" : ""?> d-flex align-items-left">
        <svg class="bi pe-none me-3 mt-1" width="16" height="16"><use xlink:href="#subcriptions"/></svg>
        Subcriptions
        </a>
    </li>
    <li class="mt-2">
        <a href="services" class="nav-link text-white <?=(Session::currentScript() == "services") ? "active" : ""?> d-flex align-items-left">
        <svg class="bi pe-none me-3 mt-1" width="16" height="16"><use xlink:href="#services"/></svg>
        Services
        </a>
    </li>
    <li class="mt-2">
        <a href="courses" class="nav-link text-white <?=(Session::currentScript() == "courses") ? "active" : ""?> d-flex align-items-left">
        <svg class="bi pe-none me-3 mt-1" width="16" height="16"><use xlink:href="#courses"/></svg>
        Courses
        </a>
    </li>
    <li class="mt-2">
        <a href="purchases" class="nav-link text-white <?=(Session::currentScript() == "purchases") ? "active" : ""?> d-flex align-items-left">
        <svg class="bi pe-none me-3 mt-1" width="16" height="16"><use xlink:href="#cart"/></svg>
        Purchases
        </a>
    </li>
    <li class="mt-2">
        <a href="my_credits" class="nav-link text-white <?=(Session::currentScript() == "my_credits") ? "active" : ""?> d-flex align-items-left">
        <svg class="bi pe-none me-3 mt-1" width="16" height="16"><use xlink:href="#cashcoin"/></svg>
        My Credits
        </a>
    </li>
    </ul>
</div>
<div class="b-example-vr"></div>