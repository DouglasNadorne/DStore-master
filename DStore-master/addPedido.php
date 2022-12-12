<?php
include("dashboard.php");



if (isset($_POST['add_order'])) {
  $order_product = $_POST['order_product'];
  $order_employee = $_POST['order_employee'];
  $order_client = $_POST['order_client'];
  $order_price = $_POST['order_price'];
  $order_date = $_POST['order_date'];

  if (empty($order_product) || empty($order_employee) || empty($order_client) || empty($order_price) || empty($order_date)) {
    $message[] = 'Preencha todos os campos!';
  } else {
    $insert = "INSERT INTO venda(idProduto, idUsuario, idCliente, valorTotal, data) VALUES ('$order_product', '$order_employee', '$order_client', '$order_price', '$order_date')";

    $upload = mysqli_query($conn, $insert);
    if ($upload) {
      $message[] = 'Pedido registrado com sucesso!';
    } else {
      $message[] = 'O pedido não pôde ser registrado!';
    }
  }
};

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM venda WHERE idVenda = $id");
  header('location:addPedido.php');
};

?>

<div class="container">

  <?php
  if (isset($message)) {
    foreach ($message as $message) {
      echo '<span class="message">' . $message . '</span>';
    }
  }
  ?>

  <form action="<?php $_SERVER['PHP_SELF'] ?>" class="row g-3" method="post" enctype="multipart/form-data">
    <h2>Cadastrar novo pedido</h2>

    <?php
    $selectProduto = mysqli_query($conn, "SELECT p.* FROM produto p GROUP BY nomeProduto");
    $selectUsuario = mysqli_query($conn, "SELECT u.* FROM usuario u GROUP BY nome");
    $selectCliente = mysqli_query($conn, "SELECT c.* FROM cliente c GROUP BY nomeCliente");
    ?>

    <div class="col-md-3">
      <label class="form-label">Produto</label>
      <select name="order_product" class="form-select">
        <option selected>Selecione o produto</option>
        <?php while ($row = mysqli_fetch_assoc($selectProduto)) { ?>
          <option name="product_supplier" value="<?php echo $row['idProduto'] ?>"><?php echo $row['nomeProduto']; ?></option>
        <?php }; ?>
      </select>
    </div>

    <div class="col-md-3">
      <label class="form-label">Funcionário</label>
      <select name="order_employee" class="form-select">
        <option selected>Selecione o funcionário</option>
        <?php while ($row = mysqli_fetch_assoc($selectUsuario)) { ?>
          <option name="order_employee" value="<?php echo $row['id'] ?>"><?php echo $row['nome']; ?></option>
        <?php }; ?>
      </select>
    </div>

    <div class="col-md-3">
      <label class="form-label">Cliente</label>
      <select name="order_client" class="form-select">
        <option selected>Selecione o cliente</option>
        <?php while ($row = mysqli_fetch_assoc($selectCliente)) { ?>
          <option name="order_client" value="<?php echo $row['idCliente'] ?>"><?php echo $row['nomeCliente']; ?></option>
        <?php }; ?>
      </select>
    </div>

    <div class="col-md-2">
      <label class="form-label">Quantidade</label>
      <input type="number" placeholder="Digite a quantidade" name="order_price" class="form-control" />
    </div>

    <div class="col-md-2">
      <label class="form-label">Data da venda</label>
      <input type="date" name="order_date" class="form-control" />
    </div>


    <div class="col-md-4">
      </br>
      <input type="submit" class="btn btn-outline-primary" name="add_order" value="Cadastrar Venda" />
      <a href="gerar_relatorio_venda.php" style="text-decoration: none;"><button href="" type="button" class="btn btn-outline-dark">Relatorio</button></a>
    </div>

  </form>
</div>
<br>
<br>
<div class="container">
  <table class="table table-striped table-hover display" style="width:110%">
    <thead>
      <tr>
        <th>Produto</th>
        <th>Cliente</th>
        <th>Funcionário</th>
        <th>Quantidade</th>
        <th>Data</th>
        <th>Ação</th>
      </tr>
    </thead>
    <?php
    $select = mysqli_query($conn, "SELECT *, nomeProduto, nomeCliente, u.nome FROM venda v INNER JOIN produto p ON v.idProduto = p.idProduto INNER JOIN cliente c ON v.idCliente = c.idCliente INNER JOIN usuario u ON v.idUsuario = u.id");
    ?>

    <?php while ($row = mysqli_fetch_assoc($select)) { ?>
      <tr>
        <td><?php echo $row['nomeProduto']; ?></td>
        <td><?php echo $row['nomeCliente']; ?></td>
        <td><?php echo $row['nome']; ?></td>
        <td><?php echo $row['valorTotal']; ?></td>
        <td><?php echo $row['data']; ?></td>
        <td>
          <a href="editarPedido.php?edit=<?php echo $row['idVenda']; ?>" style="text-decoration: none;"> <button type="button" class="btn btn-outline-warning btn-sm">Editar</button> </a>
          <a href="addPedido.php?delete=<?php echo $row['idVenda']; ?>" style="text-decoration: none;"> <button type="button" class="btn btn-outline-danger btn-sm">Excluir</button></a>
        </td>
      </tr>
    <?php }; ?>
  </table>
</div>
</div>
</div>
<?php
include("rodape.php");
?>