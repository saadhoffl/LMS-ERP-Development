<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
    <?php Session::loadTemplate('__meta') ?>
    <title>knowledegeuniverse - ERP</title>
    <?php Session::loadTemplate('__links') ?>  
</head>


<body class="d-flex h-100 text-center <?=(Session::currentScript() == "index" || Session::currentScript() == "delete" || Session::currentScript() == "edit" || Session::currentScript() == "add" || Session::currentScript() == "income"  || Session::currentScript() == "coinshop_dashboard"  || Session::currentScript() == "studyroom_dashboard"  || Session::currentScript() == "coinshop_add"  || Session::currentScript() == "coinshop_edit"  || Session::currentScript() == "coinshop_delete") ? "scroll-container ps-2" : ""?>">       
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