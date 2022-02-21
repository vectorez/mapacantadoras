var lat_g = 0, lon_g = 0;
var vMarker;
var map, overview;
var vMArker_arr = [];
var infowindow_arr = [];
var contentString_arr = [];
var idMarkers_arr = [];
var zoom_a;
var zoom_c;
var timerLoadDiretion = 0;
var stopLoadDiretion = true;

$(document).ready(function () {
  $('#modalVerInfo').modal('show');
  $.ajax({
    url: 'ajax/data.ajax.php',
    type: 'post',
    data: 'getCoberturas=1',
    cache: false,
    dataType: 'json',
    async: false,
    success: function (data) {
      var limite = {
        north: parseFloat(data.configuracion.config_north_v),
        south: parseFloat(data.configuracion.config_south_v),
        west: parseFloat(data.configuracion.config_west_v),
        east: parseFloat(data.configuracion.config_east_v),
      };
      lat_g = parseFloat(data.configuracion.config_lat_v);
      lon_g = parseFloat(data.configuracion.config_lon_v);
      zoom_g = parseInt(data.configuracion.config_zoom_i);
      zoom_a = zoom_g;
      zoom_c = parseInt(data.configuracion.config_zoom_clic_i);

      map = new google.maps.Map(document.getElementById('map_canvas'), {
        zoom: zoom_g,
        center: new google.maps.LatLng(lat_g, lon_g),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapId: '3b60f97af58f68a5',
        mapTypeControl: false,
        streetViewControl: false,
        restriction: {
          latLngBounds: limite,
          strictBounds: false,
        },
      });

      map.setOptions({ minZoom: parseInt(data.configuracion.config_zoom_min_i), maxZoom: parseInt(data.configuracion.config_zoom_max_i) });

      var historicalOverlay = [];
      var imageBounds = [];
      $.each(data.background, function (i, bag) {

        if (bag.background_north_v != null && bag.background_south_v != null && bag.background_east_v != null && bag.background_west_v != null && bag.background_url_v != null && bag.background_zoom_min_i != null && bag.background_zoom_max_i != null) {
          imageBounds[i] = {
            north: parseFloat(bag.background_north_v),
            south: parseFloat(bag.background_south_v),
            east: parseFloat(bag.background_east_v),
            west: parseFloat(bag.background_west_v),
          };

          var img = new Image();
          var img_url = bag.background_url_v
          img.src = img_url;
          $('#loader').show();
          img.onload = function () {
            historicalOverlay[i] = new google.maps.GroundOverlay(
              bag.background_url_v,
              imageBounds[i]
            );
            if (zoom_g >= bag.background_zoom_min_i && zoom_g <= bag.background_zoom_max_i) {
              historicalOverlay[i].setMap(map);
            } else {
              historicalOverlay[i].setMap(null)
            }
            google.maps.event.addListener(historicalOverlay[i], 'click', (function () {
              infowindow_arr.forEach(element => {
                element.close();
              });
            }));
            setTimeout(() => {
              $('#loader').fadeOut("slow");
            }, 1000);
          }
        } else {
          // $('#loader').fadeOut("slow");
        }
      });

      map.addListener("zoom_changed", function () {
        // $('#loader').show();
        zoom_a = parseInt(map.getZoom());
        // console.log("Zoom :" + zoom_a);

        $.each(data.background, function (i, bag) {
          if (bag.background_north_v != null && bag.background_south_v != null && bag.background_east_v != null && bag.background_west_v != null && bag.background_url_v != null && bag.background_zoom_min_i != null && bag.background_zoom_max_i != null) {
            if (zoom_a >= bag.background_zoom_min_i && zoom_a <= bag.background_zoom_max_i) {
              historicalOverlay[i].setMap(map);
            } else {
              // historicalOverlay[i]=null;
              historicalOverlay[i].setMap(null)
            }
            google.maps.event.addListener(historicalOverlay[i], 'click', (function () {
              infowindow_arr.forEach(element => {
                element.close();
              });
            }));
          }
        });
        // $('#loader').fadeOut();
      });

      map.setCenter(new google.maps.LatLng(lat_g, lon_g));
      // vMarker.setMap(map);

      //MINIMAP
      const OVERVIEW_DIFFERENCE = 4;
      const OVERVIEW_MIN_ZOOM = 0;
      const OVERVIEW_MAX_ZOOM = 10000;
      function clamp(num, min, max) {
        return Math.min(Math.max(num, min), max);
      }
      overview = new google.maps.Map(document.getElementById("overview"), {
        center: new google.maps.LatLng(lat_g, lon_g),
        disableDefaultUI: true,
        gestureHandling: "none",
        mapId: '3b60f97af58f68a5',
        zoomControl: false,
      });

      map.addListener("bounds_changed", () => {
        overview.setCenter(map.getCenter());
        overview.setZoom(
          clamp(
            map.getZoom() - OVERVIEW_DIFFERENCE,
            OVERVIEW_MIN_ZOOM,
            OVERVIEW_MAX_ZOOM
          )
        );
      });

      $.each(data.marcadores, function (i, place) {
        var markPosition = new google.maps.LatLng(place.markers_lat_v, place.markers_lon_v);
        idMarkers_arr.push(place.markers_id_i);
        var icon = {
          url: place.markers_icon_v,
          scaledSize: new google.maps.Size(70, 80), // scaled size
          origin: new google.maps.Point(0, 0), // origin
          anchor: new google.maps.Point(0, 0) // anchor
        };

        //DIBUJA MARCADORES
        vMarker = new google.maps.Marker({
          position: markPosition,
          draggable: false,
          icon: icon
        });

        google.maps.event.addListener(vMarker, 'mouseover', function () {
          // $('img[src="' + this.icon.url + '"]').parent().animate({ zoom: '105%' });
          // $('img[src="' + this.icon.url + '"]').parent().addClass('animate__animated', 'animate__heartBeat');
          const el1 = document.querySelector('img[src="' + this.icon.url + '"]');
          var el2 = el1.closest("div");
          el2.classList.add('animate__animated', 'animate__heartBeat', 'animate__infinite');

        });

        google.maps.event.addListener(vMarker, 'mouseout', function () {
          // $('img[src="' + this.icon.url + '"]').parent().removeClass('animate__animated', 'animate__heartBeat');
          // $('img[src="' + this.icon.url + '"]').parent().animate({ zoom: '100%' });
          const el1 = document.querySelector('img[src="' + this.icon.url + '"]');
          var el2 = el1.closest("div");
          el2.classList.remove('animate__animated', 'animate__heartBeat', 'animate__infinite');
        });
        // vMarker.addListener("click", toggleBounce);

        vMArker_arr.push(vMarker);
        vMarker.setMap(map);

        var iconMini = {
          url: place.markers_icon_v,
          scaledSize: new google.maps.Size(15, 15), // scaled size
          origin: new google.maps.Point(0, 0), // origin
          anchor: new google.maps.Point(0, 0) // anchor
        };

        vMiniMarker = new google.maps.Marker({
          position: markPosition,
          draggable: false,
          icon: iconMini
        });

        vMiniMarker.setMap(overview);

        //CREA MODALES
        const contentString = formatoHtmlModal(place.markers_title_v, place.markers_description_v, place.markers_img_card_v, place.markers_video_card_v, place.markers_id_i);
        const infowindow = new google.maps.InfoWindow();
        infowindow_arr.push(infowindow);
        contentString_arr.push(contentString);
        google.maps.event.addListener(vMarker, 'click', (function (vMarker, contentString, infowindow) {
          return function () {
            map.setZoom(zoom_c);
            map.panTo(new google.maps.LatLng(parseFloat(place.markers_lat_v), parseFloat(place.markers_lon_v)));
            // map.setCenter(new google.maps.LatLng(place.markers_lat_v, place.markers_lon_v));
            zoom_a = zoom_c;
            // map.setCenter(place.markers_lat_v+', '+ place.markers_lon_v);
            infowindow_arr.forEach(element => {
              element.close();
            });
            $("audio").each(function () {
              $('.AudioPlay').removeClass('AudioPause');
              $(this)[0].pause();
            });
            infowindow.setContent(contentString);
            infowindow.open(map, vMarker);
          };
        })(vMarker, contentString, infowindow));

        $('#menu-places').append('<div class="btn-app" idmarker="' + i + '" lat="' + place.markers_lat_v + '" lon="' + place.markers_lon_v + '" title="' + place.markers_title_v + '" data-toggle="tooltip" data-placement="right">\
          <div class="avatar" style="height: 40px; width: 40px;">\
            <img class="rounded-circle" src="'+ place.markers_icon_v + '">\
          </div>\
        </div>');
        google.maps.event.addListener(map, "click", function (event) {
          infowindow.close();
        });
      });

      $.each(data.illustrations, function (i, ilus) {
        var ilusPosition = new google.maps.LatLng(ilus.illustrations_lat_v, ilus.illustrations_lon_v);
        var icon = {
          url: ilus.illustrations_url_v,
          // scaledSize: new google.maps.Size(50, 50), // scaled size
          origin: new google.maps.Point(0, 0), // origin
          anchor: new google.maps.Point(0, 0) // anchor
        };

        var vIlustrasion = new google.maps.Marker({
          position: ilusPosition,
          draggable: false,
          icon: icon
        });

        vIlustrasion.setMap(map);
      });

      $('[data-toggle="tooltip"]').tooltip();
      // setTimeout(() => {
      //   $('#loader').fadeOut("slow");
      // }, 5000);
    }
  });
  if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    $('#overview').hide();
    $('.container-burbuja').hide();
    $('#navPrincipal').css('height', '80px');
  }

  var bar = document.querySelector('#bar');
  function onProgressUpdate(event) {
    var percentage = event.progress.loaded / event.progress.total * 100;
    bar.style.width = percentage + "%";
    if (percentage >= 100) {
      bar.classList.add('hide');
      setTimeout(function () {
        bar.style.width = 0;
      }, 1000);
    }
  }

  function formatoHtmlModal(titulo, descricion, img_card, video_card, id) {
    var vista = '<img class="img-fluid" style="object-fit: cover; width: 250px; height: 141px;" src="' + img_card + '" alt="">';
    if (video_card != 'null' && video_card != '' && video_card != null) {
      var vista = '<iframe class="yt_player_iframe2" src="' + video_card + '?enablejsapi=1&version=3&playerapiid=ytplayer&autoplay=1" allow="autoplay" style="width: 250px; height: 141px; border: 0px;" allowfullscreen></iframe>';
    }
    const contentString =
      '<div id="content-card" onmousemove="stopTimer()">' +
      '<div id="siteNotice">' +
      '</div>' +
      '<div id="bodyContent" style="width:250px;">' +
      '<div class="hoverbox rounded-soft text-center" style="width: 250px; height: 141px; border-radius: 0px !important;" >' +
      vista +
      '</div>' +
      '<div class="p-2 row">' +
      '<div class="col-12">' +
      '<h6 id="firstHeading" class="firstHeading text-black">' + titulo + '</h6>' +
      '<p align="justify" style="font-size: 12px;" class="text-black">' + descricion + '</p>' +
      '</div>' +
      '<div class="col-12">' +
      '<a class="btn btn-primary btn-sm btn-block pull-right btnOpenModal360" idplace="' + id + '">Ver 360º</a>' +
      '</div>' +
      '</div>' +
      '</div>' +
      '</div>';

    return contentString;
  }

  $(".menu-toggle").click(function () {
    $(".menu-toggle").toggleClass('open');
    $(".menu-round").toggleClass('open');
    $(".menu-line").toggleClass('open');
  });

  $('#menu-places').on("click", ".btn-app", function () {
    var lat = $(this).attr("lat");
    var lon = $(this).attr("lon");
    var idmarker = $(this).attr("idmarker");
    // map.panTo(new google.maps.LatLng(parseFloat(lat), parseFloat(lon)));
    seleccionaMarker(idmarker);
  })

  setTimeout(() => {
    // $('#overview').append('<div style="position: absolute;width: 44%;height: 14.5%;background: #00000017;z-index: 1000;border: 1px solid #5e6e82;top: calc(56% - 12.5%);left: calc(42% - 12.5%);"></div>');

    $('#overview').append('<div style="position: absolute;width: 6.7vw;height: 7.2vh;background: #00000017;z-index: 1000;border: 1px solid #5e6e82;top: 22vh;left: 3.2vw;"></div>');

    $('#map_canvas').on("click", ".btnOpenModal360", function () {
      var idplace = $(this).attr('idplace');
      abreModal360(idplace);
      $("audio").each(function () {
        $('.AudioPlay').removeClass('AudioPause');
        $(this)[0].pause();
      });
      setTimeout(() => {
        $('#move-360').fadeIn(1000);
        setTimeout(() => {
          $('#move-360').fadeOut();
        }, 6000);
      }, 3000);
    })
  }, 1000);

  $('#move-gral').on("click", function () {
    $('#move-gral').fadeOut();
  });

  $('#move-360').on("click", function () {
    $('#move-360').fadeOut();
  });

  $('#modalView360').on("click", "#btnVerGaleria", function () {
    $('#modalGaleria').modal('show');
    $('#modalCoverGaleria').modal('show');
  });

  $('#modalView360').on("click", "#btnVerVideo", function () {
    $('#modalVideo').modal('show');
  });
  $('.navbar').on("click", "#showInfo", function () {
    $('#modalVerInfo').modal('show');
  });
  $('.navbar').on("click", "#showReproductor", function () {
    $(this).hide();
    jQuery("#lbg_audio7_html5_1").audio7_html5({
      skin: "blackControllers",
      initialVolume: 1,
      autoPlay: true,
      loop: true,
      shuffle: false,
      sticky: true,
      playerBg: "#f5803ee0",
      bufferEmptyColor: "#cccccc",
      bufferFullColor: "#929292",
      seekbarColor: "#000000",
      volumeOffColor: "#929292",
      volumeOnColor: "#000000",
      timerColor: "#555555",
      songTitleColor: "#333333",
      songAuthorColor: "#333333",
      googleTrakingOn: false,
      googleTrakingCode: "",
      showVinylRecord: true,
      showRewindBut: true,
      showNextPrevBut: true,
      showShuffleBut: false,
      showDownloadBut: false,
      showBuyBut: true,
      showLyricsBut: false,
      buyButTitle: "Cancionero Digital",
      lyricsButTitle: "Lyrics",
      buyButTarget: "_blank",
      lyricsButTarget: "_blank",
      showFacebookBut: false,
      facebookAppID: "",
      facebookShareTitle: "Apollo - HTML5 Audio Player",
      facebookShareDescription: "A top-notch sticky full width HTML5 Audio Player compatible with all major browsers and mobile devices.",
      showTwitterBut: false,
      showPopupBut: false,
      showAuthor: true,
      showTitle: true,
      showPlaylistBut: true,
      showPlaylist: true,
      showPlaylistOnInit: false,
      playlistTopPos: 0,
      playlistBgColor: "",
      playlistRecordBgOffColor: "#ffffff",
      playlistRecordBgOnColor: "#ffffff",
      playlistRecordBottomBorderOffColor: "#c7c7c7",
      playlistRecordBottomBorderOnColor: "#c7c7c7",
      playlistRecordTextOffColor: "#4d4d4d",
      playlistRecordTextOnColor: "#c13442",
      categoryRecordBgOffColor: "#dedede",
      categoryRecordBgOnColor: "#333333",
      categoryRecordBottomBorderOffColor: "#333333",
      categoryRecordBottomBorderOnColor: "#333333",
      categoryRecordTextOffColor: "#333333",
      categoryRecordTextOnColor: "#ffffff",
      numberOfThumbsPerScreen: 5,
      playlistPadding: 15,
      showCategories: false,
      firstCateg: "",
      selectedCategBg: "#dedede",
      selectedCategOffColor: "#333333",
      selectedCategOnColor: "#f12233",
      selectedCategMarginBottom: 12,
      showSearchArea: false,
      searchAreaBg: "#dedede",
      searchInputText: "Buscar...",
      searchInputBg: "#333333",
      searchInputBorderColor: "#dedede",
      searchInputTextColor: "#cccccc",
      searchAuthor: false,
      continuouslyPlayOnAllPages: true,
      showPlaylistNumber: true,
      pathToDownloadFile: "",
      popupWidth: 1100,
      popupHeight: 500,
      barsColor: "#bc2534"
    });
    setTimeout(() => {
      $('.AudioPlay').click();
    }, 1000);
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
      $('.VolumeSlider').hide();
      $('.songTitle').show();
      $('.songAuthor').show();
      $('.songTitle').css("width", "75%");
      $('.songAuthor').css("width", "75%");
      // $('.AudioShowHidePlaylist').css("top", "82px");
      // $('.AudioShowHidePlaylist').css("left", "83px");
    }
  });

  $('#modalView360').on("click", "#btnVer360Aleatorio", function () {
    $('#modalView360').modal('hide');
    var idmarker_l = idMarkers_arr.length + 1;
    var idmarker = Math.floor(Math.random() * idmarker_l);
    setTimeout(() => {
      abreModal360(idMarkers_arr[idmarker]);
    }, 1000);
  });

  $('#modalView360').on('hidden.bs.modal', function () {
    $('#move-360').fadeOut();
  });

  $('#modalVideo').on('hidden.bs.modal', function () {
    $('.yt_player_iframe')[0].contentWindow.postMessage('{"event":"command","func":"' + 'pauseVideo' + '","args":""}', '*');
  });

  $('#modalVerInfo').on('hidden.bs.modal', function () {
    $('#move-gral').fadeIn(1000);
    setTimeout(() => {
      $('#move-gral').fadeOut(1000);
    }, 2000);
  });

  $('#btnCardRandom').on("click", function () {
    var idmarker_l = vMArker_arr.length + 1;
    var idmarker = Math.floor(Math.random() * idmarker_l)
    seleccionaMarker(idmarker)
  });

  function seleccionaMarker(idmarker) {
    var positionMArkerLat = vMArker_arr[idmarker].getPosition().lat();
    var positionMArkerLon = vMArker_arr[idmarker].getPosition().lng();
    map.setZoom(zoom_c);
    map.panTo(new google.maps.LatLng(parseFloat(positionMArkerLat), parseFloat(positionMArkerLon)));
    vMArker_arr[idmarker].setAnimation(google.maps.Animation.BOUNCE);
    infowindow_arr.forEach(element => {
      element.close();
    });
    setTimeout(() => {
      vMArker_arr[idmarker].setAnimation(null);
      infowindow_arr[idmarker].setContent(contentString_arr[idmarker]);
      infowindow_arr[idmarker].open(map, vMArker_arr[idmarker]);
    }, 2000);
  }

  function abreModal360(idplace) {
    $('#titleVista360').text('');
    $('#modalView360').modal('show');
    $('#container360').html('');
    // $('#carruselGaleria').html('');
    $('#btnVerGaleria').hide();
    $('.yt_player_iframe2').each(function () {
      this.contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*');
    });
    $.ajax({
      url: 'ajax/data.ajax.php',
      type: 'post',
      data: 'getInfoPlaces=' + idplace,
      cache: false,
      dataType: 'json',
      async: false,
      success: function (data) {
        var img360 = data.place.markers_img_360_v;
        $('#titleCoverGalery').html(data.place.markers_galery_title_v);
        $('#textCoverGalery').html(data.place.markers_gelery_text_v);
        $('#imageCoverGalery').attr("src", data.place.markers_img_card_v);
        $('#btnVerVideo').hide();
        setTimeout(() => {
          container = document.querySelector('#container360');
          var infospot;
          var panorama = new PANOLENS.ImagePanorama(img360);

          panorama.addEventListener('progress', onProgressUpdate);
          var viewer = new PANOLENS.Viewer({ output: 'console', container: container });
          $('#titleVista360').text(data.place.markers_title_v);
          if (data.place.markers_video_360_v != '' && data.place.markers_video_360_v != null && data.place.markers_video_360_v != "null") {
            $('#referenceVideo2').attr('src', data.place.markers_video_360_v + '?enablejsapi=1&version=3&playerapiid=ytplayer');
            $('#btnVerVideo').show();
          }
          if (data.place.markers_coordenada1_360_i != null && data.place.markers_coordenada2_360_i != null && data.place.markers_coordenada3_360_i != null) {
            setTimeout(() => {
              var cor1 = parseInt(data.place.markers_coordenada1_360_i);
              var cor2 = parseInt(data.place.markers_coordenada2_360_i);
              var cor3 = parseInt(data.place.markers_coordenada3_360_i);
              // console.log(cor1, cor2, cor3);
              viewer.tweenControlCenter(new THREE.Vector3(cor1, cor2, cor3), 0);
            }, 1000);
          }

          // $.each(data.reference, function (i, ref) {
          //   $('#referenceVideo').attr('src', ref.reference_video_v);
          //   $('#referenceTitulo').html('<b>' + ref.reference_title_v + '</b>');
          //   $('#referenceTexto').html(ref.reference_text_v);

          //   infospot = new PANOLENS.Infospot(300, PANOLENS.DataImage.Info);
          //   infospot.position.set(ref.reference_x_i, ref.reference_y_i, ref.reference_z_i);
          //   infospot.addHoverElement(document.getElementById('desc-container'), 200);

          //   panorama.add(infospot);
          // });

          // $.each(data.galery, function (i, gal) {
          //   $('#carruselGaleria').append('<img src="' + gal.galery_src_v + '">');
          // });
          if (data.galery.length > 0) {
            $('#btnVerGaleria').show();

            $('#mdlBodyGaleria').html('<div class="fotorama" data-auto="false" data-nav="thumbs" data-allowfullscreen="true" id="carruselGaleria"></div>');
            $('.fotorama').fotorama({
              data: data.galery
            });
          }

          viewer.add(panorama);
        }, 1000);
      }
    });
  }
});

function arreglaFormatoMovil() {
  setTimeout(() => {
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
      $('.VolumeSlider').hide();
      $('.songTitle').show();
      $('.songAuthor').show();
      $('.songTitle').css("width", "75%");
      $('.songAuthor').css("width", "75%");
      $('.AudioShowHidePlaylist').css("top", "82px");
      $('.AudioShowHidePlaylist').css("left", "83px");
    }
  }, 100);
}

setInterval(() => {
  if (!stopLoadDiretion) { 
    timerLoadDiretion++;
    // console.log(timerLoadDiretion);
    if (timerLoadDiretion >= 10) {
      $('#move-gral').fadeIn();
      setTimeout(() => {
        $('#move-gral').fadeOut();
      }, 2500);
      timerLoadDiretion = 0;
    }
  }
}, 1000);

function resetTimer() {
  timerLoadDiretion = 0;
  stopLoadDiretion=false;
  // console.log(timerLoadDiretion);
}
function stopTimer() {
  setTimeout(() => {
    timerLoadDiretion = 0
    stopLoadDiretion=true;
    // console.log(timerLoadDiretion);
    // console.log("llegaaa");
  }, 100);
}
