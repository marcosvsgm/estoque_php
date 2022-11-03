<?php

class Produto {

   private $codigo;
   private $nome;
   private $preco;

   public function getCodigo()
   {
       return $this->codigo;
   }
   public function setCodigo($codigo)
   {
       $this->codigo = $codigo;
   }
   public function getNome()
   {
       return $this->nome;
   }
   public function setNome($nome)
   {
       $this->nome = $nome;
   }
   public function getPreco()
   {
       return $this->preco;
   }
   public function setPreco($preco)
   {
       $this->preco = $preco;
   }


function listaProdutos($conexao) {
    $produtos = array();
    $resultado = mysqli_query($conexao,);

    while($produto_array = mysqli_fetch_assoc($resultado)) {
      $categoria = new Categoria();
      $categoria->nome = $produto_array['categoria_nome'];

      $produto = new Produto();
      $produto->nome = $produto_array['nome'];
      $produto->preco = $produto_array['preco'];
      $produto->descricao = $produto_array['descricao'];
      $produto->usado = $produto_array['usado'];
      $produto->categoria = $categoria->nome;

      array_push($produtos, $produto);
    }
    return $produtos;
}

}
