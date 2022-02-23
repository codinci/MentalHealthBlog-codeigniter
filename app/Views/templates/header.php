<!doctype html>
<html>
    <head>
        <meta charset ="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="/assets/css/styles.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <title>Mental health Blog</title>
    </head>
    <body>
        <?php
            $uri = service('uri');
        ?>

        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
            <div class="container-fluid">
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">

                    <?php if (session()->get('isLoggedIn')): ?>
                        <a class="nav-link <?= ($uri->getSegment(1)== 'dashboard'? 'active' : null) ?>" href="/dashboard">Dashboard</a>
                        <a class="nav-link <?= ($uri->getSegment(1)== 'profile'? 'active' : null) ?>" href="/profile">Profile</a>  
                        <ul class="navbar-nav my-2 my-lg-0">     
                            <li class="nav-item">
                                <a class="nav-link" href="/logout">Logout</a>
                            </li>              
                        </ul>   
                    <?php else: ?>
                
                        <a class="nav-link <?= ($uri->getSegment(1)== 'home'? 'active' : null) ?>" href="/home">Home</a>
                        <a class="nav-link <?= ($uri->getSegment(1)== 'topics'? 'active' : null) ?>" href="/topics">Topics</a>
                        <a class="nav-link <?= ($uri->getSegment(1)== 'about'? 'active' : null) ?>" href="/about">About Us</a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </nav>


