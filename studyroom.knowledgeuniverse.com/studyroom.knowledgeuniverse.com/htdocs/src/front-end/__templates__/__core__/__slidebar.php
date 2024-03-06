<div class="d-flex card-barbg flex-column flex-shrink-0 p-4 fixed-top" style="width: 220px; height:100%; margin-top: 80px;">
    <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
        <a href="/" class="nav-link text-white <?=(Session::currentScript() == "index") ? "active" : ""?> d-flex align-items-left" aria-current="page">
        <svg class="bi pe-none me-3 mt-1" width="16" height="16"><use xlink:href="#home"/></svg>
        Home
        </a>
    </li>
    <li class="mt-2">
        <a href="your_courses" class="nav-link text-white <?=(Session::currentScript() == "your_courses" || Session::currentScript() == "sub_courses" || Session::currentScript() == "videos" || Session::currentScript() == "video_courses" || Session::currentScript() == "description" || Session::currentScript() == "notes" || Session::currentScript() == "links" || Session::currentScript() == "guide") ? "active" : ""?> d-flex align-items-left">
        <svg class="bi pe-none me-3 mt-1" width="16" height="16"><use xlink:href="#courses"/></svg>
        Your Courses
        </a>
    </li>
    <li class="mt-2">
        <a href="exam_center" class="nav-link text-white <?=(Session::currentScript() == "exam_center") ? "active" : ""?> d-flex align-items-left">
        <svg class="bi pe-none me-3 mt-1" width="16" height="16"><use xlink:href="#exams"/></svg>
        Exam Center
        </a>
    </li>
    <li class="mt-2">
        <a href="notifications" class="nav-link text-white <?=(Session::currentScript() == "notifications") ? "active" : ""?> d-flex align-items-left">
        <svg class="bi pe-none me-3 mt-1" width="16" height="16"><use xlink:href="#notifications"/></svg>
        Notifications
        </a>
    </li>
    </ul>
</div>
<div class="b-example-vr"></div>