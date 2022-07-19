<?php
if (!isset($_SESSION)) {
    session_start();
}
/* include_once '../Controller/FuncoesControllerCliente.php'
  $fcc = new FuncoesControllerCliente();
  $linhas = $fcc->pesquisaListaCliente(); */

class MenuAdministrativo
{

    public function menuAdministrativo()
    {
        if (isset($_SESSION['perfil'])) {
            if ($_SESSION['perfil'] === '0') {
                $cadastro = '
                <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <!-- data-toggle="collapse" data-target="#elementoCollapse" permitem criar um botão que esconde e disponibiliza o conteúdo do formulário da div que tem o id="elementoCollapse" -->
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#elementoCollapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="elementoCollapse">
                        <ul class="nav navbar-nav">
    
                            <li><a href="CadastroUsuarioAdm.php">Cadastro Usuario</a></li>
                            <li><a href="CadastroCliente.php">Cadastro Cliente</a></li>
                            <li><a href="CadastroFornecedor.php">Cadastro Fornecedor</a></li>
                            <li><a href="CadastroProduto.php">Cadastro do Produto</a></li>
                            <li><a href="ListaUsuario.php">Lista Usuario</a></li>
                            <li><a href="ListaCliente.php">Lista Cliente</a></li>
                            <li><a href="ListaEndereco.php">Lista Endereço</a></li>
                            <li><a href="index.php">Loja</a></li>
                            <li><a href="logout.php">Sair</a></li>
                        </ul>
                        <p class="navbar-text navbar-right">Olá, <strong>Administrador</strong></p>
    
                        <div class="collapse navbar-collapse" id="elementoCollapse">
                            <div class="navbar-form navbar-right">
                                <div class="form-group">
                                    <a href="../Controller/derruba_session.php" class="btn btn-danger " style="background-color: #2E2E2E ; color:#f44336 ;">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
';
            } else {
                $cadastro = '
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="painel.php" class="navbar-brand">Rei das Bebidas</a>
            </div>
            <div class="navbar-header">
                <a href="CadastroCliente.php" class="navbar-brand">Meus Dados</a>
            </div>
            <div class="navbar-header">
                <a href="index.php"  class="navbar-brand">Produtos</a>
            </div>
            
            <div class="collapse navbar-collapse" id="elementoCollapse">
                <div class="navbar-form navbar-right" >
                    <div class="form-group">
                    <a href="../Controller/derruba_session.php" class="btn btn-lg btn-danger " style="background-color: #2E2E2E ; color:#f44336 ;">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
';
            }
        } else {
            $cadastro = '
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="painel.php" class="navbar-brand">Rei das Bebidas</a>
            </div>
            <div class="navbar-header">
                <a href="CadastroUsuario.php" class="navbar-brand">Cadastro</a>
            </div>
            <div class="navbar-header">
                <a href="index.php"  class="navbar-brand">Produtos</a>
            </div>
            
            <div class="collapse navbar-collapse" id="elementoCollapse">
                <div class="navbar-form navbar-right" >
                    <div class="form-group">
                    <a href="../index.php" class="btn btn-danger" style="background-color: #2E2E2E ; color:#f44336 ;">Login</a>
                    </div>
                </div>
            </div>
        </div>         
        
        
    </nav>
';
        }
        return $cadastro;
    }
}
