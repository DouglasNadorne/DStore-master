<?php include("dashboard.php") ?>
<div class="barra-superior"></div>
<div class="container">
  <div class="d-flex justify-content-between align-items-center pt-3 pb-2">
    <h1 class="display-5 mb-4">Usuários cadastrados</h1>
    <!-- Button relatorios -->
    <a href="gerar_relatorio_usuario.php" style="text-decoration: none;"><button href="" type="button" class="btn btn-outline-dark ">
        Relatorio </button></a>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-outline-primary " data-bs-toggle="modal" data-bs-target="#cadUsuarioModal">
      Cadastrar </button>
  </div>

  <span id="msgAlerta"></span>

  <table id="listar-usuario" class="table table-striped table-hover display" style="width:110%">
    <thead>
      <tr>
        <th>Id</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Data de Nascimento</th>
        <th>CPF</th>
        <th>Cargo</th>

        <th>Ações</th>
      </tr>
    </thead>
  </table>
</div>
<!-- Modal cadastrar-->
<div class="modal fade" id="cadUsuarioModal" tabindex="-1" aria-labelledby="cadUsuarioModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="cadUsuarioModalLabel">Detalhes Usuário</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <span id="msgAlertErroCad"></span>

        <form class="row g-3" method="POST" id="form-cad-usuario">
          <div class="col-md-6">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" id="nomeUsuario" placeholder="Nome completo">
          </div>
          <div class="col-12">
            <label for="emailUsuario" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="emailUsuario" placeholder="Email">
          </div>

          <div class="col-md-4">
            <label for="data_nascimento" class="form-label">Data de nascimento</label>
            <input type="date" name="data_nascimento" class="form-control" id="data_nascimento">
          </div>

          <div class="col-md-6">
            <label for="cpf" class="form-label">CPF</label>
            <input type="text" name="cpf" class="form-control" id="cpf" placeholder="000.000.000-00">
          </div>

          <div class="col-md-4">
            <label for="cargo" class="form-label">Cargo</label>
            <input type="text" name="cargo" class="form-control" id="cargoUsuario" placeholder="Cargo">
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
          <div class="col-md-6">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" name="senha" class="form-control" id="senha" placeholder="Senha">
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
<div class="modal fade" id="visUsuarioModal" tabindex="-1" aria-labelledby="visUsuarioModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="visUsuarioModalLabel">Detalhes do Usuário</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <dl class="row">
          <dt class="col-sm-3">ID</dt>
          <dd class="col-sm-9"><span id="id"></span></dd>

          <dt class="col-sm-3">Nome</dt>
          <dd class="col-sm-9"><span id="nomesUsuario"></span></dd>

          <dt class="col-sm-3">Email</dt>
          <dd class="col-sm-9"><span id="emailUsuarios"></span></dd>

          <dt class="col-sm-3">Data de Nascimento</dt>
          <dd class="col-sm-9"><span id="dataNascimento"></span></dd>

          <dt class="col-sm-3">CPF</dt>
          <dd class="col-sm-9"><span id="cpfUsuario"></span></dd>

          <dt class="col-sm-3">Cargo</dt>
          <dd class="col-sm-9"><span id="cargoUsuario"></span></dd>

          <dt class="col-sm-3">CEP</dt>
          <dd class="col-sm-9"><span id="cepUsuario"></span></dd>

          <dt class="col-sm-3">Estado</dt>
          <dd class="col-sm-9"><span id="estadoUsuario"></span></dd>

          <dt class="col-sm-3">Cidade</dt>
          <dd class="col-sm-9"><span id="cidadeUsuario"></span></dd>

        </dl>
      </div>

    </div>
  </div>
</div>

<!-- Modal Editar-->
<div class="modal fade" id="editUsuarioModal" tabindex="-1" aria-labelledby="editUsuarioModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editUsuarioModalLabel">Editar dados do Usuário</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <span id="msgAlertErroEdit"></span>

        <form class="row g-3" method="POST" id="form-edit-usuario">
          <input type="hidden" name="id" class="form-control" id="editIdUsuario">

          <div class="col-md-6">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" id="editNomeUsuario" placeholder="Nome completo">
          </div>

          <div class="col-12">
            <label for="emailUsuario" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="editEmailUsuario" placeholder="Email">
          </div>

          <div class="col-md-4">
            <label for="data_nascimento" class="form-label">Data de nascimento</label>
            <input type="date" name="data_nascimento" class="form-control" id="editDataNascimento">
          </div>

          <div class="col-md-6">
            <label for="cpf" class="form-label">CPF</label>
            <input type="text" name="cpf" class="form-control" id="editCpf" placeholder="000.000.000-00">
          </div>

          <div class="col-md-4">
            <label for="cargo" class="form-label">Cargo</label>
            <input type="text" name="cargo" class="form-control" id="editCargoUsuario" placeholder="Cargo">
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
  $("#cpf").mask("000.000.000-00");
  $("#cep").mask("00000-000");
  $("#editCpf").mask("000.000.000-00");
  $("#editCep").mask("00000-000");
</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script src="./js/table/custom_usuario.js"></script>

<?php include("rodape.php") ?>