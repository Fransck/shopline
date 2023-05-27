

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <link rel="stylesheet" href="./lib/css/styl.css">
  <script src="./lib/js/script.js"></script>
</head>

<body>

      
    <!-- ======= Services Section ======= -->
    <section id="services">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Services</h2>
          <p>Bienvenue sur notre site de vente en ligne spécialisé dans les produits électroniques ! Nous sommes fiers de vous présenter notre sélection exclusive de produits électroniques haut de gamme, conçus pour améliorer votre quotidien et vous offrir des fonctionnalités de pointe.</p>
        </div>
        <br><br><br><br>

        <div class="slideshow-container">
  <div class="slideshow">
  <img class="slide" src="./admin/images/2.png">
    <img class="slide" src="./admin/images/pc.jpg">
    <img class="slide" src="./admin/images/xiomi.jpg">
    <img class="slide" src="./admin/images/ecouteur.jpg">
  </div>
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>


        <div class="row gy-4">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="box">
              <div class="icon"><i class="bi bi-briefcase"></i></div>
              <h4 class="title"><a href="">Reprise et recyclage des équipements électroniques </a></h4>
              <p class="description">Ce service permettrait aux clients de se débarrasser de leur ancien équipement électronique de manière responsable et écologique. La plateforme proposerait de récupérer les équipements usagés et de les recycler ou de les réutiliser.</p>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="box">
              <div class="icon"><i class="bi bi-card-checklist"></i></div>
              <h4 class="title"><a href="">Installation à domicile</a></h4>
              <p class="description">Ce service permettrait aux clients de bénéficier d'une assistance technique pour l'installation de leurs équipements électroniques à leur domicile. La plateforme proposerait l'intervention d'un technicien qualifié pour aider les clients à installer leur équipement et à le configurer selon leurs besoins.</p>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="box">
              <div class="icon"><i class="bi bi-bar-chart"></i></div>
              <h4 class="title"><a href="">Maintenance et de réparation</a></h4>
              <p class="description">Ce service permettrait aux clients de bénéficier d'un support technique pour la maintenance et la réparation de leurs équipements électroniques. La plateforme proposerait un service de dépannage à distance ou l'intervention d'un technicien qualifié à domicile pour résoudre les problèmes techniques.</p>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
            <div class="box">
              <div class="icon"><i class="bi bi-binoculars"></i></div>
              <h4 class="title"><a href="">Formation à l'utilisation des équipement</a></h4>
              <p class="description">Ce service permettrait aux clients de bénéficier d'une formation à l'utilisation de leurs équipements électroniques. La plateforme proposerait des sessions de formation en ligne ou à domicile pour aider les clients à mieux comprendre et utiliser leurs équipements électroniques. Les formations pourraient porter sur des sujets tels que la sécurité des données, la protection de la vie privée, l'utilisation des fonctionnalités avancées, etc.</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->

    

    <!-- ======= Contact Section ======= -->
    <section id="contact">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Nous conconter</h2>
          <p>Une equipe soudé a votre écoute</p>
        </div>

        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="bi bi-geo-alt"></i>
              <h3>Addresse</h3>
              <address>A108 Adam Street, NY 535022, MONS</address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="bi bi-phone"></i>
              <h3>GSM</h3>
              <p><a href="tel:+325895548855">+32 5589 55488 55</a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="bi bi-envelope"></i>
              <h3>Email</h3>
              <p><a href="mailto:info@example.com">info@techmk.com</a></p>
            </div>
          </div>

        </div>
      </div>

      <div class="container mb-4">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d22864.11283411948!2d-73.96468908098944!3d40.630720240038435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sbg!4v1540447494452" width="100%" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>

      <div class="container">
        <div class="form">
          <form action="forms/contact.php" method="post" role="form" class="php-email-form">
            <div class="row">
              <div class="form-group col-md-6">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
              </div>
              <div class="form-group col-md-6 mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
              </div>
            </div>
            <div class="form-group mt-3">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
            </div>

            <div class="my-3">
              <div class="loading"></div>
              <div class="error-message"></div>
              <div class="sent-message"></div>
            </div>

            <div class="text-center"><button type="submit">envoyer </button></div>
          </form>
        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        
      </div>
     
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


</body>

</html>



