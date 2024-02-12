<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
    <?php Session::loadTemplate('__meta') ?>
    <title>lms-erp - HomeSearch</title>
    <?php Session::loadTemplate('__links') ?>  
</head>


<body class="d-flex h-100 text-center">       
    <?php Session::loadTemplate('__bodysvg') ?>
    
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column"> 

    <?
    if(Session::isAuthenticated()){
        if(Session::currentScript() == "index"){
            Session::loadTemplate('__complete_profile');
        } 
    }
    if(Session::isAuthenticated()){
        if(UserSession::is_fingerprint_allowed()){
            if(Session::currentScript() == "index"){
                Session::loadTemplate('__is_fingerprint_allowed');
            } 
        }
    }
    ?>

    <?php Session::loadTemplate('__header') ?>

    <? Session::loadTemplate("../../__controler__/__".Session::currentScript()) ?>

    <?php Session::loadTemplate('__footer') ?>          
    </div>
    
    <?php Session::loadTemplate('__script') ?>

    </div>
</body>

</html>