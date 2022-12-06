<?php include("dashboard.php") ?>
<div class="container" style="margin-top: 20px;">

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
            <input type="text" name="cpf" class="form-control" id="editCpf" placeholder="CPF">
        </div>

        <div class="col-md-4">
            <label for="cargo" class="form-label">Cargo</label>
            <input type="text" name="cargo" class="form-control" id="editCargoUsuario" placeholder="Cargo">
        </div>

        <div class="col-md-4">
            <label for="cep" class="form-label">CEP</label>
            <input type="text" name="cep" class="form-control" id="editCep" placeholder="CEP">
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

        <div class="col-md-6">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" name="senha" class="form-control" id="editSenha" placeholder="Senha">
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-outline-primary" value="salvar">Salvar</button>
        </div>
    </form>
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
<script src="./js/table/custom_config.js"></script>


<?php include("rodape.php") ?>