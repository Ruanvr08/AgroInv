<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Incluindo o link pros icones dos botoes -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">

    <title>Controle de Estoque</title>
    <!-- Inclua as bibliotecas do Bootstrap e jQuery -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/AgroInv/public/css/estoque.css" type="text/css">
</head>

<body>

    <!-- GUIA  DOS GENEROS ALIMENTICIOS -->

    <div id="alimenticios" class="tab-content">
        <section class="container">
       
            <h1 id='titulo'>Controle de Estoque</h1>
           
            <form action="<?=URL?>/estoques/index" method="POST">
                <div class="form-group">
                    <select name="categoria" id="categoria" class="form-control" required>
                        <option value="" disabled selected>Filtrar por categoria</option>
                        <option value="">Todos</option>
                        <option value="gen. alimenticios">gen. alimenticios</option>
                        <option value="aditivos e cond.">aditivos e cond.</option>
                        <option value="embalagens">embalagens</option>
                        <option value="prods. de limpeza">prods. de limpeza</option>
                        <option value="insumos">insumos</option>
                    </select>
                </div>
                <button type="submit"  class="btn btn-warning">Filtrar</button>
                <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addItemModal">
                Adicionar Item
            </button>
            </form>
            

            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nome do Produto</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Unidade</th>
                        <th scope="col">Data de Validade</th>
                        <th scope="col">Categoria</th>
                        <th scope="col" id="ac">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dados['produtos'] as $produto): ?>
                    <tr>
                        <td><?php echo $produto->nome; ?></td>
                        <td><?php echo $produto->quantidade; ?></td>
                        <td><?php echo $produto->unidade; ?></td>
                        <td><?php echo $produto->validade; ?></td>
                        <td><?php echo $produto->categoria; ?></td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm mr-2 editButton" data-id="<?= $produto->id ?>"
                                data-nome="<?= $produto->nome ?>" data-unidade="<?= $produto->unidade ?>"
                                data-quantidade="<?= $produto->quantidade ?>" data-validade="<?= $produto->validade ?>">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="#" class="btn btn-danger btn-sm deleteButton" data-id="<?= $produto->id ?>"
                                data-toggle="modal" data-target="#confirmDeleteModal">
                                <i class="fas fa-trash"></i> Deletar
                            </a>
                        </td>
                    </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>

    <!-- FIM DAS GUIAS -->

    <div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addItemModalLabel">Adicionar Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?=URL?>/estoques/cadastrar" method="post">

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="productName">Nome do Produto</label>
                            <input type="text" class="form-control" id="nome" name="nome"
                                placeholder="Digite o nome do produto" required>
                        </div>
                        <div class="form-group">
                            <label for="unit">Unidade</label>
                            <select name="unidade" id="unidade" class="form-control" required>
                                <option value="" disabled selected>Selecione sua unidade</option>
                                <option value="kg">kg</option>
                                <option value="grama">grama</option>
                                <option value="litro">litro</option>
                                <option value="ml">ml</option>
                                <option value="pacote">pacote</option>
                                <option value="molho">molho</option>
                                <option value="molho">rolo</option>
                                <option value="frasco">frasco</option>
                                <option value="unidade">unidades</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="categoria">Categoria</label>
                            <select name="categoria" id="categoriaform" class="form-control" required>
                                <option value="" disabled selected>Selecione sua categoria</option>
                                <option value="gen. alimenticios">gen. alimenticios</option>
                                <option value="aditivos e cond.">aditivos e cond.</option>
                                <option value="embalagens">embalagens</option>
                                <option value="prods. de limpeza">prods. de limpeza</option>
                                <option value="insumos">insumos</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="quantity">Quantidade</label>
                            <input type="number" class="form-control" id="quantidade" name="quantidade"
                                placeholder="Digite a quantidade" required>
                        </div>
                        <div class="form-group">
                            <label for="validityDate">Data de Validade</label>
                            <input type="date" class="form-control" id="validade" name="validade" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-secondary" id="saveItem">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editItemModalLabel">Editar Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?=URL?>/estoques/editar" method="post">
                        <div class="form-group">
                            <label for="editProductName">Nome do Produto</label>
                            <input type="text" class="form-control" id="editProductName" name="nome"
                                placeholder="Digite o nome do produto" required>
                        </div>
                        <div class="form-group">
                            <label for="editUnit">Unidade</label>
                            <select class="form-control" id="editUnit" name="unidade" required>
                                <option value="kg">kg</option>
                                <option value="grama">grama</option>
                                <option value="unidade">unidade</option>
                                <option value="litro">litro</option>
                                <option value="ml">ml</option>
                                <option value="pacote">pacote</option>
                                <option value="molho">molho</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editQuantity">Quantidade</label>
                            <input type="number" class="form-control" id="editQuantity" name="quantidade"
                                placeholder="Digite a quantidade" required>
                        </div>
                        <div class="form-group">
                            <label for="categoria">Categoria</label>
                            <select name="categoria" id="editCategory" class="form-control" required>
                                <option value="" disabled selected>Selecione sua categoria</option>
                                <option value="gen. alimenticios">gen. alimenticios</option>
                                <option value="aditivos e cond.">aditivos e cond.</option>
                                <option value="embalagens">embalagens</option>
                                <option value="prods. de limpeza">prods. de limpeza</option>
                                <option value="insumos">insumos</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editValidityDate">Data de Validade</label>
                            <input type="date" class="form-control" id="editValidityDate" name="validade" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-secondary" id="updateItem">Atualizar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
        aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Exclusão</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza de que deseja excluir este item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Deletar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('.editButton').click(function() {
            var id = $(this).data('id');
            var nome = $(this).data('nome');
            var unidade = $(this).data('unidade');
            var quantidade = $(this).data('quantidade');
            var validade = $(this).data('validade');
            var categoria = $(this).closest('tr').find('td:eq(4)').text().trim();
            $('#editProductName').val(nome);
            $('#editQuantity').val(quantidade);
            $('#editValidityDate').val(validade);
            var unitSelect = $('#editUnit');
            unitSelect.find('option').removeAttr('selected');
            var optionExists = false;
            unitSelect.find('option').each(function() {
                if ($(this).val() == unidade) {
                    $(this).prop('selected', true);
                    optionExists = true;
                    return false;
                }
            });
            if (!optionExists) {
                unitSelect.append($('<option>', {
                    value: unidade,
                    text: unidade,
                    selected: true
                }));
            }
            var unitSelect = $('#editCategory');
            unitSelect.find('option').removeAttr('selected');
            var optionExists = false;
            unitSelect.find('option').each(function() {
                if ($(this).val() == categoria) {
                    $(this).prop('selected', true);
                    optionExists = true;
                    return false;
                }
            });
            if (!optionExists) {
                unitSelect.append($('<option>', {
                    value: categoria,
                    text: categoria,
                    selected: true
                }));
            }
            $('#editItemModal form').attr('action', '<?= URL ?>/estoques/editar/' + id);
            $('#editItemModal').modal('show');
        });
        $('.deleteButton').click(function() {
            var id = $(this).data('id');
            $('#confirmDeleteBtn').click(function() {
                window.location.href = "<?= URL ?>/estoques/deletar/" + id;
            });
        });
    });
    </script>

</body>

</html>