<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
    <?php Session::loadTemplate('__meta') ?>
    <title>knowledegeuniverse - HomeSearch</title>
    <?php Session::loadTemplate('__links') ?>  
</head>


<body class="d-flex h-100 text-center">       
    <?php Session::loadTemplate('__svgicons') ?>
    
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column"> 

    <?
    if(!UserData::is_id_proof_completed()){
        if(Session::isAuthenticated()){
            if(Session::currentScript() == "index"){
                if(!User::verifyEmail()){
                    header("Location: verify_account");
                }else{
                    Session::loadTemplate('__complete_profile');
                }
            } 
        }
    }

    if(Session::isAuthenticated()){
        if(UserSession::is_fingerprint_allowed()){
            if(Session::currentScript() == "index"){
                if(!User::verifyEmail()){
                    header("Location: verify_account");
                }else{
                    Session::loadTemplate('__is_fingerprint_allowed');
                }
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