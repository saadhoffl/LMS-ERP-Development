<header class="mb-auto nav-barbg p-1 me-4 pt-2 fixed-top">
    
    <div>
        <h4 class="float-md-start mb-0 ms-4 mt-1"><a class="text-white link-underline link-underline-opacity-0" 
            href="/">StudyRoom</a><span><h6><a class="text-white link-underline 
                link-underline-opacity-0" href="/">Knowledge Universe</a></h6></span></h4>

        <nav class="nav nav-masthead mt-2 justify-content-center float-md-end">

                <a class="nav-link fw-bold py-1 px-0" aria-current="page" href="http://localhost:8000/">Home</a>
                <a class="nav-link fw-bold py-1 px-0 active" href="http://localhost:8100/">StudyRoom</a>
                <a class="nav-link fw-bold py-1 px-0" href="http://localhost:8300/">CoinShop</a>
                <a class="nav-link fw-bold py-1 px-0" href="http://localhost:8200/">Courses</a>
                <a class="nav-link fw-bold py-1 px-0" href="http://localhost:8600/">ERP</a>
                <?
                    if(!Session::isAuthenticated()){
                        ?>
                        <a class="fw-bold btn btn-outline-light ms-3" href="http://localhost:8000/signin">Sign in</a>
                        <?
                    } else{
                        ?>
                        <a class="fw-bold btn btn-outline-light ms-3" href="/?logout">Sign out</a>
                        <?
                    }
                ?>
                
        </nav>
        
    </div>

</header>