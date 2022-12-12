<?php
include("dashboard.php");


$id = $_GET['edit'];

?>
<div class="container">
  <?php

  if (isset($_POST['update_product'])) {
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
      $update = "UPDATE produto SET nomeProduto = '$product_name', descricaoProduto = '$product_description', precoProduto = '$product_price', idFornecedor = '$product_supplier', idCategoria = '$product_category', qtdeProduto = '$product_qtde', imagemProduto = '$product_image' WHERE idProduto = $id";

      $upload = mysqli_query($conn, $update);
      if ($upload) {
        move_uploaded_file($product_image_tmp_name, $product_image_folder);
        $message[] = 'Produto atualizado com sucesso!';
        header("Location:addProduto.php");
      } else {
        $message[] = 'O produto não pôde ser atualizado!';
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
    $select = mysqli_query($conn, "SELECT * FROM produto WHERE idProduto = $id");
    while ($row = mysqli_fetch_assoc($select)) {

    ?>

      <form action="<?php $_SERVER['PHP_SELF'] ?>" class="row g-3" method="post" enctype="multipart/form-data">
        <h2>Atualizar produto</h2>
        <div class="col-md-6">
          <label for="nomeProduto" class="form-label">Nome do produto</label>
          <input type="text" placeholder="Digite o nome do produto" name="product_name" class="form-control" value="<?php echo $row['nomeProduto'] ?>">
        </div>

        <div class="col-12">
          <label for="descricaoProduto" class="form-label">Descrição</label>
          <textarea name="product_description" placeholder="Descreva o produto" cols="20" rows="5" class="form-control"><?php echo $row['descricaoProduto'] ?></textarea>
        </div>

        <div class=" col-md-2">
          <label for="precoProduto" class="form-label">Preço</label>
          <input type="text" id="precoProduto" placeholder="Digite o valor" name="product_price" class="form-control" value="<?php echo $row['precoProduto'] ?>">
        </div>

        <div class="col-md-2">
          <label for="qtdeProduto" class="form-label">Quantidade</label>
          <input type="number" placeholder="Digite a quantidade" name="product_qtde" class="form-control" value="<?php echo $row['qtdeProduto'] ?>">
        </div>

        <?php
        $selectFornecedor = mysqli_query($conn, "SELECT f.* FROM fornecedor f ORDER BY f.nomeFornecedor");
        $selectCategoria = mysqli_query($conn, "SELECT c.* FROM categoria c GROUP BY c.nomeCategoria");
        ?>

        <div class="col-md-3">
          <label for="idFornecedor" class="form-label">Fornecedores</label>
          <select name="product_supplier" class="form-select">
            <option selected>Selecione o fornecedor</option>
            <?php while ($row = mysqli_fetch_assoc($selectFornecedor)) { ?>
              <option name="product_supplier" selected value="<?php echo $row['idFornecedor'] ?>"><?php echo $row['nomeFornecedor']; ?></option>
            <?php }; ?>
          </select>
        </div>

        <div class="col-md-3">
          <label for="idCategoria" class="form-label">Categorias</label>
          <select name="product_category" class="form-select">
            <option selected>Selecione a categoria</option>
            <?php while ($row = mysqli_fetch_assoc($selectCategoria)) { ?>
              <option name="product_category" selected value="<?php echo $row['idCategoria'] ?>"><?php echo $row['nomeCategoria']; ?></option>
            <?php }; ?>
          </select>
        </div>

        <div class="col-md-4">
          <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="form-control" />
        </div>
        </br>
        <div class="col-md-4">
          <input type="submit" class="btn btn-outline-warning" name="update_product" value="Atualizar Produto" />
        </div>
      </form>
    <?php }; ?>
  </div>
</div>
<script>
  $('#precoProduto').mask('000.000.000.000.000,00', {
    reverse: true
  });
</script>
<?php include("rodape.php");
