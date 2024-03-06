<div class="d-flex card-barbg flex-column flex-shrink-0 p-4 fixed-top" style="width: 220px; height:100%; margin-top: 80px;">
    <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
        <a href="/" class="nav-link text-white <?=(Session::currentScript() == "index" || Session::currentScript() == "coinshop_dashboard"  || Session::currentScript() == "studyroom_dashboard") ? "active" : ""?> d-flex align-items-left" aria-current="page">
        <svg class="bi pe-none me-3 mt-1" width="16" height="16"><use xlink:href="#grid"/></svg>
        Dashboard
        </a>
    </li>
    <li class="mt-2">
        <a href="add" class="nav-link text-white <?=(Session::currentScript() == "add" || Session::currentScript() == "studyroom_add" || Session::currentScript() == "coinshop_add") ? "active" : ""?> d-flex align-items-left">
        <svg class="bi pe-none me-3 mt-1" width="16" height="16"><use xlink:href="#add"/></svg>
        Add
        </a>
    </li>
    <li class="mt-2">
        <a href="edit" class="nav-link text-white <?=(Session::currentScript() == "edit" || Session::currentScript() == "studyroom_edit" || Session::currentScript() == "coinshop_edit") ? "active" : ""?> d-flex align-items-left">
        <svg class="bi pe-none me-3 mt-1" width="16" height="16"><use xlink:href="#edit"/></svg>
        Edit
        </a>
    </li>
    <li class="mt-2">
        <a href="delete" class="nav-link text-white <?=(Session::currentScript() == "delete" || Session::currentScript() == "studyroom_delete" || Session::currentScript() == "coinshop_delete") ? "active" : ""?> d-flex align-items-left">
        <svg class="bi pe-none me-3 mt-1" width="16" height="16"><use xlink:href="#delete"/></svg>
        Delete
        </a>
    </li>
    <li class="mt-2">
        <a href="income" class="nav-link text-white <?=(Session::currentScript() == "income") ? "active" : ""?> d-flex align-items-left">
        <svg class="bi pe-none me-3 mt-1" width="16" height="16"><use xlink:href="#cashcoin"/></svg>
        Income
        </a>
    </li>
    </ul>
</div>
<div class="b-example-vr"></div>