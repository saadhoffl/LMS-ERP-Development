<header class="mb-auto">
    
    <div>
        <h3 class="float-md-start mb-0"><a class="text-white link-underline link-underline-opacity-0" 
            href="/">lms-erp</a><span><h6><a class="text-white link-underline 
                link-underline-opacity-0" href="/">Universe</a></h6></span></h3>

        <nav class="nav nav-masthead justify-content-center float-md-end">
                <a class="nav-link fw-bold py-1 px-0 active" aria-current="page" href="/">Home</a>
                <a class="nav-link fw-bold py-1 px-0" href="#">StudyRoom</a>
                <a class="nav-link fw-bold py-1 px-0" href="#">CoinShop</a>
                <a class="nav-link fw-bold py-1 px-0" href="#">Courses</a>
                <a class="nav-link fw-bold py-1 px-0" href="#">More</a>
                <?
                    if(!Session::isAuthenticated()){
                        ?>
                        <a class="fw-bold btn btn-outline-light ms-3" href="/signin">Sign in</a>
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