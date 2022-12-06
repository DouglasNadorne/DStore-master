<!--<?php
    session_start();
    ob_start();
    include_once("config.php");

    if ((!isset($_SESSION['id'])) and (!isset($_SESSION['nome']))) {
      $_SESSION['msg'] = "<p style='color:red'>Erro: Necessário realizar o login para ter acesso a o nosso sistema!</p>";
      header("Location: index.php");
    }
    ?>-->

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="imagens/logo_transparent.ico" type="image/ x=ico">

  <!----======== Imports icons ========-->
  <script src="https://kit.fontawesome.com/6d56c32453.js" crossorigin="anonymous"></script>

  <!----======== Imports Font: Red Hat Display ========-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:wght@300;400;700;900&display=swap" rel="stylesheet">



  <!----======== CSS ========-->
  <link rel="stylesheet" href="./css/dashboard/reset.css">
  <link rel="stylesheet" href="./css/dashboard/main.css">
  <link rel="stylesheet" href="./css/dashboard/colors.css">
  <link rel="stylesheet" href="./css/dashboard/sidebar.css">
  <link rel="stylesheet" href="./css/dashboard/img-logo-empresa.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">


  <!----======== js ========-->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>


  <title>DStore</title>
</head>

<body>
  <div class="sidebar close">
    <div class="logo-details">
      <i class="fa-solid fa-store"></i>
      <span class="logo_name">DStore</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="inicio.php">
          <i class="fas fa-tachometer-alt"></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="inicio.php">Dashboard</a></li>
        </ul>
      </li>
      <li>
        <a href="tela_cliente.php">
          <i class="fa-solid fa-users"></i>
          <span class="link_name">Clientes</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="tela_cliente.php">Clientes</a></li>
        </ul>
      </li>
      <li>
        <div class="icon-link">
          <a href="#">
            <i class="fa-solid fa-cart-shopping"></i>
            <span class="link_name">Vendas</span>
          </a>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Vendas</a></li>
        </ul>
      </li>
      <li>
        <a href="tela_produtos.php">
          <i class="fa-solid fa-boxes-stacked"></i>
          <span class="link_name">Produtos</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="tela_produtos.php">Produtos</a></li>
        </ul>
      </li>
      <li>
        <a href="tela_fornecedor.php">
          <i class="fa-solid fa-truck-moving"></i>
          <span class="link_name">Fornecedores</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="tela_fornecedor.php">Fornecedores</a></li>
        </ul>
      </li>
      <li>
        <a href="tela_usuario.php">
          <i class="fa-solid fa-address-card"></i>
          <span class="link_name">Usuarios</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="tela_usuario.php">Usuarios</a></li>
        </ul>
      </li>
      <li>
        <a href="tela_config.php">
          <i class="fa-solid fa-gear"></i>
          <span class="link_name">Configurações</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="tela_config.php">Configurações</a></li>
        </ul>
      </li>
      <li>
        <div class="profile-details">
          <div class="profile-content">
            <!--<img src="image/profile.jpg" alt="profileImg">-->
          </div>
          <div class="name-job">
            <div class="profile_name"><?php echo $_SESSION['nome']; ?></div>
            <div class="job"><?php echo $_SESSION['cargo']; ?></div>
          </div>
          <a href="sair.php"><i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
      </li>
    </ul>
  </div>
  <section class="home-section">
    <div class="home-content">
      <i class="fa-solid fa-bars bx-menu"></i>
    </div>
  </section>
  <script>
    let arrow = document.querySelectorAll(".arrow");
    for (var i = 0; i < arrow.length; i++) {
      arrow[i].addEventListener("click", (e) => {
        let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
        arrowParent.classList.toggle("showMenu");
      });
    }
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".bx-menu");
    console.log(sidebarBtn);
    sidebarBtn.addEventListener("click", () => {
      sidebar.classList.toggle("close");
    });
  </script>