<?php include("dashboard.php") ?>
<div class="container">
  <div class="d-flex justify-content-between align-items-center pt-3 pb-2">
    <h1 class="display-5 mb-4">Fornecedores cadastrados</h1>

    <!-- Button relatorios -->
    <a href="gerar_relatorio_fornecedor.php" style="text-decoration: none;"><button href="" type="button" class="btn btn-outline-dark ">
        Relatorio </button></a>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-outline-primary " data-bs-toggle="modal" data-bs-target="#cadFornecedorModal">
      Cadastrar </button>
  </div>

  <span id="msgAlerta"></span>

  <table id="listar-fornecedor" class="table table-striped table-hover display" style="width:110%">
    <thead>
      <tr>
        <th>Id</th>
        <th>Nome</th>
        <th>CNPJ</th>
        <th>Telefone</th>
        <th>Email</th>
        <th>CEP</th>
        <th>Estado</th>
        <th>Cidade</th>


        <th>Ações</th>
      </tr>
    </thead>
  </table>
</div>
<!-- Modal cadastrar-->
<div class="modal fade" id="cadFornecedorModal" tabindex="-1" aria-labelledby="cadFornecedorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="cadFornecedorModalLabel">Detalhes Fornecedor</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <span id="msgAlertErroCad"></span>
        <form class="row g-3" method="POST" id="form-cad-fornecedor">
          <div class="col-md-6">
            <label for="nomeFornecedor" class="form-label">Nome</label>
            <input type="text" name="nomeFornecedor" class="form-control" id="nomeFornecedor" placeholder="Nome do Fornecedor">
          </div>
          <div class="col-md-6">
            <label for="cnpj" class="form-label">CNPJ</label>
            <input type="text" name="cnpj" class="form-control" id="cnpj" placeholder="00.000.000/0000-00">
          </div>
          <div class="col-md-12">
            <label for="emailFornecedor" class="form-label">Email</label>
            <input type="email" name="emailFornecedor" class="form-control" id="emailFornecedor" placeholder="Email">
          </div>
          <div class="col-4">
            <label for="telefoneFornecedor" class="form-label">Telefone</label>
            <input type="text" name="telefoneFornecedor" class="form-control" id="telefoneFornecedor" placeholder="(00) 0000-0000">
          </div>
          <div class="col-md-4">
            <label for="cep" class="form-label">CEP</label>
            <input type="text" name="cep" class="form-control" id="cep" placeholder="00000-000">
          </div>
          <div class="col-md-3">
            <label for="estado" class="form-label">Estado</label>
            <select id="estado" name="estado" class="form-select">
              <option selected> </option>
              <option>AC</option>
              <option>AL</option>
              <option>AP</option>
              <option>AM</option>
              <option>BA</option>
              <option>CE</option>
              <option>DF</option>
              <option>ES</option>
              <option>GO</option>
              <option>MA</option>
              <option>MT</option>
              <option>MS</option>
              <option>MG</option>
              <option>PA</option>
              <option>PB</option>
              <option>PR</option>
              <option>PE</option>
              <option>PI</option>
              <option>RJ</option>
              <option>RN</option>
              <option>RS</option>
              <option>RO</option>
              <option>RR</option>
              <option>SC</option>
              <option>SP</option>
              <option>SE</option>
              <option>TO</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="cidade" class="form-label">Cidade</label>
            <input type="text" name="cidade" class="form-control" id="cidade" placeholder="Cidade">
          </div>

          <div class="col-12">
            <button type="submit" class="btn btn-outline-primary btn-sm" value="cadastrar">Cadastrar</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<!-- Modal visualizar-->
<div class="modal fade" id="visFornecedorModal" tabindex="-1" aria-labelledby="visFornecedorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="visFornecedorModalLabel">Detalhes do Fornecedor</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <dl class="row">
          <dt class="col-sm-3">ID</dt>
          <dd class="col-sm-9"><span id="idFornecedor"></span></dd>

          <dt class="col-sm-3">Nome</dt>
          <dd class="col-sm-9"><span id="nomeFornecedor"></span></dd>

          <dt class="col-sm-3">CNPJ</dt>
          <dd class="col-sm-9"><span id="cnpj"></span></dd>

          <dt class="col-sm-3">Telefone</dt>
          <dd class="col-sm-9"><span id="telefoneFornecedor"></span></dd>

          <dt class="col-sm-3">Email</dt>
          <dd class="col-sm-9"><span id="emailFornecedor"></span></dd>

          <dt class="col-sm-3">CEP</dt>
          <dd class="col-sm-9"><span id="cepFornecedor"></span></dd>

          <dt class="col-sm-3">Estado</dt>
          <dd class="col-sm-9"><span id="estadoFornecedor"></span></dd>

          <dt class="col-sm-3">Cidade</dt>
          <dd class="col-sm-9"><span id="cidadeFornecedor"></span></dd>
        </dl>
      </div>

    </div>
  </div>
</div>

<!-- Modal Editar-->
<div class="modal fade" id="editFornecedorModal" tabindex="-1" aria-labelledby="editFornecedorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editFornecedorModalLabel">Editar dados do Fornecedor</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <span id="msgAlertErroEdit"></span>
        <form class="row g-3" method="POST" id="form-edit-fornecedor">
          <input type="hidden" name="idFornecedor" class="form-control" id="editIdFornecedor">

          <div class="col-md-6">
            <label for="nomeFornecedor" class="form-label">Nome</label>
            <input type="text" name="nomeFornecedor" class="form-control" id="editNomeFornecedor" placeholder="Nome do Fornecedor">
          </div>

          <div class="col-md-6">
            <label for="CNPJ" class="form-label">CNPJ</label>
            <input type="text" name="cnpj" class="form-control" id="editCnpj" placeholder="00.000.000/0000-00">
          </div>

          <div class="col-md-4">
            <label for="telefoneFornecedor" class="form-label">Telefone</label>
            <input type="text" name="telefoneFornecedor" class="form-control" id="editTelefoneFornecedor" placeholder="(00) 0000-0000">
          </div>

          <div class="col-12">
            <label for="emailFornecedor" class="form-label">Email</label>
            <input type="email" name="emailFornecedor" class="form-control" id="editEmailFornecedor" placeholder="Email">
          </div>

          <div class="col-md-4">
            <label for="cep" class="form-label">CEP</label>
            <input type="text" name="cep" class="form-control" id="editCep" placeholder="00000-000">
          </div>

          <div class="col-md-3">
            <label for="estado" class="form-label">Estado</label>
            <select id="editEstado" name="estado" class="form-select">
              <option selected> </option>
              <option>AC</option>
              <option>AL</option>
              <option>AP</option>
              <option>AM</option>
              <option>BA</option>
              <option>CE</option>
              <option>DF</option>
              <option>ES</option>
              <option>GO</option>
              <option>MA</option>
              <option>MT</option>
              <option>MS</option>
              <option>MG</option>
              <option>PA</option>
              <option>PB</option>
              <option>PR</option>
              <option>PE</option>
              <option>PI</option>
              <option>RJ</option>
              <option>RN</option>
              <option>RS</option>
              <option>RO</option>
              <option>RR</option>
              <option>SC</option>
              <option>SP</option>
              <option>SE</option>
              <option>TO</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="cidade" class="form-label">Cidade</label>
            <input type="text" name="cidade" class="form-control" id="editCidade" placeholder="Cidade">
          </div>

          <div class="col-12">
            <button type="submit" class="btn btn-outline-warning btn-sm" value="salvar">Salvar</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<script>
  $('#cnpj').mask('00.000.000/0000-00', {
    reverse: true
  });
  $('#telefoneFornecedor').mask('(00) 0000-0000');
  $("#cep").mask("00000-000");
  $('#editCnpj').mask('00.000.000/0000-00', {
    reverse: true
  });
  $('#editTelefoneFornecedor').mask('(00) 0000-0000');
  $("#editCep").mask("00000-000");
</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script src="./js/table/custom_fornecedor.js"></script>

<?php include("rodape.php") ?>