<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Título da página</title>
    <meta charset="utf-8">
  </head>
  <body>
<table class="table table-striped table-bordered">

    <?php
    include_once('cliente.php');
    include_once('compra.php');
    include_once('pagamento.php');
    include_once('produto.php');

      $produtos = listaProdutos($conexao);
      foreach($produtos as $produto): ?>
      <tr>
        <td><?= $produto->nome ?></td>
        <td><?= $produto->preco?></td>
        <td><?= substr($produto->descricao, 0, 40) ?></td>
        <td><?= $produto->categoria?></td>
        <td><a class="btn btn-primary" href="produto-altera-formulario.php?id=<?=$produto->id?>">alterar</a></td>
        <td>
          <form action="remove-produto.php" method="post">
            <input type="hidden" name="id"  value="<?=$produto->id?>">
            <button class="btn btn-danger">remover</button>
          </form>
        </td>
      </tr>
    <?php endforeach ?>
</table>
</body>
</html>