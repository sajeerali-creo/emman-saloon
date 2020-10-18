<section class="bg-home h-100vh">
    <nav class="navbar navbar-expand-lg fixed-top mt-3">
      <div class="container">
        <a class="navbar-brand" href="<?php echo base_url() ?>">
          <img src="<?php echo base_url() ?>assets/web/img/logo.png">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
          aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarText">
          <ul class="nav">
      
            <li class="nav-item">
              <a class="nav-link text-white" href="https://emansalon.com/profile/" target="_blank">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="<?php echo base_url() ?>service">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="https://emansalon.com/gallery-style/" target="_blank">Gallery</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="https://emansalon.com/contact-us/" target="_blank">Contact Us</a>
            </li><?php 
            if(!isset($frontLogin) || $frontLogin != true){
                ?><li class="nav-item">
                  <a class="nav-link text-white btn btn-success mr-md-2 ml-md-2 mb-1" href="<?php echo base_url() ?>login">Login</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white btn btn-primary" href="<?php echo base_url() ?>register" target="_blank">Register</a>
                </li><?php
            }
            else{
                ?><li class="nav-item">
                  <a class="nav-link text-white" href="<?php echo base_url() ?>logout">Logout</a>
                </li><?php
            }
          ?></ul>
        </div>
      </div>
    </nav>



    <div class="container">
      <div class="d-flex h-100vh align-items-center">
        <div>
          <div class="h1 d-block text-white mt-5">
            Book your Next services with Us
          </div>
          <div class="small d-block mb-5">
            Here at Eman, we offer a wide range of beauty services
          </div>

          <div class="h4 d-block mb-5 text-white">
            Select where you want our srvice
          </div>
          <div class="mt-5">
            <div>
              <button type="button" class="btn btn-primary btn-lg d-flex align-items-center">
                <a href="<?php echo base_url() ?>map" class="text-white text-decoration-none">
                  @ Home
                  Services
                </a>
              </button>
            </div>
          </div>

          <div class="mt-8">
            <div class="d-flex">
              <i class="fab fa-facebook-f social"></i>
              <i class="fab fa-twitter social"></i>
              <i class="fab fa-google-plus-g social"></i>
              <i class="fab fa-instagram social"></i>
            </div>
          </div>

        </div>
      </div>
      <div>
        <button class="d-block">
          <a href="https://api.whatsapp.com/send?phone=971564849878&text=book%20your%20service%20though%20whatsapp" target="_blank" class="align-items-center d-flex text-decoration-none text-white"
          style="border: 0px!important; z-index: 2147483639!important; position: fixed!important; bottom: 19px!important;
  border-radius: 160px; width: 60px!important; height: 60px!important; overflow: hidden!important; opacity: 1!important; max-width: 100%!important; right: 96px!important;
  max-height: 100%!important; text-align: center; justify-content: center; display: flex; align-items: center; background: #1cc88a;"
          >
            <i class="fab fa-whatsapp h3"></i>
          </a>
        </button>
      </div>
    </div>

      <!-- Start of ChatBot (www.chatbot.com) code -->
        <script type="text/javascript">
          window.__be = window.__be || {};
          window.__be.id = "5f8b16e60485e900068a4c93";
          (function () {
              var be = document.createElement('script'); be.type = 'text/javascript'; be.async = true;
              be.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.chatbot.com/widget/plugin.js';
              var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(be, s);
          })();
        </script>
      <!-- End of ChatBot code -->

  </section>