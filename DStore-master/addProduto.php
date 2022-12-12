<?php
include("dashboard.php");

?>

<?php

if (isset($_POST['add_product'])) {
  $product_name = $_POST['product_name'];
  $product_description = $_POST['product_description'];
  $product_price = $_POST['product_price'];
  $product_supplier = $_POST['product_supplier'];
  $product_category = $_POST['product_category'];
  $product_qtde = $_POST['product_qtde'];
  $product_image = $_FILES['product_image']['name'];
  $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
  $product_image_folder = 'assets/images/' . $product_image;

  if (empty($product_name) || empty($product_description) || empty($product_price) || empty($product_supplier) || empty($product_category) || empty($product_qtde)) {
    $message[] = 'Preencha todos os campos!';
  } else {
    $insert = "INSERT INTO produto(nomeProduto, descricaoProduto, precoProduto, idFornecedor, idCategoria, qtdeProduto, imagemProduto) VALUES ('$product_name', '$product_description', '$product_price', '$product_supplier', '$product_category', '$product_qtde', '$product_image')";

    $upload = mysqli_query($conn, $insert);


    if ($upload) {
      move_uploaded_file($product_image_tmp_name, $product_image_folder);
      $message[] = 'Produto adicionado com sucesso!';
    } else {
      $message[] = 'O produto não pôde ser adicionado!';
    }
  }
};

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM produto WHERE idProduto = $id");
  header('location:addProduto.php');
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
    <h2>Adicionar novo produto</h2>
    <div class="col-md-6">
      <label for="nomeProduto" class="form-label">Nome do produto</label>
      <input type="text" placeholder="Digite o nome do produto" name="product_name" class="form-control">
    </div>
    <div class="col-12">
      <label for="descricaoProduto" class="form-label">Descrição</label>
      <textarea name="product_description" placeholder="Descreva o produto" cols="20" rows="5" class="form-control"></textarea>
    </div>
    <div class=" col-md-2">
      <label for="precoProduto" class="form-label">Preço</label>
      <input type="text" id="precoProduto" placeholder="Digite o valor" name="product_price" class="form-control" />
    </div>
    <div class="col-md-2">
      <label for="qtdeProduto" class="form-label">Quantidade</label>
      <input type="number" placeholder="Digite a quantidade" name="product_qtde" class="form-control" />
    </div>

    <?php
    $selectFornecedor = mysqli_query($conn, "SELECT f.* FROM fornecedor f");
    $selectCategoria = mysqli_query($conn, "SELECT c.* FROM categoria c");
    ?>
    <div class="col-md-3">
      <label for="idFornecedor" class="form-label">Fornecedores</label>
      <select name="product_supplier" class="form-select">
        <option selected>Selecione o fornecedor</option>
        <?php while ($row = mysqli_fetch_assoc($selectFornecedor)) { ?>
          <option name="product_supplier" value="<?php echo $row['idFornecedor'] ?>"><?php echo $row['nomeFornecedor']; ?></option>
        <?php }; ?>
      </select>
    </div>
    <div class="col-md-3">
      <label for="idCategoria" class="form-label">Categorias</label>
      <select name="product_category" class="form-select">
        <option selected>Selecione a categoria</option>
        <?php while ($row = mysqli_fetch_assoc($selectCategoria)) { ?>
          <option name="product_category" value="<?php echo $row['idCategoria'] ?>"><?php echo $row['nomeCategoria']; ?></option>
        <?php }; ?>
      </select>
    </div>
    <div class="col-md-4">
      <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="form-control" />
    </div>
    </br>
    <div class="col-md-4">
      <input type="submit" class="btn btn-outline-primary" name="add_product" value="Adicionar Produto" />
      <a href="gerar_relatorio_produto.php" style="text-decoration: none;"><button href="" type="button" class="btn btn-outline-dark ">
          Relatorio </button></a>
    </div>
  </form>
</div>
</br>
</br>
<div class="container">
  <table class="table table-striped table-hover display" style="width:110%">
    <thead>
      <tr>
        <th>Imagem</th>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Preço</th>
        <th>Quantidade</th>
        <th>Fornecedor</th>
        <th>Categoria</th>
        <th>Ação</th>
      </tr>
    </thead>

    <?php
    $select = mysqli_query($conn, "SELECT *, nomeFornecedor, nomeCategoria FROM produto p INNER JOIN fornecedor f ON p.idFornecedor = f.idFornecedor INNER JOIN categoria c ON p.idCategoria = c.idCategoria");
    ?>
    <?php while ($row = mysqli_fetch_assoc($select)) { ?>
      <tr>
        <td><img src="assets/images/<?php echo $row['imagemProduto']; ?>" height="100" alt=""></td>
        <td><?php echo $row['nomeProduto']; ?></td>
        <td><?php echo $row['descricaoProduto']; ?></td>
        <td><?php echo $row['precoProduto']; ?></td>
        <td><?php echo $row['qtdeProduto']; ?></td>
        <td><?php echo $row['nomeFornecedor']; ?></td>
        <td><?php echo $row['nomeCategoria']; ?></td>
        <td>
          <a href="editarProduto.php?edit=<?php echo $row['idProduto']; ?>" style="text-decoration: none;"> <button type="button" class="btn btn-outline-warning btn-sm">Editar</button> </a>
          <a href="addProduto.php?delete=<?php echo $row['idProduto']; ?>" style="text-decoration: none;"> <button type="button" class="btn btn-outline-danger btn-sm">Excluir</button></a>
        </td>
      </tr>
    <?php }; ?>
  </table>
</div>
</div>
</div>

<script>
  $('#precoProduto').mask('000.000.000.000.000,00', {
    reverse: true
  });
</script>
<?php
include("rodape.php");
?>