<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
    <?php Session::loadTemplate('__meta') ?>
    <title>knowledegeuniverse - StudyRoom</title>
    <?php Session::loadTemplate('__links') ?>  
</head>


<body class="d-flex h-100 text-center <?=(Session::currentScript() == "index" || Session::currentScript() == "purchases" || Session::currentScript() == "my_credits" || Session::currentScript() == "subcriptions") ? "scroll-container ps-2" : ""?>">       
    <?php Session::loadTemplate('__svgicons') ?>
    
    <div class="cover-container d-flex w-100 h-100 mx-auto flex-column"> 

    <?php Session::loadTemplate('__header') ?>

    <main class="d-flex flex-nowrap">
    <?php Session::loadTemplate('__slidebar') ?>
    <div class="album py-5">
    <? Session::loadTemplate("../../__controler__/__".Session::currentScript()) ?>
    </div>
    </main>

    <?php Session::loadTemplate('__footer') ?>          
    </div>
    
    <?php Session::loadTemplate('__script') ?>

    </div>
</body>

</html>