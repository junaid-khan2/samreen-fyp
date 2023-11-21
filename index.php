<?php


include("./init.php");

$page_title = "Sports Events";
?>


<html>

<?php include("layout/head.php"); ?>
<style>
    .menu a{
        color: white;
    }
    .menu a:hover{
        color: var(--primary-color);
    }
    .hero{
        height: 80vh;
         background-image: url('./assets/bg-hero.png'); 
         background-repeat: no-repeat; background-size: cover;
    }
</style>
<body class="home-layout">
    
    <section>
        <div class="container-fluid hero"  >
            <?php include("layout/header.php"); ?>
           <div class="row mt-5 p-5">
            <div class="col-6 mt-5">
                <h3 class="h3 text-light">Get ready to score big with our <br> comprehensive Coverage of all the <br> latest sports news and events</h3>
                <button class="btn btn-primary">Events -></button>
            </div>
           </div>
        </div>
        </section>
    <div class="page-content">
       
        <section style="padding: 5em">
            <div class="row">
                <div class="col-md-6">
                    <img src="./assets/home-2.svg" style="width: 100%;height:20em" />

                </div>
                <div class="col-md-6">
                    <h4> We believe in the power of sports, and that's why we're here.</h4>
                    <p>We want people from all walks of life to come together and get involved in sports. Whether you
                        love basketball or soccer or football, we can help you find a team, coach or player who will be
                        perfect for your skill level and size.</p>
                </div>
            </div>
        </section>

        <section style="padding: 5em">
            <div class="row" style="align-items: center;">
                <div class="col-md-6">
                    <p>People are naturally competitive, so we understand that some people might not want to play sports
                        simply
                        because they don't like the idea of competing with other people. We'd like to invite you to
                        register
                        for
                        our site because it's a great way to stay active and have fun while you do it. Our robust
                        platform
                        provides comprehensive solutions for managing team registrations, scheduling games, tracking
                        player
                        performance, and facilitating seamless communication between each player.
                    </p>
                </div>
                <div class="col-md-6">
                    <img src="./assets/home-1.svg" style="width: 100%;height:20em" />
                </div>
            </div>
        </section>


        <div class="container">
            <footer class="row row-cols-5 py-5 my-5 border-top">
              <div class="col">
                <a href="/" class="d-flex align-items-center mb-3 link-dark text-decoration-none">
                  <img src="./assets/logo.svg" alt="">
                </a>
                <ul class="list-unstyled d-flex flex-row justify-content-center">
                  <li>
                    <a style="color: var(--primary-color);" class=" px-2" href="#!">
                      <i class="fab fa-2x fa-facebook-square"></i>
                    </a>
                  </li>
                  <li>
                    <a style="color: var(--primary-color);" class=" px-2" href="#!">
                      <i class="fab fa-2x fa-instagram"></i>
                    </a>
                  </li>
                  <li>
                    <a style="color: var(--primary-color);" class=" ps-2" href="#!">
                      <i class="fab fa-2x fa-youtube"></i>
                    </a>
                  </li>
                </ul>

              </div>
          
              <div class="col">
          
              </div>
          
              <div class="col">
                <h5>Circket</h5>
                <ul class="nav flex-column">
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
                </ul>
              </div>
          
              <div class="col">
                <h5>Football</h5>
                <ul class="nav flex-column">
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
                </ul>
              </div>
          
              <div class="col">
                <h5>Badmintan</h5>
                <ul class="nav flex-column">
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
                </ul>
              </div>

              <div class="col">
                <h5>PUBG</h5>
                <ul class="nav flex-column">
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
                </ul>
              </div>
            </footer>
          </div>
    </div>


</body>

</html>