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
                  <a class="nav-link text-white btn btn-success mr-md-2 ml-md-2 mb-1" href="<?php echo base_url() ?>login" target="_blank">Login</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white btn btn-primary" href="<?php echo base_url() ?>register" target="_blank">Register</a>
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
      <div class="d-flex justify-content-end fixed-bottom mr-5 mb-5">
        <button class="btn btn-primary btn-circle btn-circle-lg m-1 align-items-center d-flex">
          <i class="far fa-question-circle h3"></i>
        </button>
        <button class="btn btn-success btn-circle btn-circle-lg m-1">
          <a href="https://api.whatsapp.com/send?phone=971564849878&text=book%20your%20service%20though%20whatsapp" class="align-items-center d-flex text-decoration-none text-white">
            <i class="fab fa-whatsapp h3"></i>
          </a>
        </button>
      </div>
    </div>



  </section>