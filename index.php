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
         background-image: url('./assets/bg-hero1.png'); 
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
                <a href="./events.php" class="btn btn-primary">Events -></a>
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
                    <a  class=" px-2" href="https://www.facebook.com/" target="_blank">
                      <i class="fab fa-2x fa-facebook"></i>
                    </a>
                  </li>
                  <li>
                    <a class=" px-2" href="https://www.instagram.com/" target="_blank">
                      <i class="fab fa-2x fa-instagram"></i>
                    </a>
                  </li>
                  <li>
                    <a  class=" ps-2" href="https://www.youtube.com/" target="_blank">
                      <i class="fab fa-2x fa-youtube"></i>
                    </a>
                  </li>
                  <li>
                    <a  class=" ps-2 mx-1" href="tel:+923110653748" target="_blank">
                      <i class="fa-2x fas fa-phone"></i>
                    </a>
                  </li>
                </ul>

              </div>
          
              <div class="col">
          
              </div>
          
              <div class="col">
                <h5>Circket</h5>
                <ul class="nav flex-column">
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Zakariya khan</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Ali khan</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Younus Fahad</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">SHahid ALi</a></li>
                </ul>
              </div>
          
              <div class="col">
                <h5>Football</h5>
                <ul class="nav flex-column">
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Taimur Akhtar</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Saood Faysal</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Arbaz Ali</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Shehryar</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Shehryar</a></li>
                </ul>
              </div>
          
              <div class="col">
                <h5>Badminton</h5>
                <ul class="nav flex-column">
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Majid khan</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Abdur-rehman</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Arbaz Ali</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Shehryar</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Ilyas</a></li>
                </ul>
              </div>

              <div class="col">
                <h5>PUBG</h5>
                <ul class="nav flex-column">
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Ali Shahid</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Adnan ali</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Ahmed</a></li>
                </ul>
              </div>
            </footer>
          </div>
    </div>


</body>

</html>