<?php
include("dashboard.php");


$id = $_GET['edit'];

?>
<div class="container">
  <?php

  if (isset($_POST['update_order'])) {
    $order_product = $_POST['order_product'];
    $order_employee = $_POST['order_employee'];
    $order_client = $_POST['order_client'];
    $order_price = $_POST['order_price'];
    $order_date = $_POST['order_date'];

    if (empty($order_product) || empty($order_employee) || empty($order_client) || empty($order_price) || empty($order_date)) {
      $message[] = 'Preencha todos os campos!';
    } else {
      $update = "UPDATE venda SET idProduto = '$order_product', idUsuario = '$order_employee', idCliente = '$order_client', valorTotal = '$order_price', data = '$order_date' WHERE idVenda = $id";

      $upload = mysqli_query($conn, $update);
      if ($upload) {
        $message[] = 'Pedido atualizado com sucesso!';
        header("Location:addPedido.php");
      } else {
        $message[] = 'O pedido não pôde ser atualizado!';
      }
    }
  };
  ?>

  <?php
  if (isset($message)) {
    foreach ($message as $message) {
      echo '<span class="message">' . $message . '</span>';
    }
  }
  ?>


  <div class="admin-product-form-container centered">
    <?php
    $select = mysqli_query($conn, "SELECT * FROM venda WHERE idVenda = $id");
    $selectProduto = mysqli_query($conn, "SELECT p.* FROM produto p GROUP BY nomeProduto");
    $selectUsuario = mysqli_query($conn, "SELECT u.* FROM usuario u GROUP BY nome");
    $selectCliente = mysqli_query($conn, "SELECT c.* FROM cliente c GROUP BY nomeCliente");
    while ($row = mysqli_fetch_assoc($select)) {

    ?>

      <form action="<?php $_SERVER['PHP_SELF'] ?>" class="row g-3" method="post" enctype="multipart/form-data">
        <h2>Atualizar pedido</h2>

        <div class="col-md-3">
          <label class="form-label">Produto</label>
          <select name="order_product" class="form-select">
            <?php while ($row = mysqli_fetch_assoc($selectProduto)) { ?>
              <option selected name="product_supplier" value="<?php echo $row['idProduto'] ?>"><?php echo $row['nomeProduto']; ?></option>
            <?php }; ?>
          </select>
        </div>

        <div class="col-3">
          <label class="form-label">Funcionário</label>
          <select name="order_employee" class="form-select">
            <?php while ($row = mysqli_fetch_assoc($selectUsuario)) { ?>
              <option selected name="order_employee" value="<?php echo $row['id'] ?>"><?php echo $row['nome']; ?></option>
            <?php }; ?>
          </select>
        </div>

        <div class=" col-md-3">
          <label class="form-label">Cliente</label>
          <select name="order_client" class="form-select">
            <?php while ($row = mysqli_fetch_assoc($selectCliente)) { ?>
              <option selected name="order_client" value="<?php echo $row['idCliente'] ?>"><?php echo $row['nomeCliente']; ?></option>
            <?php }; ?>
          </select>
        </div>

        <div class="col-md-2">
          <label class="form-label">Quantidade</label>
          <input type="number" placeholder="Digite a quantidade" name="order_price" class="form-control" />
        </div>

        <div class="col-md-4">
          <label class="form-label">Data da venda</label>
          <input type="date" name="order_date" class="form-control" />
        </div>
        </br>
        <div class="col-md-4">
          </br>
          <input type="submit" class="btn btn-outline-warning" name="update_order" value="Atualizar Venda" />
        </div>
      </form>
    <?php }; ?>
  </div>
</div>

<?php include("rodape.php");
