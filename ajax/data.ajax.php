<?php
require_once '../modelos/dao.modelo.php';
header('Content-Type: charset=utf-8');
date_default_timezone_set('America/Bogota');

class AjaxCobertura
{
  public function ajaxGetData()
  {
    $configuracion = ModeloDAO::mdlMostrarUnitario('*', 'config', 'config_id_i=1');
    $marcadores = ModeloDAO::mdlMostrar('*', 'markers', '');
    $background = ModeloDAO::mdlMostrar('*', 'background', '');
    $illustrations = ModeloDAO::mdlMostrar('*', 'illustrations', '');
    $respuesta = array('configuracion' => $configuracion, 'marcadores' => $marcadores, 'background' => $background, 'illustrations' => $illustrations);
    echo json_encode($respuesta);
  }

  public function ajaxGetDataPlaces($id)
  {
    $reference = ModeloDAO::mdlMostrar('*', 'reference', 'reference_marker_id_v='.$id);
    $galery = ModeloDAO::mdlMostrar('galery_src_v as img', 'galery', 'galery_marker_id_i='.$id);
    $place = ModeloDAO::mdlMostrarUnitario('*', 'markers', 'markers_id_i='.$id);
    $respuesta = array('reference' => $reference, 'place' => $place, 'galery' => $galery);
    echo json_encode($respuesta);
  }
  public function ajaxGetPagePdf($titulo){
    $audio=ModeloDAO::mdlMostrarUnitario('audios_pagina_i as id', 'audios', 'audios_nombre_v="'.$titulo.'"');
    echo $audio['id'];
  }
}

if (isset($_POST['getCoberturas'])) {
  $x = new AjaxCobertura();
  $x->ajaxGetData();
}

if (isset($_POST['getInfoPlaces'])) {
  $x = new AjaxCobertura();
  $x->ajaxGetDataPlaces($_POST['getInfoPlaces']);
}

if (isset($_POST['getPagePdfTitulo'])) {
  $x = new AjaxCobertura();
  $x->ajaxGetPagePdf($_POST['getPagePdfTitulo']);
}
