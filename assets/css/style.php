<?php

// Define que o arquivo terá a codificação de saída no formato CSS
header("Content-type: text/css");

include '../../adm/system/conexao.php';

$conf = $pdo->query("SELECT * FROM CONFIGURACOES");
$list = $conf->fetchAll(PDO::FETCH_ASSOC);
foreach($list as $confValues){}

?>


/**
* Template Name: Lumia - v2.1.0
* Template URL: https://bootstrapmade.com/lumia-bootstrap-business-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/

/*--------------------------------------------------------------
# General
--------------------------------------------------------------*/

html{
    --principal: <?php echo $confValues['conf_cor_principal'] ?>;
    --secundaria: <?php echo $confValues['conf_cor_secundaria'] ?>;
}


body {
  font-family: "Open Sans", sans-serif;
  color: #444444;
}

a {
  color: var(--principal);
}

a:hover {
  color: var(--principal);
  text-decoration: none;
}

h1, h2, h3, h4, h5, h6 {
  font-family: "Raleway", sans-serif;
}

/*--------------------------------------------------------------
# Back to top button
--------------------------------------------------------------*/
.back-to-top {
  position: fixed;
  display: none;
  right: 15px;
  bottom: 15px;
  z-index: 99999;
}

.back-to-top i {
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  width: 40px;
  height: 40px;
  border-radius: 4px;
  background: var(--principal);
  color: #fff;
  transition: all 0.4s;
}

.back-to-top i:hover {
  background: var(--secundaria);
  color: #fff;
}

/*--------------------------------------------------------------
# Header
--------------------------------------------------------------*/
#header {
  height: 70px;
  transition: all 0.5s;
  z-index: 997;
  transition: all 0.5s;
  background: #fff;
  box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
}

#header .logo h1 {
  font-size: 28px;
  margin: 0;
  font-weight: 600;
  letter-spacing: 1px;
  text-transform: uppercase;
  color: #384046;
}

#header .logo h1 a, #header .logo h1 a:hover {
  color: #384046;
  text-decoration: none;
}

#header .logo img {
  max-height: 40px;
}

/*--------------------------------------------------------------
# Header Social Links
--------------------------------------------------------------*/
.header-social-links a {
  color: #9ba6af;
  padding-left: 8px;
  display: inline-block;
  line-height: 1px;
  transition: 0.3s;
}

.header-social-links a:hover {
  color: var(--principal);
}

@media (max-width: 768px) {
  .header-social-links {
    padding-right: 48px;
  }
  .header-social-links a {
    padding-left: 6px;
  }
}

/*--------------------------------------------------------------
# Navigation Menu
--------------------------------------------------------------*/
/* Desktop Navigation */
.nav-menu, .nav-menu * {
  margin: 0;
  padding: 0;
  list-style: none;
}

.nav-menu > ul > li {
  position: relative;
  white-space: nowrap;
  float: left;
}

.nav-menu a {
  display: block;
  position: relative;
  color: #4f5a62;
  padding: 12px 15px;
  transition: 0.3s;
  font-size: 16px;
  font-weight: 500;
  font-family: "Poppins", sans-serif;
}

.nav-menu a:hover, .nav-menu .active > a, .nav-menu li:hover > a {
  color: var(--principal);
  text-decoration: none;
}

.nav-menu .drop-down ul {
  display: block;
  position: absolute;
  left: 0;
  top: calc(100% + 30px);
  z-index: 99;
  opacity: 0;
  visibility: hidden;
  padding: 10px 0;
  background: #fff;
  box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);
  transition: ease all 0.3s;
}

.nav-menu .drop-down:hover > ul {
  opacity: 1;
  top: 100%;
  visibility: visible;
}

.nav-menu .drop-down li {
  min-width: 180px;
  position: relative;
}

.nav-menu .drop-down ul a {
  padding: 10px 20px;
  font-size: 14px;
  text-transform: none;
  color: #21262a;
  font-weight: 400;
}

.nav-menu .drop-down ul a:hover, .nav-menu .drop-down ul .active > a, .nav-menu .drop-down ul li:hover > a {
  color: var(--principal);
}

.nav-menu .drop-down > a:after {
  content: "\ea99";
  font-family: IcoFont;
  padding-left: 5px;
}

.nav-menu .drop-down .drop-down ul {
  top: 0;
  left: calc(100% - 30px);
}

.nav-menu .drop-down .drop-down:hover > ul {
  opacity: 1;
  top: 0;
  left: 100%;
}

.nav-menu .drop-down .drop-down > a {
  padding-right: 35px;
}

.nav-menu .drop-down .drop-down > a:after {
  content: "\eaa0";
  font-family: IcoFont;
  position: absolute;
  right: 15px;
}

@media (max-width: 1366px) {
  .nav-menu .drop-down .drop-down ul {
    left: -90%;
  }
  .nav-menu .drop-down .drop-down:hover > ul {
    left: -100%;
  }
  .nav-menu .drop-down .drop-down > a:after {
    content: "\ea9d";
  }
}

/* Mobile Navigation */
.mobile-nav-toggle {
  position: fixed;
  right: 15px;
  top: 20px;
  z-index: 9998;
  border: 0;
  background: none;
  font-size: 24px;
  transition: all 0.4s;
  outline: none !important;
  line-height: 1;
  cursor: pointer;
  text-align: right;
}

.mobile-nav-toggle i {
  color: #384046;
}

.mobile-nav {
  position: fixed;
  top: 55px;
  right: 15px;
  bottom: 15px;
  left: 15px;
  z-index: 9999;
  overflow-y: auto;
  background: #fff;
  transition: ease-in-out 0.2s;
  opacity: 0;
  visibility: hidden;
  border-radius: 10px;
  padding: 10px 0;
}

.mobile-nav * {
  margin: 0;
  padding: 0;
  list-style: none;
}

.mobile-nav a {
  display: block;
  position: relative;
  color: #384046;
  padding: 10px 20px;
  font-weight: 500;
  outline: none;
}

.mobile-nav a:hover, .mobile-nav .active > a, .mobile-nav li:hover > a {
  color: var(--principal);
  text-decoration: none;
}

.mobile-nav .drop-down > a:after {
  content: "\ea99";
  font-family: IcoFont;
  padding-left: 10px;
  position: absolute;
  right: 15px;
}

.mobile-nav .active.drop-down > a:after {
  content: "\eaa1";
}

.mobile-nav .drop-down > a {
  padding-right: 35px;
}

.mobile-nav .drop-down ul {
  display: none;
  overflow: hidden;
}

.mobile-nav .drop-down li {
  padding-left: 20px;
}

.mobile-nav-overly {
  width: 100%;
  height: 100%;
  z-index: 9997;
  top: 0;
  left: 0;
  position: fixed;
  background: rgba(33, 38, 42, 0.6);
  overflow: hidden;
  display: none;
  transition: ease-in-out 0.2s;
}

.mobile-nav-active {
  overflow: hidden;
}

.mobile-nav-active .mobile-nav {
  opacity: 1;
  visibility: visible;
}

.mobile-nav-active .mobile-nav-toggle i {
  color: #fff;
}

/*--------------------------------------------------------------
# Hero Section
--------------------------------------------------------------*/
#hero {
  width: 100%;
  height: calc(100vh - 70px);
  padding: 0;
  overflow: hidden;
}

#hero .carousel-item {
  width: 100%;
  height: calc(100vh - 70px);
  background-size: cover;
  background-position: top right;
  background-repeat: no-repeat;
  overflow: hidden;
}

#hero .carousel-item::before {
  content: '';
  background: -webkit-linear-gradient(rgba(0,0,0,0), rgba(0,0,0,1));
  background: -o-linear-gradient(rgba(0,0,0,0), rgba(0,0,0,1));
  background: -moz-linear-gradient(rgba(0,0,0,0), rgba(0,0,0,1));
  background: linear-gradient(rgba(0,0,0,0), rgba(0,0,0,1));
  position: absolute;
  height: 100%;
  width: 100%;
  top: 0;
  right: 0;
  left: 0;
  bottom: 0;
  overflow: hidden;
}

#hero .carousel-container {
  display: flex;
  justify-content: center;
  align-items: center;
  position: absolute;
  bottom: 0;
  top: 0;
  left: 0;
  right: 0;
  overflow: hidden;
}

#hero .carousel-content {
  text-align: left;
  margin-top: 30%;
}

@media (max-width: 992px) {
  #hero, #hero .carousel-item {
    height: calc(100vh - 70px);
  }
  #hero .carousel-content.container {
    padding: 0 50px;
  }
}

#hero h2 {
  color: #fff;
  margin-bottom: 10px;
  font-size: 48px;
  font-weight: 900;
}

#hero p {
  width: 80%;
  -webkit-animation-delay: 0.4s;
  animation-delay: 0.4s;
  color: #fff;
}

#hero .carousel-inner .carousel-item {
  transition-property: opacity;
  background-position: center top;
}

#hero .carousel-inner .carousel-item,
#hero .carousel-inner .active.carousel-item-left,
#hero .carousel-inner .active.carousel-item-right {
  opacity: 0;
}

#hero .carousel-inner .active,
#hero .carousel-inner .carousel-item-next.carousel-item-left,
#hero .carousel-inner .carousel-item-prev.carousel-item-right {
  opacity: 1;
  transition: 0.5s;
}

#hero .carousel-inner .carousel-item-next,
#hero .carousel-inner .carousel-item-prev,
#hero .carousel-inner .active.carousel-item-left,
#hero .carousel-inner .active.carousel-item-right {
  left: 0;
  transform: translate3d(0, 0, 0);
}

#hero .carousel-control-prev, #hero .carousel-control-next {
  width: 10%;
}

#hero .carousel-control-next-icon, #hero .carousel-control-prev-icon {
  background: none;
  font-size: 48px;
  line-height: 1;
  width: auto;
  height: auto;
}

#hero .carousel-indicators li {
  cursor: pointer;
}

#hero .btn-get-started {
  font-family: "Raleway", sans-serif;
  font-weight: 500;
  font-size: 14px;
  letter-spacing: 1px;
  display: inline-block;
  padding: 12px 32px;
  border-radius: 5px;
  transition: 0.5s;
  line-height: 1;
  margin: 10px;
  color: #fff;
  -webkit-animation-delay: 0.8s;
  animation-delay: 0.8s;
  border: 0;
  background: var(--principal);
}

#hero .btn-get-started:hover {
  background: var(--secundaria);
}

@media (max-width: 768px) {
  #hero h2 {
    font-size: 28px;
  }
}

@media (min-width: 1024px) {
  #hero p {
    width: 60%;
  }
  #hero .carousel-control-prev, #hero .carousel-control-next {
    width: 5%;
  }
}


/*--------------------------------------------------------------
# Sections General
--------------------------------------------------------------*/
section {
  padding: 60px 0;
}

.section-bg {
  /* background-color: #f7fbfe; */
  background-color: #f8f9fa;
}

.section-title {
  text-align: center;
  padding-bottom: 30px;
}

.section-title h2 {
  font-size: 32px;
  font-weight: 600;
  margin-bottom: 20px;
  padding-bottom: 20px;
  position: relative;
}

.section-title h2::before {
  content: '';
  position: absolute;
  display: block;
  width: 120px;
  height: 1px;
  background: #ddd;
  bottom: 1px;
  left: calc(50% - 60px);
}

.section-title h2::after {
  content: '';
  position: absolute;
  display: block;
  width: 40px;
  height: 3px;
  background: var(--principal);
  bottom: 0;
  left: calc(50% - 20px);
}

.section-title p {
  margin-bottom: 0;
}

/*--------------------------------------------------------------
# What We Do
--------------------------------------------------------------*/
.what-we-do .icon-box {
  text-align: center;
  padding: 30px 20px;
  transition: all ease-in-out 0.3s;
  background: #fff;
}

.what-we-do .icon-box .icon {
  margin: 0 auto;
  width: 64px;
  height: 64px;
  background: #eaf4fb;
  border-radius: 50px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 20px;
  transition: ease-in-out 0.3s;
}

.what-we-do .icon-box .icon i {
  color: var(--principal);
  font-size: 28px;
}

.what-we-do .icon-box h4 {
  font-weight: 700;
  margin-bottom: 15px;
  font-size: 24px;
}

.what-we-do .icon-box h4 a {
  color: #384046;
  transition: ease-in-out 0.3s;
}

.what-we-do .icon-box p {
  line-height: 24px;
  font-size: 14px;
  margin-bottom: 0;
}

.what-we-do .icon-box:hover {
  border-color: #fff;
  box-shadow: 0px 0 25px 0 rgba(0, 0, 0, 0.1);
}

.what-we-do .icon-box:hover h4 a, .what-we-do .icon-box:hover .icon i {
  color: var(--principal);
}

/*--------------------------------------------------------------
# About
--------------------------------------------------------------*/
.about {
  padding: 10px 0;
}

.about img{
  width: 100%;
}

.about h3 {
  font-weight: 600;
  font-size: 32px;
}

.about ul {
  list-style: none;
  padding: 0;
  font-size: 15px;
}

.about ul li + li {
  margin-top: 10px;
}

.about ul li {
  position: relative;
  padding-left: 26px;
}

.about ul i {
  position: absolute;
  left: 0;
  top: 0;
  font-size: 22px;
  color: var(--principal);
}

.about .icon-boxes {
  padding-top: 10px;
}

.about .icon-boxes h4 {
  font-size: 20px;
  font-weight: 700;
  margin-top: 5px;
}

.about .icon-boxes i {
  font-size: 48px;
  color: var(--principal);
}

.about .icon-boxes p {
  font-size: 15px;
  color: #848484;
}

/*--------------------------------------------------------------
# Skills
--------------------------------------------------------------*/
.skills .progress {
  height: 50px;
  display: block;
  background: none;
}

.skills .progress .skill {
  padding: 10px 0;
  margin: 0 0 6px 0;
  text-transform: uppercase;
  display: block;
  font-weight: 600;
  font-family: "Poppins", sans-serif;
  color: #384046;
}

.skills .progress .skill .val {
  float: right;
  font-style: normal;
}

.skills .progress-bar-wrap {
  background: #e8eaec;
}

.skills .progress-bar {
  width: 1px;
  height: 10px;
  transition: .9s;
  background-color: var(--principal);
}

/*--------------------------------------------------------------
# Counts
--------------------------------------------------------------*/
.counts {
  background: white;
  padding: 30px 0 40px 0;
}

.counts .count-box {
  padding: 30px 30px 25px 30px;
  width: 100%;
  position: relative;
  text-align: center;
  background: #fff;
}

.counts .count-box i {
  position: absolute;
  top: -25px;
  left: 50%;
  transform: translateX(-50%);
  font-size: 25px;
  background: var(--principal);
  padding: 16px;
  color: #fff;
  border-radius: 50%;
  width: 60px;
  height: 60px;
}

.counts .count-box span {
  font-size: 36px;
  display: block;
  font-weight: 600;
  color: #124364;
}

.counts .count-box p {
  padding: 0;
  margin: 0;
  font-family: "Raleway", sans-serif;
  font-size: 14px;
}

/*--------------------------------------------------------------
# Services
--------------------------------------------------------------*/
.services .icon-box {
  padding: 30px;
  border-radius: 6px;
  background: #fff;
  transition: ease-in-out 0.3s;
}

.services .icon-box i {
  float: left;
  color: var(--principal);
  font-size: 40px;
}

.services .icon-box h4 {
  margin-left: 70px;
  font-weight: 700;
  margin-bottom: 15px;
  font-size: 18px;
}

.services .icon-box h4 a {
  color: #384046;
  transition: 0.3s;
}

.services .icon-box p {
  margin-left: 70px;
  line-height: 24px;
  font-size: 14px;
}

.services .icon-box:hover {
  box-shadow: 0px 2px 22px rgba(0, 0, 0, 0.08);
}

.services .icon-box:hover h4 a {
  color: var(--principal);
}

/*--------------------------------------------------------------
# Portfolio
--------------------------------------------------------------*/
.portfolio {
  padding: 60px 0;
}

.portfolio #portfolio-flters {
  padding: 0;
  margin: 0 0 35px 0;
  list-style: none;
  text-align: center;
}

.portfolio #portfolio-flters li {
  cursor: pointer;
  margin: 0 15px 15px 0;
  display: inline-block;
  padding: 10px 20px;
  font-size: 12px;
  line-height: 20px;
  color: #444444;
  border-radius: 4px;
  text-transform: uppercase;
  background: #fff;
  margin-bottom: 5px;
  transition: all 0.3s ease-in-out;
}

.portfolio #portfolio-flters li:hover, .portfolio #portfolio-flters li.filter-active {
  background: var(--principal);
  color: #fff;
}

.portfolio #portfolio-flters li:last-child {
  margin-right: 0;
}

.portfolio .portfolio-wrap {
  box-shadow: 0px 2px 12px rgba(0, 0, 0, 0.08);
  transition: 0.3s;
}

.portfolio .portfolio-wrap:hover {
  box-shadow: 0px 4px 14px rgba(0, 0, 0, 0.16);
}

.portfolio .portfolio-item {
  position: relative;
  height: 360px;
  overflow: hidden;
}

.portfolio .portfolio-item figure {
  background: #000;
  overflow: hidden;
  height: 240px;
  position: relative;
  border-radius: 4px 4px 0 0;
  margin: 0;
}

.portfolio .portfolio-item figure:hover img {
  opacity: 0.4;
  transition: .4s;
}

.portfolio .portfolio-item figure .link-preview, .portfolio .portfolio-item figure .link-details {
  position: absolute;
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  line-height: 0;
  text-align: center;
  width: 36px;
  height: 36px;
  background: #fff;
  border-radius: 50%;
  transition: all .2s linear;
  overflow: hidden;
  font-size: 20px;
}

.portfolio .portfolio-item figure .link-preview i, .portfolio .portfolio-item figure .link-details i {
  color: #384046;
  line-height: 0;
}

.portfolio .portfolio-item figure .link-preview:hover, .portfolio .portfolio-item figure .link-details:hover {
  background: var(--principal);
}

.portfolio .portfolio-item figure .link-preview:hover i, .portfolio .portfolio-item figure .link-details:hover i {
  color: #fff;
}

.portfolio .portfolio-item figure .link-preview {
  left: calc(50% - 38px);
  top: calc(50% - 18px);
}

.portfolio .portfolio-item figure .link-details {
  right: calc(50% - 38px);
  top: calc(50% - 18px);
}

.portfolio .portfolio-item figure:hover .link-preview {
  opacity: 1;
  left: calc(50% - 44px);
}

.portfolio .portfolio-item figure:hover .link-details {
  opacity: 1;
  right: calc(50% - 44px);
}

.portfolio .portfolio-item .portfolio-info {
  background: #fff;
  text-align: center;
  padding: 30px;
  height: 90px;
  border-radius: 0 0 3px 3px;
}

.portfolio .portfolio-item .portfolio-info h4 {
  font-size: 18px;
  line-height: 1px;
  font-weight: 700;
  margin-bottom: 18px;
  padding-bottom: 0;
}

.portfolio .portfolio-item .portfolio-info h4 a {
  color: #333;
}

.portfolio .portfolio-item .portfolio-info h4 a:hover {
  color: var(--principal);
}

.portfolio .portfolio-item .portfolio-info p {
  padding: 0;
  margin: 0;
  color: #b8b8b8;
  font-weight: 500;
  font-size: 14px;
  text-transform: uppercase;
}

/*--------------------------------------------------------------
# Breadcrumbs
--------------------------------------------------------------*/
.breadcrumbs {
  padding: 15px 0;
  background-color: #f3f8fa;
  min-height: 40px;
}

.breadcrumbs h2 {
  font-size: 28px;
  font-weight: 300;
}

.breadcrumbs ol {
  display: flex;
  flex-wrap: wrap;
  list-style: none;
  padding: 0;
  margin: 0;
}

.breadcrumbs ol li + li {
  padding-left: 10px;
}

.breadcrumbs ol li + li::before {
  display: inline-block;
  padding-right: 10px;
  color: #6c757d;
  content: "/";
}

@media (max-width: 768px) {
  .breadcrumbs .d-flex {
    display: block !important;
  }
  .breadcrumbs ol {
    display: block;
  }
  .breadcrumbs ol li {
    display: inline-block;
  }
}


/*--------------------------------------------------------------
# Blog
--------------------------------------------------------------*/
.blog {
  padding: 40px 0 20px 0;
}

.blog .entry {
  padding: 30px;
  margin-bottom: 60px;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
}

.blog .entry .entry-img {
  max-height: 400px;
  margin: -30px -30px 20px -30px;
  overflow: hidden;
}

.blog .entry .entry-img img{
  min-width: 100%;
}

.blog .entry .entry-title {
  font-size: 28px;
  font-weight: bold;
  padding: 0;
  margin: 0 0 20px 0;
}

.blog .entry .entry-title a {
  color: var(--principal);
  transition: 0.3s;
}

.blog .entry .entry-title a:hover {
  color: var(--secundaria);
}

.blog .entry .entry-meta {
  margin-bottom: 15px;
  color: #dddddd;
}

.blog .entry .entry-meta ul {
  display: flex;
  flex-wrap: wrap;
  list-style: none;
  padding: 0;
  margin: 0;
}

.blog .entry .entry-meta ul li + li {
  padding-left: 15px;
}

.blog .entry .entry-meta i {
  font-size: 14px;
  padding-right: 4px;
}

.blog .entry .entry-meta a {
  color: #aaaaaa;
  font-size: 14px;
  display: inline-block;
}

.blog .entry .entry-content p {
  line-height: 24px;
}

.blog .entry .entry-content .read-more {
  -moz-text-align-last: right;
  text-align-last: right;
}

.blog .entry .entry-content .read-more a {
  font-family: "Raleway", sans-serif;
  font-weight: 500;
  font-size: 14px;
  letter-spacing: 1px;
  display: inline-block;
  padding: 12px 32px;
  border-radius: 5px;
  transition: 0.5s;
  line-height: 1;
  margin: 10px;
  color: #fff;
  -webkit-animation-delay: 0.8s;
  animation-delay: 0.8s;
  border: 0;
  background: var(--principal);
}

.read-more a {
  font-family: "Raleway", sans-serif;
  font-weight: 500;
  font-size: 14px;
  letter-spacing: 1px;
  display: inline-block;
  padding: 12px 32px;
  border-radius: 5px;
  transition: 0.5s;
  line-height: 1;
  margin: 10px;
  color: #fff;
  -webkit-animation-delay: 0.8s;
  animation-delay: 0.8s;
  border: 0;
  background: var(--principal);
}

.blog .entry .entry-content .read-more a:hover {
  background: var(--secundaria);
}

.blog .entry .entry-content h3 {
  font-size: 22px;
  margin-top: 30px;
  font-weight: bold;
}

.blog .entry .entry-content blockquote {
  overflow: hidden;
  background-color: #fafafa;
  padding: 60px;
  position: relative;
  text-align: center;
  margin: 20px 0;
}

.blog .entry .entry-content blockquote p {
  color: #444;
  line-height: 1.6;
  margin-bottom: 0;
  font-style: italic;
  font-weight: 500;
  font-size: 22px;
}

.blog .entry .entry-content blockquote .quote-left {
  position: absolute;
  left: 20px;
  top: 20px;
  font-size: 36px;
  color: #e7e7e7;
}

.blog .entry .entry-content blockquote .quote-right {
  position: absolute;
  right: 20px;
  bottom: 20px;
  font-size: 36px;
  color: #e7e7e7;
}

.blog .entry .entry-content blockquote::after {
  content: '';
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  width: 3px;
  background-color: #32627b;
  margin-top: 20px;
  margin-bottom: 20px;
}

.blog .entry .entry-footer {
  padding-top: 10px;
  border-top: 1px solid #e6e6e6;
}

.blog .entry .entry-footer i {
  color: #4c99c1;
  display: inline;
}

.blog .entry .entry-footer a {
  color: var(--principal);
  transition: 0.3s;
}

.blog .entry .entry-footer a:hover {
  color: var(--secundaria);
}

.blog .entry .entry-footer .cats {
  list-style: none;
  display: inline;
  padding: 0 20px 0 0;
  font-size: 14px;
}

.blog .entry .entry-footer .cats li {
  display: inline-block;
}

.blog .entry .entry-footer .tags {
  list-style: none;
  display: inline;
  padding: 0;
  font-size: 14px;
}

.blog .entry .entry-footer .tags li {
  display: inline-block;
}

.blog .entry .entry-footer .tags li + li::before {
  padding-right: 6px;
  color: #6c757d;
  content: ",";
}

.blog .entry .entry-footer .share {
  font-size: 16px;
}

.blog .entry .entry-footer .share i {
  padding-left: 5px;
}

.blog .entry-single {
  margin-bottom: 30px;
}

.blog .blog-author {
  padding: 20px;
  margin-bottom: 30px;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
}

.blog .blog-author img {
  width: 120px;
}

.blog .blog-author h4 {
  margin-left: 140px;
  font-weight: 600;
  font-size: 22px;
  margin-bottom: 0px;
  padding: 0;
}

.blog .blog-author .social-links {
  margin: 0 0 5px 140px;
}

.blog .blog-author .social-links a {
  color: #72afce;
}

.blog .blog-author p {
  margin-left: 140px;
  font-style: italic;
  color: #b7b7b7;
}

.blog .blog-comments {
  margin-bottom: 30px;
}

.blog .blog-comments .comments-count {
  font-weight: bold;
}

.blog .blog-comments .comment {
  margin-top: 30px;
  position: relative;
}

.blog .blog-comments .comment .comment-img {
  width: 50px;
}

.blog .blog-comments .comment h5 {
  margin-left: 65px;
  font-size: 16px;
  margin-bottom: 2px;
}

.blog .blog-comments .comment h5 a {
  font-weight: bold;
  color: #444;
  transition: 0.3s;
}

.blog .blog-comments .comment h5 a:hover {
  color: #68A4C4;
}

.blog .blog-comments .comment h5 .reply {
  padding-left: 10px;
  color: #32627b;
}

.blog .blog-comments .comment time {
  margin-left: 65px;
  display: block;
  font-size: 14px;
  color: #72afce;
  margin-bottom: 5px;
}

.blog .blog-comments .comment p {
  margin-left: 65px;
}

.blog .blog-comments .comment.comment-reply {
  padding-left: 40px;
}

.blog .blog-comments .reply-form {
  margin-top: 30px;
  padding: 30px;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
}

.blog .blog-comments .reply-form h4 {
  font-weight: bold;
  font-size: 22px;
}

.blog .blog-comments .reply-form p {
  font-size: 14px;
}

.blog .blog-comments .reply-form input {
  border-radius: 0;
  padding: 20px 10px;
  font-size: 14px;
}

.blog .blog-comments .reply-form input:focus {
  box-shadow: none;
  border-color: #a2cce3;
}

.blog .blog-comments .reply-form textarea {
  border-radius: 0;
  padding: 10px 10px;
  font-size: 14px;
}

.blog .blog-comments .reply-form textarea:focus {
  box-shadow: none;
  border-color: #a2cce3;
}

.blog .blog-comments .reply-form .form-group {
  margin-bottom: 25px;
}

.blog .blog-comments .reply-form .btn-primary {
  border-radius: 0;
  padding: 10px 20px;
  border: 0;
  background-color: #32627b;
}

.blog .blog-comments .reply-form .btn-primary:hover {
  background-color: #68A4C4;
}

.blog .blog-pagination {
  color: #7b9bab;
}

.blog .blog-pagination ul {
  display: flex;
  padding-left: 0;
  list-style: none;
}

.blog .blog-pagination li {
  border: 1px solid white;
  margin: 0 5px;
  transition: 0.3s;
}

.blog .blog-pagination li.active {
  background: white;
}

.blog .blog-pagination li a {
  color: #aaaaaa;
  padding: 7px 16px;
  display: inline-block;
}

.blog .blog-pagination li.active, .blog .blog-pagination li:hover {
  background: #68A4C4;
  border: 1px solid #68A4C4;
}

.blog .blog-pagination li.active a, .blog .blog-pagination li:hover a {
  color: #fff;
}

.blog .blog-pagination li.disabled {
  background: #fff;
  border: 1px solid white;
}

.blog .blog-pagination li.disabled i {
  color: #f1f1f1;
  padding: 10px 16px;
  display: inline-block;
}

.blog .sidebar {
  padding: 30px;
  margin: 0 0 60px 20px;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
}

.blog .sidebar .sidebar-title {
  font-size: 20px;
  font-weight: 700;
  padding: 0 0 0 0;
  margin: 0 0 15px 0;
  color: #32627b;
  position: relative;
}

.blog .sidebar .sidebar-item {
  margin-bottom: 30px;
}

.blog .sidebar .search-form form {
  background: #fff;
  border: 1px solid #ddd;
  padding: 3px 10px;
  position: relative;
}

.blog .sidebar .search-form form input[type="text"] {
  border: 0;
  padding: 4px;
  width: calc(100% - 40px);
}

.blog .sidebar .search-form form button {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  border: 0;
  background: none;
  font-size: 16px;
  padding: 0 15px;
  margin: -1px;
  background: #32627b;
  color: #fff;
  transition: 0.3s;
}

.blog .sidebar .search-form form button:hover {
  background: #68A4C4;
}

.blog .sidebar .categories ul {
  list-style: none;
  padding: 0;
}

.blog .sidebar .categories ul li + li {
  padding-top: 10px;
}

.blog .sidebar .categories ul a {
  color: #3f8db5;
}

.blog .sidebar .categories ul a:hover {
  color: #68A4C4;
}

.blog .sidebar .categories ul a span {
  padding-left: 5px;
  color: #bedae8;
  font-size: 14px;
}

.blog .sidebar .recent-posts .post-item + .post-item {
  margin-top: 15px;
}

.blog .sidebar .recent-posts img {
  width: 80px;
  float: left;
}

.blog .sidebar .recent-posts h4 {
  font-size: 15px;
  margin-left: 95px;
  font-weight: bold;
}

.blog .sidebar .recent-posts h4 a {
  color: #0d2735;
  transition: 0.3s;
}

.blog .sidebar .recent-posts h4 a:hover {
  color: #68A4C4;
}

.blog .sidebar .recent-posts time {
  display: block;
  margin-left: 95px;
  font-style: italic;
  font-size: 14px;
  color: #72afce;
}

.blog .sidebar .tags {
  margin-bottom: -10px;
}

.blog .sidebar .tags ul {
  list-style: none;
  padding: 0;
}

.blog .sidebar .tags ul li {
  display: inline-block;
}

.blog .sidebar .tags ul a {
  color: #3f8db5;
  font-size: 14px;
  padding: 6px 14px;
  margin: 0 6px 8px 0;
  border: 1px solid #e4eff5;
  display: inline-block;
  transition: 0.3s;
}

.blog .sidebar .tags ul a:hover {
  color: #fff;
  border: 1px solid #32627b;
  background: #32627b;
}

.blog .sidebar .tags ul a span {
  padding-left: 5px;
  color: #bedae8;
  font-size: 14px;
}

/*--------------------------------------------------------------
# Clients
--------------------------------------------------------------*/
.clients .clients-wrap {
  border-top: 1px solid #eceff0;
  border-left: 1px solid #eceff0;
}

.clients .client-logo {
  display: flex;
  justify-content: center;
  align-items: center;
  border-right: 1px solid #eceff0;
  border-bottom: 1px solid #eceff0;
  overflow: hidden;
  background: #fff;
  height: 120px;
  padding: 40px;
}

.clients .client-logo img {
  max-width: 50%;
  -webkit-filter: grayscale(100);
  filter: grayscale(100);
}

.clients .client-logo:hover img {
  -webkit-filter: none;
  filter: none;
  transform: scale(1.1);
}

.clients img {
  transition: all 0.4s ease-in-out;
}

/*--------------------------------------------------------------
# Testimonials
--------------------------------------------------------------*/
.testimonials .testimonial-item {
  box-sizing: content-box;
  padding: 30px;
  margin: 30px 15px;
  text-align: center;
  /* min-height: 210px; */
  box-shadow: 0px 2px 12px rgba(0, 0, 0, 0.08);
  background: #fff;
}

.testimonials .testimonial-item .testimonial-img {
  width: 90px;
  border-radius: 50%;
  border: 4px solid #fff;
  margin: 0 auto;
}

.testimonials .testimonial-item h3 {
  font-size: 18px;
  font-weight: bold;
  margin: 10px 0 5px 0;
  color: #111;
}

.testimonials .testimonial-item h4 {
  font-size: 14px;
  color: #999;
  margin: 0;
}

.testimonials .testimonial-item .quote-icon-left, .testimonials .testimonial-item .quote-icon-right {
  color: #e1f0fa;
  font-size: 26px;
}

.testimonials .testimonial-item .quote-icon-left {
  display: inline-block;
  left: -5px;
  position: relative;
}

.testimonials .testimonial-item .quote-icon-right {
  display: inline-block;
  right: -5px;
  position: relative;
  top: 10px;
}

.testimonials .testimonial-item p {
  font-style: italic;
  margin: 0 auto 15px auto;
}

.testimonials .owl-nav, .testimonials .owl-dots {
  margin-top: 5px;
  text-align: center;
}

.testimonials .owl-dot {
  display: inline-block;
  margin: 0 5px;
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background-color: #ddd !important;
}

.testimonials .owl-dot.active {
  background-color: var(--principal) !important;
}

@media (max-width: 767px) {
  .testimonials {
    margin: 30px 10px;
  }
}

/*--------------------------------------------------------------
# Team
--------------------------------------------------------------*/
.team .member {
  text-align: center;
  margin-bottom: 20px;
  box-shadow: 0px 0px 12px 0px rgba(0, 0, 0, 0.1);
  padding: 30px 20px;
  background: #fff;
}

.team .member img {
  max-width: 60%;
  border-radius: 50%;
  margin: 0 0 30px 0;
}

.team .member h4 {
  font-weight: 700;
  margin-bottom: 2px;
  font-size: 18px;
}

.team .member span {
  font-style: italic;
  display: block;
  font-size: 13px;
}

.team .member p {
  padding-top: 10px;
  font-size: 14px;
  font-style: italic;
  color: #aaaaaa;
}

.team .member .social {
  margin-top: 15px;
}

.team .member .social a {
  color: #919191;
  transition: 0.3s;
}

.team .member .social a:hover {
  color: var(--principal);
}

.team .member .social i {
  font-size: 18px;
  margin: 0 2px;
}

/*--------------------------------------------------------------
# Pricing
--------------------------------------------------------------*/
.pricing .box {
  padding: 20px;
  background: #fff;
  text-align: center;
  box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.12);
  border-radius: 5px;
  position: relative;
  overflow: hidden;
}

.pricing .box h3 {
  font-weight: 400;
  margin: -20px -20px 20px -20px;
  padding: 20px 15px;
  font-size: 16px;
  font-weight: 600;
  color: #777777;
  background: #f8f8f8;
}

.pricing .box h4 {
  font-size: 36px;
  color: var(--principal);
  font-weight: 600;
  font-family: "Poppins", sans-serif;
  margin-bottom: 20px;
}

.pricing .box h4 sup {
  font-size: 20px;
  top: -15px;
  left: -3px;
}

.pricing .box h4 span {
  color: #bababa;
  font-size: 16px;
  font-weight: 300;
}

.pricing .box ul {
  padding: 0;
  list-style: none;
  color: #444444;
  text-align: center;
  line-height: 20px;
  font-size: 14px;
}

.pricing .box ul li {
  padding-bottom: 16px;
}

.pricing .box ul i {
  color: var(--principal);
  font-size: 18px;
  padding-right: 4px;
}

.pricing .box ul .na {
  color: #ccc;
  text-decoration: line-through;
}

.pricing .btn-wrap {
  margin: 20px -20px -20px -20px;
  padding: 20px 15px;
  background: #f8f8f8;
  text-align: center;
}

.pricing .btn-buy {
  background: var(--principal);
  display: inline-block;
  padding: 8px 35px 10px 35px;
  border-radius: 4px;
  color: #fff;
  transition: none;
  font-size: 14px;
  font-weight: 400;
  font-family: "Roboto", sans-serif;
  font-weight: 600;
  transition: 0.3s;
}

.pricing .btn-buy:hover {
  background: var(--secundaria);
}

.pricing .featured h3 {
  color: #fff;
  background: var(--principal);
}

.pricing .advanced {
  width: 200px;
  position: absolute;
  top: 26px;
  right: -63px;
  transform: rotate(45deg);
  z-index: 1;
  font-size: 14px;
  padding: 1px 0 3px 0;
  background: var(--principal);
  color: #fff;
}

/*--------------------------------------------------------------
# Frequently Asked Questions
--------------------------------------------------------------*/
.faq {
  padding: 60px 0;
}

.faq .faq-list {
  padding: 0;
  list-style: none;
}

.faq .faq-list li {
  padding: 0 0 20px 25px;
}

.faq .faq-list a {
  display: block;
  position: relative;
  font-family: var(--principal);
  font-size: 18px;
  font-weight: 500;
}

.faq .faq-list i {
  font-size: 18px;
  position: absolute;
  left: -25px;
  top: 6px;
}

.faq .faq-list p {
  margin-bottom: 20px;
  font-size: 15px;
}

.faq .faq-list a.collapse {
  color: var(--principal);
}

.faq .faq-list a.collapsed {
  color: #343a40;
}

.faq .faq-list a.collapsed:hover {
  color: var(--principal);
}

.faq .faq-list a.collapsed i::before {
  content: "\eab2" !important;
}

/*--------------------------------------------------------------
# Contact
--------------------------------------------------------------*/
.contact .info-wrap {
  padding: 30px;
  background: #fff;
  border-radius: 4px;
}

.contact .info i {
  font-size: 20px;
  color: var(--principal);
  float: left;
  width: 44px;
  height: 44px;
  background: #eaf4fb;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50px;
  transition: all 0.3s ease-in-out;
}

.contact .info h4 {
  padding: 0 0 0 60px;
  font-size: 22px;
  font-weight: 600;
  margin-bottom: 5px;
  color: #384046;
}

.contact .info p {
  padding: 0 0 0 60px;
  margin-bottom: 0;
  font-size: 14px;
  color: #65747f;
}

.contact .info:hover i {
  background: var(--principal);
  color: #fff;
}

.contact .php-email-form {
  width: 100%;
  padding: 30px;
  background: #fff;
  border-radius: 4px;
}

.contact .php-email-form .form-group {
  padding-bottom: 8px;
}

.contact .php-email-form .validate {
  display: none;
  color: red;
  margin: 0 0 15px 0;
  font-weight: 400;
  font-size: 13px;
}

.contact .php-email-form .error-message {
  display: none;
  color: #fff;
  background: #ed3c0d;
  text-align: left;
  padding: 15px;
  font-weight: 600;
}

.contact .php-email-form .error-message br + br {
  margin-top: 25px;
}

.contact .php-email-form .sent-message {
  display: none;
  color: #fff;
  background: #18d26e;
  text-align: center;
  padding: 15px;
  font-weight: 600;
}

.contact .php-email-form .loading {
  display: none;
  background: #fff;
  text-align: center;
  padding: 15px;
}

.contact .php-email-form .loading:before {
  content: "";
  display: inline-block;
  border-radius: 50%;
  width: 24px;
  height: 24px;
  margin: 0 10px -6px 0;
  border: 3px solid #18d26e;
  border-top-color: #eee;
  -webkit-animation: animate-loading 1s linear infinite;
  animation: animate-loading 1s linear infinite;
}

.contact .php-email-form input, .contact .php-email-form textarea {
  border-radius: 0;
  box-shadow: none;
  font-size: 14px;
}

.contact .php-email-form input {
  height: 44px;
}

.contact .php-email-form textarea {
  padding: 10px 12px;
}

.contact .php-email-form button[type="submit"] {
  background: var(--principal);
  border: 0;
  padding: 10px 24px;
  color: #fff;
  transition: 0.4s;
  border-radius: 4px;
}

.contact .php-email-form button[type="submit"]:hover {
  background: var(--secundaria);
}

@-webkit-keyframes animate-loading {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

@keyframes animate-loading {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

/*--------------------------------------------------------------
# Breadcrumbs
--------------------------------------------------------------*/
.breadcrumbs {
  padding: 40px 0;
  margin-top: 70px;
}

.breadcrumbs h2 {
  font-size: 26px;
  font-weight: 300;
}

.breadcrumbs ol {
  display: flex;
  flex-wrap: wrap;
  list-style: none;
  padding: 0;
  margin: 0;
  font-size: 15px;
}

.breadcrumbs ol li + li {
  padding-left: 10px;
}

.breadcrumbs ol li + li::before {
  display: inline-block;
  padding-right: 10px;
  color: #4f5a62;
  content: "/";
}

@media (max-width: 768px) {
  .breadcrumbs .d-flex {
    display: block !important;
  }
  .breadcrumbs ol {
    display: block;
  }
  .breadcrumbs ol li {
    display: inline-block;
  }
}

/*--------------------------------------------------------------
# Portfolio Details
--------------------------------------------------------------*/
.portfolio-details {
  padding-top: 0;
}

.portfolio-details .portfolio-details-container {
  position: relative;
}

.portfolio-details .portfolio-details-carousel {
  position: relative;
  z-index: 1;
}

.portfolio-details .portfolio-details-carousel .owl-nav, .portfolio-details .portfolio-details-carousel .owl-dots {
  margin-top: 5px;
  text-align: left;
}

.portfolio-details .portfolio-details-carousel .owl-dot {
  display: inline-block;
  margin: 0 10px 0 0;
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background-color: #ddd !important;
}

.portfolio-details .portfolio-details-carousel .owl-dot.active {
  background-color: var(--principal) !important;
}

.portfolio-details .portfolio-info {
  padding: 30px;
  position: absolute;
  right: 0;
  bottom: -70px;
  background: #fff;
  box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
  z-index: 2;
}

.portfolio-details .portfolio-info h3 {
  font-size: 22px;
  font-weight: 400;
  margin-bottom: 20px;
  padding-bottom: 20px;
  border-bottom: 1px solid #eee;
}

.portfolio-details .portfolio-info ul {
  list-style: none;
  padding: 0;
  font-size: 15px;
}

.portfolio-details .portfolio-info ul li + li {
  margin-top: 10px;
}

.portfolio-details .portfolio-description {
  padding-top: 50px;
}

.portfolio-details .portfolio-description h2 {
  width: 50%;
  font-size: 26px;
  font-weight: 400;
  margin-bottom: 20px;
}

.portfolio-details .portfolio-description p {
  padding: 0;
}

@media (max-width: 768px) {
  .portfolio-details .portfolio-description h2 {
    width: 100%;
  }
  .portfolio-details .portfolio-info {
    position: static;
    margin-top: 30px;
  }
}

/*--------------------------------------------------------------
# Footer
--------------------------------------------------------------*/
#footer {
  color: #444444;
  font-size: 14px;
  background: rgba(0,0,0,.075);
}

#footer .footer-top {
  padding: 60px 0 30px 0;
  background: #fff;
}

#footer .footer-top .footer-contact {
  margin-bottom: 30px;
}

#footer .footer-top .footer-contact h4 {
  font-size: 22px;
  margin: 0 0 30px 0;
  padding: 2px 0 2px 0;
  line-height: 1;
  font-weight: 700;
}

#footer .footer-top .footer-contact p {
  font-size: 14px;
  line-height: 24px;
  margin-bottom: 0;
  font-family: "Raleway", sans-serif;
  color: #777777;
}

#footer .footer-top h4 {
  font-size: 16px;
  font-weight: bold;
  color: #444444;
  position: relative;
  padding-bottom: 12px;
}

#footer .footer-top .footer-links {
  margin-bottom: 30px;
}

#footer .footer-top .footer-links ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

#footer .footer-top .footer-links ul i {
  padding-right: 2px;
  color: var(--principal);
  font-size: 18px;
  line-height: 1;
}

#footer .footer-top .footer-links ul li {
  padding: 10px 0;
  display: flex;
  align-items: center;
}

#footer .footer-top .footer-links ul li:first-child {
  padding-top: 0;
}

#footer .footer-top .footer-links ul a {
  color: #777777;
  transition: 0.3s;
  display: inline-block;
  line-height: 1;
}

#footer .footer-top .footer-links ul a:hover {
  text-decoration: none;
  color: var(--principal);
}

#footer .footer-newsletter {
  font-size: 15px;
}

#footer .footer-newsletter h4 {
  font-size: 16px;
  font-weight: bold;
  color: #444444;
  position: relative;
  padding-bottom: 12px;
}

#footer .footer-newsletter form {
  margin-top: 30px;
  background: #fff;
  padding: 6px 10px;
  position: relative;
  border-radius: 4px;
  text-align: left;
  border: 1px solid #b6daf2;
}

#footer .footer-newsletter form input[type="email"] {
  border: 0;
  padding: 4px 8px;
  width: calc(100% - 100px);
}

#footer .footer-newsletter form input[type="submit"] {
  position: absolute;
  top: 0;
  right: -2px;
  bottom: 0;
  border: 0;
  background: none;
  font-size: 16px;
  padding: 0 20px 2px 20px;
  background: var(--principal);
  color: #fff;
  transition: 0.3s;
  border-radius: 0 4px 4px 0;
  box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
}

#footer .footer-newsletter form input[type="submit"]:hover {
  background: var(--secundaria);
}

#footer .credits {
  padding-top: 5px;
  font-size: 13px;
  color: #444444;
}

#footer .social-links a {
  font-size: 18px;
  display: inline-block;
  background: var(--principal);
  color: #fff;
  line-height: 1;
  padding: 8px 0;
  margin-right: 4px;
  border-radius: 50%;
  text-align: center;
  width: 36px;
  height: 36px;
  transition: 0.3s;
}

#footer .social-links a:hover {
  background: var(--secundaria);
  color: #fff;
  text-decoration: none;
}
