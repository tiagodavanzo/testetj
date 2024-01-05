<div class="ibox-head">
        <div class="ibox-title">Livro</div>
    </div>
    <div class="ibox-body">
        <div id="tabs">
            <ul class="nav nav-tabs">

                <li class="nav-item">
                    <a class="nav-link active" href="#tab-book" data-toggle="tab">Livros</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#tab-form" data-toggle="tab">Formulário</a>
                </li>

            </ul>
            <div class="tab-content">

                <div class="tab-pane active" id="tab-book">
                    <p>
                        <button type="button" onclick="LoadTab(1, 'Cadastrar')" class="btn btn-primary">Novo Livro</button>
                        <button type="button" onclick="ShowAll('#books')" class="btn btn-dark" style="margin-right: 15px">Atualizar</button>
                    </p>

                    <table id="books" class="table table-striped table-bordered table-hover" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>TÍTULO</th>
                                <th>EDITORA</th>
                                <th>EDIÇÃO</th>
                                <th>ANO</th>
                                <th>PREÇO</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="tab-pane" id="tab-form">  
                    <form id="frmBook" action="" method="post">
                        <input type="hidden" id="hdId" value="">
                        <div class="row">
                            <div class="col-3">
                                <div class="loading"></div>
                                <span id="info" style="font-weight:600; color: #7f8c8d"></span>   
                                <label class="lb-sm" style="color: #7f8c8d"><strong>Título:</strong></label><br />
                                <input type="text" id="txtTitle" name="txtTitle" class="form-control" required><br />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <span id="info" style="font-weight:600; color: #7f8c8d"></span>   
                                <label class="lb-sm" style="color: #7f8c8d"><strong>Editora:</strong></label><br />
                                <input type="text" id="txtPublisher" name="txtPublisher" class="form-control" required><br />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <span id="info" style="font-weight:600; color: #7f8c8d"></span>   
                                <label class="lb-sm" style="color: #7f8c8d"><strong>Edição:</strong></label><br />
                                <input type="text" id="txtEdition" name="txtEdition" class="form-control" required><br />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <span id="info" style="font-weight:600; color: #7f8c8d"></span>   
                                <label class="lb-sm" style="color: #7f8c8d"><strong>Ano:</strong></label><br />
                                <input type="text" id="txtYear" name="txtYear" class="form-control" required><br />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <span id="info" style="font-weight:600; color: #7f8c8d"></span>   
                                <label class="lb-sm" style="color: #7f8c8d"><strong>Preço:</strong></label><br />
                                <input type="text" id="txtPrice" name="txtPrice" class="form-control" required><br />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <button id="btnOK" class="btn btn-primary" type="button" onclick="Book()">Cadastrar</button>
                                <button id="btnVoltar" class="btn btn-danger" type="button" onclick="LoadTab(0, 'Cadastrar')">Voltar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>