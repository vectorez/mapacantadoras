<div class="move-gral" id="move-gral" style="display: none;"></div>
<div class="move-360" id="move-360" style="display: none;"></div>
<div class="loader" id="loader">

  <page-loader>
    <div class="page-loader">
      <div class="page-loader-content">
        <div class="page-loader-content-animation" style="width: 160px; height: 160px;">
          <div class="animation-wrapper">
            <div class="animation-container">
              <img class="animation-image-static" ng-src="vistas/img/general/page-loader-static.gif" style="visibility: hidden; opacity: 0;">
              <!-- ngIf: vpw > 1200 --><img ng-if="vpw > 1200" class="animation-image ng-scope" ng-src="vistas/img/general/page-loader-static.gif" src="vistas/img/general/page-loader-static.gif" style="transform: translate(0%, -7.14286%) translate3d(0px, 0px, 0px);"><!-- end ngIf: vpw > 1200 -->
            </div>
          </div>
        </div>
        <div class="page-loader-text">
          <div style="position: relative; display: inline-block; visibility: inherit; opacity: 0.999516;">Cargando</div>
        </div>
      </div>
    </div>
  </page-loader>
</div>
<div id="desc-container" style="display:none">
  <iframe id="referenceVideo" src="https://www.youtube.com/watch?v=D7icsuamx5E" allowfullscreen></iframe>
  <div id="referenceTitulo" class="title"></div>
  <div id="referenceTexto" class="text"></div>
</div>
<div style="background: url('vistas/img/general/toppaper.png') 0px 0px / cover no-repeat;position: absolute;z-index: 1;width: 100vw;flex-direction: row-reverse !important;height: 70px;" id="navPrincipal">

</div>
<nav class="navbar navbar-expand navbar-light skin-black-light flex-column flex-md-row bd-navbar" style="background: ffffff00; position: absolute;z-index: 1000;width: 100vw;flex-direction: row-reverse !important;height: 60px;">
  <!-- <a class="navbar-brand ml-3" href="https://identidadafro.antioquia.gov.co/">
    <img src="vistas/img/general/logo.png" width="100" height="100" alt="" loading="lazy" style="position: absolute; z-index: 1000; top: 16px;">
  </a> -->
  <ul class="navbar-nav ml-md-auto">
    <li class="nav-item">
      <a id="showInfo" href="#" class="nav-link px-1 mx-1 py-3 my-n2 " data-toggle="tooltip" data-placement="left" title="SOBRE EL PROYECTO"><i class="fa fa-info-circle fa-2x"></i></a>
    </li>
    <li class="nav-item">
      <a id="showReproductor" href="#" class="nav-link px-1 mx-1 py-3 my-n2 " data-toggle="tooltip" data-placement="right" title="REPRODUCTOR MUSICAL"><i class="fa fa-play-circle fa-2x"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link px-1 mx-1 py-3 my-n2" href="https://twitter.com/antioquiaafro" target="_blank" rel="noopener" aria-label="Twitter"><i class="fa fa-twitter-square fa-2x"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link px-1 mx-1 py-3 my-n2" href="https://www.facebook.com/GerenciadeAfrodescendientes/" target="_blank" rel="noopener" aria-label="Slack"><i class="fa fa-facebook-official fa-2x"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link px-1 mx-1 py-3 my-n2" href="https://identidadafro.antioquia.gov.co/rev/" target="_blank" rel="noopener" aria-label="Open Collective"><i class=" fa fa-id-card fa-2x" data-toggle="tooltip" data-placement="left" title="REVISIÓN BIBLIOGRÁFICA"></i></a>
    </li>

  </ul>
</nav>
<a href="https://identidadafro.antioquia.gov.co/index2.html">
  <img src="vistas/img/general/logo.png" width="100" height="100" alt="" loading="lazy" style="position: absolute;z-index: 1000;top: 6px;left: 16px;">
</a>
<!-- <nav class="navbar navbar-expand navbar-light skin-black-light flex-column flex-md-row bd-navbar" style="background: url(vistas/img/general/bottompaper.png) no-repeat 0 0/cover; position: absolute;z-index: 799;width: 100vw; bottom:0px; height: 80px;">

</nav> -->
<footer class="page-footer" style="visibility: inherit; opacity: 1;padding-bottom: 3%;">
  <random-location id="btnCardRandom" ng-if="$stateParams.page == 'location' || $stateParams.page == 'map'" class="ng-scope" style="visibility: inherit; opacity: 1; transform: translate(-50%, 0%) matrix(1, 0, 0, 1, 0, 0);">

    <div class="contenedor1a ">


      <button type="button" class="btn btn-primary botonF1a">LOCACIÓN ALEATORIA</button>

    </div>

  </random-location>
</footer>

<div id="divListadoUbicacionMapaStore">
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVGX_idjc0O9EdSqNyY6Ad6tcPHb7E9VY"></script>
  <div id="container-map">
    <div id="map_canvas" style="height: 100vh" onmouseout="stopTimer()" onmousemove="resetTimer()">
    </div>
    <div id="overview">
    </div>
  </div>

  <div class="container-burbuja" style="z-index:900;">
    <div class="menu-toggle">
      <span class="fa fa-map-marker"></span>
    </div>
    <div class="menu-round">
      <!-- <div class="btn-app" style="background: rebeccapurple;" data-toggle="tooltip" data-placement="right" title="Próxima parada">
        <div class="fa fa-random" id="btnCardRandom"></div>
      </div> -->
    </div>
    <div class="menu-line" id="menu-places">

    </div>
  </div>
</div>

<div id="modalView360" class="modal modal-fullscreen fade" role="dialog">
  <div class="modal-dialog modal-xl">
    <!-- Modal content-->
    <div class="modal-content" style="background-color: #E67E22;">
      <div class="modal-header" style="border-bottom: 0px;">
        <h4 class="modal-title text-black" id="titleVista360"></h4>
        <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
      <div class="modal-body p-0" style="background: black; overflow: hidden;">
        <div id="progress">
          <div id="bar"></div>
        </div>
        <div id="container360" style="overflow: hidden;">

        </div>
      </div>
      <div class="modal-footer" style="border-top: 0px; display: block;">
        <button type="button" class="btn btn-dark pull-left" id="btnVerGaleria">Galería</button>
        <button type="button" class="btn btn-dark pull-left" id="btnVerVideo">Video</button>
        <button type="button" class="btn btn-dark pull-left" id="btnVer360Aleatorio">Próxima parada</button>
        <button type="button" class="btn btn-outline-dark pull-right" data-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>

<div id="modalGaleria" class="modal fade" role="dialog" style="background: #0b1727de;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color: #34405000;">
      <div class="modal-body p-0" style="overflow: auto; height: calc(100% - 120px);" id="mdlBodyGaleria">
      </div>
    </div>
  </div>
</div>

<div id="modalCoverGaleria" class="modal fade" role="dialog" style="background: #0b1727de;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color: #34405000;">
      <div class="modal-body p-0" style="overflow: auto; height: calc(100%);" id="mdlBodyGaleria">
        <div class="col-12">
          <div class="card bg-light">
            <div class="card-body">
              <div class="card-title" id="titleCoverGalery"></div>
              <div class="row">
                <div class="col-4">
                  <img class="img-fluid rounded-top" style="border-radius: 3px;" id="imageCoverGalery" src="" alt=""></a>
                </div>
                <p class="card-text col-8" id="textCoverGalery" style="text-align: justify;"></p>
              </div>
            </div>
            <div class="card-footer text-center border-top"><a class="card-link d-block" href="#" data-dismiss="modal">Ver galería</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="modalVideo" class="modal fade" role="dialog" style="background: #0b1727de;">
  <div class="modal-dialog modal-xl">
    <div class="modal-content" style="background-color: #34405000;">
      <div class="modal-body p-0" style="overflow: auto;" id="mdlBodyVideo">
        <iframe id="referenceVideo2" class="yt_player_iframe" src="" style="width: 100%;height: 90vh;" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</div>

<div id="modalVerInfo" class="modal fade" role="dialog">
  <div class="modal-dialog modal-xl">
    <!-- Modal content-->
    <div class="modal-content" style="background-color: #E67E22;">
      <div class="modal-header" style="border-bottom: 0px;">
        <h4 class="modal-title text-black" id="titleVista360"></h4>
        <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
      <div class="modal-body" style="background: white; overflow: hidden;">
        <h1 style="text-align: center;">Acerca del proyecto</h1>
<p style="text-align: justify;">&iquest;C&oacute;mo danzan juntos el bullerengue y el cuidado materno infantil? Las manos acarician el beb&eacute; y tocan el tamb&oacute;, la voz arrulla y pone sus notas en la canci&oacute;n bullerenguera, la rueda es espacio de baile y tambi&eacute;n de cari&ntilde;o para acompa&ntilde;ar la crianza&hellip; El cancionero Cantadoras de Vida: Canto Bullerenguero y Cuidado Materno Infantil recoge doce temas tradicionales de Urab&aacute; con una cartograf&iacute;a interactiva que explora los ritmos y saberes tradicionales de esta estructura social alrededor del bullerengue, con una mirada especial al embarazo, parto y cuidado de los ni&ntilde;os.</p>
<p style="text-align: justify;">Entre cantos de cuna, juegos tradicionales, bullerengues sentaos, chalupas y fandangos, el cancionero Cantadoras de vida: canto bullerenguero y cuidado materno infantil re&uacute;ne doce temas de la tradici&oacute;n oral del Urab&aacute; Antioque&ntilde;o.</p>
<p style="text-align: justify;">El cancionero se enmarca en una actividad de investigaci&oacute;n liderada por la Universidad de Antioquia, cuyo principal objetivo fue indagar entre los principales exponentes del bullerengue en el Urab&aacute; Antioque&ntilde;o acerca de los saberes y tradiciones que han tejido la relaci&oacute;n entre el bullerengue como estructura social de los pueblos afrodescendientes y procesos como el embarazo, el parto, el puerperio y la lactancia, as&iacute; como el cuidado de los ni&ntilde;os, la crianza y el juego, entre otros.</p>
<p style="text-align: justify;">Este trabajo busca llegar a todas aquellas personas que dedican su quehacer profesional al cuidado infantil y a padres y madres deseosos de emprender con sus hijos un maravilloso viaje musical, en el que se palpan distintas formas que tienen las comunidades de acompa&ntilde;ar a los suyos a trav&eacute;s de su cultura. El cancionero, as&iacute; mismo, supone una puerta de entrada al profundo universo del bullerengue; de ah&iacute; que revista un potencial inter&eacute;s para artistas, gestores, investigadores y otros, de los que se espera sean portavoces de la riqueza de las m&uacute;sicas de tradici&oacute;n oral colombianas.</p>
<p style="text-align: justify;">Como resultado, la Gerencia de Afrodescendientes de la Gobernaci&oacute;n de Antioquia da un paso m&aacute;s en su misi&oacute;n de promoci&oacute;n de la diversidad y de los derechos culturales, mediante la implementaci&oacute;n de estrategias de reconocimiento y visibilizaci&oacute;n del aporte cultural afrodescendiente en el departamento, como una manera de combatir el racismo y la discriminaci&oacute;n.</p>
<h2 style="text-align: justify;"><strong>Cr&eacute;ditos</strong></h2>
<p style="text-align: justify;">Este documento va dirigido a todas aquellas personas que dedican su quehacer profesional al cuidado de las madres, las familias y la infancia; pero tambi&eacute;n a padres y madres deseosos de emprender con sus hijos un maravilloso viaje musical, en el que se hacen palpables las distintas formas que tienen las comunidades de acompa&ntilde;ar a sus hijos a trav&eacute;s de su cultura. El cancionero, as&iacute; mismo, supone una puerta de entrada al rico universo del bullerengue por lo que reviste un potencial inter&eacute;s para artistas, gestores, investigadores, de los que se espera sean testigos y portavoces de la gran diversidad que resguardan las m&uacute;sicas de tradici&oacute;n oral colombianas.</p>
<h2 style="text-align: justify;">Int&eacute;rpretes y compositores</h2>
<ul style="text-align: justify;">
<li>Eustiquia Amaranto Santana</li>
<li>Ingrid Martinez</li>
<li>Brayan Minota</li>
<li>Maryuri Urango</li>
<li>Yarley Escudero</li>
<li>Fredy Su&aacute;rez</li>
<li>Darlina S&aacute;enz&nbsp;</li>
<li>Haroun Valencia</li>
<li>​​Esteban G&oacute;mez (Piano)</li>
<li>Agrupaci&oacute;n Totumo Encantado</li>
<li>Beatriz Berr&iacute;o</li>
<li>Sof&iacute;a L&oacute;pez</li>
</ul>
<h2 style="text-align: justify;">Investigadores</h2>
<ul style="text-align: justify;">
<li>Luisa Fernanda Hurtado</li>
<li>Mar&iacute;a Jos&eacute; Salgado</li>
<li>Diego Valbuena</li>
<li>Urab&aacute; RuizJoel Padilla</li>
</ul>
<h2 style="text-align: justify;">Voluntarias</h2>
<ul style="text-align: justify;">
<li>Manuela Atehort&uacute;a</li>
<li>Ang&eacute;lica Ovalles</li>
</ul>
<h2 style="text-align: justify;">Equipo audiovisual</h2>
<ul style="text-align: justify;">
<li>Diego David Sierra</li>
<li>Kelly Durango</li>
<li>Miller Gallego</li>
<li>Sergio R&iacute;os</li>
</ul>
<p style="text-align: justify;"><iframe title="YouTube video player" src="https://www.youtube.com/embed/_RA-v49Nu7A" width="560" height="315" frameborder="0" allowfullscreen="allowfullscreen"></iframe></p>


      </div>
      <div class="modal-footer" style="border-top: 0px; display: block;">
        <button type="button" class="btn btn-outline-dark pull-right" data-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>

<div class="audio7_html5" style="z-index:800;">
  <div id="lbg_audio7_html5_1">
    <div class="xaudioplaylist">
      <?php
      $audios = ModeloDAO::mdlMostrar('*', 'audios', '');
      foreach ($audios as $key => $audio) {
        echo '<ul>
            <li class="xtitle">' . $audio['audios_artista_v'] . '</li>
            <li class="xauthor">' . $audio['audios_nombre_v'] . '</li>
            <li class="ximage">audio/images/p3.jpg</li>
            <li class="xbuy">https://identidadafro.antioquia.gov.co/mapa/vistas/modulos/pdf.php</li>
            <li class="xlyrics">https://www.google.com/</li>
            <li class="xcategory">ALL CATEGORIES</li>
            <li class="xsources_mp3">' . $audio['audios_url_v'] . '</li>
          </ul>';
      }
      ?>
    </div>
  </div>
</div>

<style>
  #container-map,
  #map {
    height: 100%;
    width: 100%;
  }

  #map {
    position: relative;
  }

  #overview {
    position: absolute;
    right: 10px;
    height: 50vh;
    width: 12.5vw;
    top: 25%;
    box-shadow: 0 2px 6px rgb(0 0 0 / 50%);
  }

  #map_canvas .gm-style-iw {
    background-color: #E67E22;
    padding: 0px;
  }

  #map_canvas .iw-content p {
    color: #a5a5a5;
  }

  #map_canvas .iw-subTitle {
    color: white;
    font-size: 16px;
    font-weight: 700;
    padding: 5px 0;
  }

  #map_canvas .gm-style-iw-d {
    overflow: hidden !important;
    ;
  }

  #container360 {
    width: 100%;
    height: 100%;
  }

  .modal-fullscreen {
    padding: 0 !important;
  }

  .modal-fullscreen .modal-dialog {
    width: 100%;
    max-width: none;
    height: 100%;
    margin: 0;
  }

  .modal-fullscreen .modal-content {
    height: 100%;
    border: 0;
    border-radius: 0;
  }

  .modal-fullscreen .modal-body {
    overflow-y: auto;
  }

  #desc-container {
    max-width: 500px;
    max-height: 500px;
    min-width: 200px;
    min-height: 250px;
    background: #fff;
    color: #000;
    border-radius: 3px;
    overflow: auto;
    -webkit-overflow-scrolling: touch;
  }

  #desc-container>iframe {
    border: none;
    width: 100%;
  }

  #progress {
    position: absolute;
    width: 100%;
    height: 3px;
  }

  #bar {
    background-color: #fff;
    height: 100%;
    transition: width 0.1s ease;
  }

  .botonF1 {
    width: 286px;
    height: 49px;
    border-radius: 40px;
    /*background:#fff909;
            */
    background: #1868F3;
    right: 0;
    bottom: 0;
    position: absolute;
    margin-right: 13px;
    margin-bottom: 16px;
    border: none;
    outline: none;
    color: #FFF;
    font-size: 28px;
    /* font-family: 'Open Sans'; */
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
    transition: .3s;
    /*z-index: 333;
            */
    padding: 8px 0px 0px 77px;
  }

  .gm-ui-hover-effect {
    background: #f8d9c2 !important;
    border-radius: 25px !important;
    top: 0px !important;
    right: 0px !important;
  }

  .random-location {
    position: relative;
    font-family: bebas, sans-serif;
    letter-spacing: .275em;
    font-weight: 400;
    font-size: 1.25rem;
    display: block;
    padding: 0.6em;
    color: #fff;
    text-indent: 0;
    cursor: pointer;
  }

  .move-gral {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('vistas/img/general/move-icon-png-clipart.png') 50% 50% no-repeat rgb(0 0 0 / 20%);
    background-size: 150px 150px;
  }

  .move-360 {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('vistas/img/general/360.png') 50% 50% no-repeat rgb(0 0 0 / 20%);
    background-size: 150px 150px;
  }

  .loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('vistas/img/general/page-loader-static.gif') 50% 50% no-repeat rgb(228 230 233 / 50%);
    background-size: 150px 150px;
  }
</style>