 <nav class="navbar navbar-vertical navbar-expand-xl navbar-light navbar-card" style="top: 10px;">
  <div class="d-flex align-items-center pb-3">
    <div class="toggle-icon-wrapper">

      <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-toggle="tooltip" data-placement="left" title="Menú de navegación"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>

    </div>
  </div>
  <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
    <div class="navbar-vertical-content perfect-scrollbar scrollbar">
<ul class="navbar-nav flex-column">
  <?php
  $menuspermisos = ControladorPerfiles::ctrMostrarMenusPermisos('perfiles_permisos_perfil_id_i',$_SESSION['perfil']);
  foreach($menuspermisos as $item){
    if($item['menus_treeview_i'] == 0 && $item['menus_tiemprReal_i'] == 0){	
      echo '<li class="nav-item" id="menu_'.$item['menus_html_href_v'].'">
      <a href="'.$item['menus_html_href_v'].'" class="nav-link">
      <i class="'.$item['menus_html_icon_v'].' nav-link-icon"></i><span class="nav-link-text">'.$item['menus_nombre_v'].'</span>
      </a>
      </li>';
    }
  }
  foreach($menuspermisos as $item){
    if($item['menus_treeview_i'] == 1){
      echo ' <li class="nav-item">
      <a href="#menu_'.$item['menus_html_href_v'].'" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="menu_'.$item['menus_html_href_v'].'" class="nav-link dropdown-indicator">
      <i class="'.$item['menus_html_icon_v'].' nav-link-icon"></i>
      <span class="nav-link-text">'.$item['menus_nombre_v'].'</span>
      </a>
      <ul class="nav collapse" id="menu_'.$item['menus_html_href_v'].'">';
      $opciones = ControladorPerfiles::ctrMostrarOpcionesMenu('opciones_menus_id_i',$item['perfiles_permisos_menu_id_i'], $_SESSION['perfil']);
      foreach($opciones as $item2){
        if($item2['opciones_padre_id_i'] == 0){
          echo '
          <li class="nav-item" id="op_'.$item2['opciones_html_href_v'].'">
          <a class="nav-link" href="'.$item2['opciones_html_href_v'].'">
          '.$item2['opciones_nombre_v'].'
          </a>
          </li>';
        }else{
          echo '
          <li class="nav-item">
          <a class="nav-link dropdown-indicator" href="#op_'.$item2['opciones_html_href_v'].'" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="op_'.$item2['opciones_html_href_v'].'">
          '.$item2['opciones_nombre_v'].'
          </a>';
          $sub_opciones = ControladorPerfiles::ctrMostrarSubOpcionesMenu('opciones_padre_id_i', $item2['perfiles_permisos_opciones_id_i']);
          echo '<ul class="nav collapse" id="op_'.$item2['opciones_html_href_v'].'" >';
          foreach($sub_opciones as $item3){
            echo '<li class="nav-item" id="op_'.$item3['opciones_html_href_v'].'">
            <a class="nav-link" href="'.$item3['opciones_html_href_v'].'">
            <i class="nav-link-icon"></i> '.$item3['opciones_nombre_v'].'
            </a>
            </li>';
          }
          echo '</ul>
          </li>';
        }
      }
      echo '
      </ul>
      </li>';
    }
  } 
  ?>
</ul>
    </div>
  </div>
</nav>