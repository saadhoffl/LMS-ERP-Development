<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
    <?php Session::loadTemplate('__meta') ?>
    <title>knowledegeuniverse - StudyRoom</title>
    <?php Session::loadTemplate('__links') ?>  
</head>


<body class="d-flex d-none d-sm-block h-100 text-center <?=(Session::currentScript() == "your_courses" || Session::currentScript() == "videos" || Session::currentScript() == "sub_courses" || Session::currentScript() == "description" || Session::currentScript() == "notes" || Session::currentScript() == "links" || Session::currentScript() == "guide") ? "scroll-container ps-2" : ""?>">       
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