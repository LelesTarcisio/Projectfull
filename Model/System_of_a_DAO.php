<?php
include_once 'usuario.php';
include_once 'endereco.php';
include_once 'cliente.php';

//DAO Pati
class UsuarioDAO
{

    public function inserirUsuarioDAO($nome, $telefone, $email, $senha, $perfil, $ativo)
    {
        $usuario = new Usuario();
        $usuario->setNome($nome);
        $usuario->setTelefone($telefone);
        $usuario->setEmail($email);
        $usuario->setSenha($senha);
        $usuario->setPerfil($perfil);
        $usuario->setAtivo($ativo);
        include_once 'conectaDB.php';
        $conectaDB = new conectaDB();
        $mensagem = "<p style='color: #2fc52b;'>Dados inseridos com sucesso.</p>";
        if ($conectaDB->_construct() == true) {
            $sql = "insert into usuario values ('" . $usuario->getEmail() . "', '" . $usuario->getNome() . "','" . $usuario->getTelefone() . "', "
                . " sha1('" . $usuario->getSenha() . "'), '" . $usuario->getPerfil() . "','" . $usuario->getAtivo() . "')";
            mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            //$linha = mysqli_fetch_array($query, MYSQLI_ASSOC);
        } else {
            $mensagem = "<p style='color: #efd52a;'>Problemas na conexão com o banco de dados.</p>";
        }
        $conectaDB->_destruct();
        return $mensagem;
    }

    public function pesquisaUsuarioDAO()
    {
        include_once 'conectaDB.php';
        $conectaDB = new conectaDB();
        $linhaNova = array();
        if ($conectaDB->_construct() === true) {
            $sql = "select * from usuario";
            $query = mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            while ($linha = mysqli_fetch_array($query)) {
                array_push($linhaNova, $linha);
            }
            $conectaDB->_destruct();
        }
        return $linhaNova;
    }

    public function pesquisaUsuarioLojaDAO($email)
    {
        /* Criamos essa função para ver se o usuário já tem os dados de cliente adicionados. */
        include_once 'conectaDB.php';
        $conectaDB = new conectaDB();
        $linhaNova = array();
        if ($conectaDB->_construct() === true) {
            /* $sql = "select * from cliente inner join endereco on"
                . " endereco_codEndereco = codEndereco where fkusuario = '$email'"; */
            $sql = "select * from usuario inner join cliente on"
                . " 	fkusuario = email where fkusuario = '$email'";
            $query = mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            /*  $query -> vai guardar a informação que vier = mysql_query -> vai trazer as informações de:
                1 - Que o banco conectou; ( $conectaDB->db )
                2 - Coloca as informações do ($sql), faz a pesquisa e retorna a resposta;

                die(mysqli_error($conectaDB->db)):
                1- Traz a informação do erro;
                  */
            while ($linha = mysqli_fetch_array($query)) {
                array_push($linhaNova, $linha);
            }
            $conectaDB->_destruct();
        }
        return $linhaNova;
    }

    public function editarUsuarioDAO($nome, $telefone, $email, $perfil, $ativo)
    {
        $usu = new Usuario();
        $usu->setNome($nome);
        $usu->setTelefone($telefone);
        $usu->setEmail($email);
        $usu->setPerfil($perfil);
        $usu->setAtivo($ativo);

        include_once '../Model/conectaDB.php';
        $conectaDB = new conectaDB();
        $mensagem = "<p class='msgResp bg-success text-center'>Dados alterados com sucesso.</p>";
        if ($conectaDB->_construct() === true) {
            $sql = "update usuario set nome = '" . $usu->getNome() . "', telefone = '" . $usu->getTelefone() . "', perfil = '" . $usu->getPerfil() . "', ativo = '" . $usu->getAtivo() . "' where email = '" . $usu->getEmail() . "'";
            //echo $sql;
            mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
        } else {
            $mensagem = "<p class='msgResp bg-warning text-center'>Problemas na conexão com o banco de dados.</p>";
        }
        $conectaDB->_destruct();
        return $mensagem;
    }

    public function excluirUsuarioDAO($email)
    {
        $usuario = new Usuario();
        $usuario->setEmail($email);
        include_once 'conectaDB.php';
        $conectaDB = new conectaDB();
        $mensagem = "<p class='msgResp bg-success text-center'>Dados excluídos com sucesso.</p>";
        if ($conectaDB->_construct() === true) {
            $sql = "delete from usuario where email = '" . $usuario->getEmail() . "'";
            mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            //$linha = mysqli_fetch_array($query, MYSQLI_ASSOC);
        } else {
            $mensagem = "<p class='msgResp bg-warning text-center'>Problemas na conexão com o banco de dados.</p>";
        }
        $conectaDB->_destruct();
        return $mensagem;
    }

    //    public function proximoCodigoUsuarioDAO() {
    //        include_once 'conectaDB.php';
    //        $conectaDB = new conectaDB();
    //        $id_usuario = 0;
    //        if ($conectaDB->_construct() === true) {
    //            $sql = "select id_usuario from usuario order by id_usuario asc";
    //            $query = mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
    //            $linha = mysqli_fetch_array($query, MYSQLI_ASSOC);
    //            if ($linha) {
    //                $n = 1;
    //                do {
    //                    if ($n < $linha['id_usuario']) {
    //                        $id_usuario = $n;
    //                        break;
    //                    } else {
    //                        $id_usuario = $n + 1;
    //                    }
    //                    $n++;
    //                } while ($linha = mysqli_fetch_array($query, MYSQLI_ASSOC));
    //            } else {
    //                $id_usuario = 1;
    //            }
    //        }
    //        $conectaDB->_destruct();
    //        return $id_usuario;
    //    }


}

class EnderecoDAO
{

    public function inserirEnderecoDAO($cep, $cidade, $logradouro, $bairro, $complemento, $numero, $uf)
    {
        $endereco = new Endereco();
        $endereco->setCep($cep);
        $endereco->setCidade($cidade);
        $endereco->setLogradouro($logradouro);
        $endereco->setBairro($bairro);
        $endereco->setComplemento($complemento);
        $endereco->setNumero($numero);
        $endereco->setUf($uf);
        include_once 'conectaDB.php';
        $conectaDB = new conectaDB();
        $mensagem = "<p class='msgResp bg-success text-center'>Dados inseridos com sucesso.</p>";
        if ($conectaDB->_construct() == true) {
            $sql = "insert into endereco values (null,'" . $endereco->getCep() . "', '" . $endereco->getCidade() . "', '" . $endereco->getLogradouro() . "',"
                . " '" . $endereco->getBairro() . "', '" . $endereco->getComplemento() . "','" . $endereco->getNumero() . "','" . $endereco->getUf() . "')";
            mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            //$linha = mysqli_fetch_array($query, MYSQLI_ASSOC);
        } else {
            $mensagem = "<p class='msgResp bg-warning text-center'>Problemas na conexão com o banco de dados.</p>";
        }
        $conectaDB->_destruct();
        return $mensagem;
    }

    public function pesquisaEnderecoDAO()
    {
        include_once 'conectaDB.php';
        $conectaDB = new conectaDB();
        $linhaNova = array();
        if ($conectaDB->_construct() === true) {
            $sql = "select * from endereco";
            $query = mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            while ($linha = mysqli_fetch_array($query)) {
                array_push($linhaNova, $linha);
            }
            $conectaDB->_destruct();
        }
        return $linhaNova;
    }
    public function pesquisaCodEnderecoDAO($cep, $logradouro, $numero)
    {
        include_once 'conectaDB.php';
        $conectaDB = new conectaDB();
        $linhaNova = array();
        if ($conectaDB->_construct() === true) {
            $sql = "select codEndereco from endereco where cep = '$cep' and logradouro = '$logradouro' and numero = '$numero' limit 1";
            $query = mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            while ($linha = mysqli_fetch_array($query)) {
                array_push($linhaNova, $linha);
            }
            $conectaDB->_destruct();
        }
        return $linhaNova;
    }

    public function editarEnderecoDAO($codEndereco, $cep, $cidade, $logradouro, $bairro, $complemento, $numero, $uf)
    {
        $end = new Endereco();

        $end->setCodEndereco($codEndereco);
        $end->setCep($cep);
        $end->setCidade($cidade);
        $end->setLogradouro($logradouro);
        $end->setBairro($bairro);
        $end->setComplemento($complemento);
        $end->setNumero($numero);
        $end->setUf($uf);

        include_once '../Model/conectaDB.php';
        $conectaDB = new conectaDB();
        $mensagem = "<p class='msgResp bg-success text-center'>Dados alterados com sucesso.</p>";
        if ($conectaDB->_construct() === true) {
            $sql = "update endereco set cep = '" . $end->getCep() . "', cidade = '" . $end->getCidade() . "', logradouro = '" . $end->getLogradouro() . "', bairro = '" . $end->getBairro() . "', complemento = '" . $end->getComplemento()  . "', numero = '" . $end->getNumero() . "', uf = '" . $end->getUf() . "' where codEndereco = '" . $end->getCodEndereco() . "'";
            //echo $sql;
            mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
        } else {
            $mensagem = "<p class='msgResp bg-warning text-center'>Problemas na conexão com o banco de dados.</p>";
        }
        $conectaDB->_destruct();
        return $mensagem;
    }

    public function excluirEnderecoDAO($codEndereco)
    {
        $endereco = new Endereco();
        $endereco->setCodEndereco($codEndereco);
        include_once 'conectaDB.php';
        $conectaDB = new conectaDB();
        $mensagem = "<p class='msgResp bg-success text-center'>Dados excluídos com sucesso.</p>";
        if ($conectaDB->_construct() === true) {
            $sql = "delete from endereco where codEndereco = '" . $endereco->getCodEndereco() . "'";
            mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            //$linha = mysqli_fetch_array($query, MYSQLI_ASSOC);
        } else {
            $mensagem = "<p class='msgResp bg-warning text-center'>Problemas na conexão com o banco de dados.</p>";
        }
        $conectaDB->_destruct();
        return $mensagem;
    }

    public function proximoCodigoEnderecoDAO()
    {
        include_once 'conectaDB.php';
        $conectaDB = new conectaDB();
        $codEndereco = 0;
        if ($conectaDB->_construct() === true) {
            $sql = "select codEndereco from endereco order by codEndereco asc";
            $query = mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            $linha = mysqli_fetch_array($query, MYSQLI_ASSOC);
            if ($linha) {
                $n = 1;
                do {
                    if ($n < $linha['codEndereco']) {
                        $codEndereco = $n;
                        break;
                    } else {
                        $codEndereco = $n + 1;
                    }
                    $n++;
                } while ($linha = mysqli_fetch_array($query, MYSQLI_ASSOC));
            } else {
                $codEndereco = 1;
            }
        }
        $conectaDB->_destruct();
        return $codEndereco;
    }
}
class ClienteDAO
{

    public function inserirClienteDAO($codCliente, $tipoCliente, $nomeCliente, $cpf_cnpj, $fixo, $movel, $email, $nomeRepresentante, $ativo, $endereco_codEndereco, $fkusuario)
    {
        $cliente = new Cliente();
        $cliente->setCodCliente($codCliente);
        $cliente->setTipoCliente($tipoCliente);
        $cliente->setNomeCliente($nomeCliente);
        $cliente->setCpf_Cnpj($cpf_cnpj);
        $cliente->setFixo($fixo);
        $cliente->setMovel($movel);
        $cliente->setEmail($email);
        $cliente->setNomeRepresentante($nomeRepresentante);
        $cliente->setAtivo($ativo);
        $cliente->setEndereco_codEndereco($endereco_codEndereco);
        $cliente->setFkusuario($fkusuario);

        $endereco = new Endereco();
        $endereco->setCodEndereco($endereco_codEndereco);

        include_once 'conectaDB.php';
        $conectaDB = new conectaDB();
        $mensagem = "<p class='text-resposta text-center'>Dados inseridos com sucesso.</p>";
        if ($conectaDB->_construct() == true) {
            $sql = "insert into cliente values ('" . $cliente->getCodCliente() . "', '" . $cliente->getTipoCliente() . "', '" . $cliente->getNomeCliente() . "', "
                . " '" . $cliente->getCpf_Cnpj() . "', '" . $cliente->getFixo() . "', "
                . " '" . $cliente->getMovel() . "', '" . $cliente->getEmail() . "', "
                . " '" . $cliente->getNomeRepresentante() . "', '" . $cliente->getAtivo() . "', '" . $cliente->getEndereco_codEndereco() . "', '" . $cliente->getFkusuario() . "')";
            mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            //$linha = mysqli_fetch_array($query, MYSQLI_ASSOC);
        } else {
            $mensagem = "<p class='text-resposta text-center'>Problemas na conexão com o banco de dados.</p>";
        }
        $conectaDB->_destruct();
        return $mensagem;
    }

    public function pesquisaClienteDAO($email)
    {
        include_once 'conectaDB.php';
        $conectaDB = new conectaDB();
        $linhaNova = array();
        if ($conectaDB->_construct() === true) {
            $sql = "select * from cliente where fkusuario = '$email'";
            $query = mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            while ($linha = mysqli_fetch_array($query)) {
                array_push($linhaNova, $linha);
            }
            $conectaDB->_destruct();
        }
        return $linhaNova;
    }

    public function pesquisaClienteCompletoDAO($email)
    {
        include_once 'conectaDB.php';
        $conectaDB = new conectaDB();
        $linhaNova = array();
        if ($conectaDB->_construct() === true) {
            $sql = "select * from cliente inner join endereco on"
                . " endereco_codEndereco = codEndereco where fkusuario = '$email'";
            $query = mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            while ($linha = mysqli_fetch_array($query)) {
                array_push($linhaNova, $linha);
            }
            $conectaDB->_destruct();
        }
        return $linhaNova;
    }

    public function pesquisaListaClienteDAO()
    {
        include_once 'conectaDB.php';
        $conectaDB = new conectaDB();
        $linhaNova = array();
        if ($conectaDB->_construct() === true) {
            $sql = "select * from cliente";
            $query = mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            while ($linha = mysqli_fetch_array($query)) {
                array_push($linhaNova, $linha);
            }
            $conectaDB->_destruct();
        }
        return $linhaNova;
    }

    public function pesquisaIdClienteDAO()
    {
        include_once 'ConectaDB.php';
        $conectaDB = new ConectaDB();
        $codigo = 0;
        if ($conectaDB->_construct() === true) {
            $sql = "select codCliente from cliente";
            $query = mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            $linha = mysqli_fetch_array($query, MYSQLI_ASSOC);
            if ($linha) {
                $n = 1;
                do {
                    $n++;
                    if ($n < $linha['codCliente']) {
                        $codigo = $n;
                        break;
                    } else {
                        $codigo = $linha['codCliente'] + 1;
                    }
                } while ($linha = mysqli_fetch_array($query, MYSQLI_ASSOC));
            } else {
                $codigo = 1;
            }
        }
        $conectaDB->_destruct();
        return $codigo;
    }

    public function editarClienteDAO($codCliente, $tipoCliente, $nomeCliente, $cpf_cnpj, $fixo, $movel, $email, $nomeRepresentante, $ativo, $endereco_codEndereco, $fkusuario)
    {
        $cl = new Cliente();

        $cl->setCodCliente($codCliente);
        $cl->setTipoCliente($tipoCliente);
        $cl->setNomeCliente($nomeCliente);
        $cl->setCpf_Cnpj($cpf_cnpj);
        $cl->setFixo($fixo);
        $cl->setMovel($movel);
        $cl->setEmail($email);
        $cl->setNomeRepresentante($nomeRepresentante);
        $cl->setAtivo($ativo);
        $cl->setEndereco_codEndereco($endereco_codEndereco);
        $cl->setFkusuario($fkusuario);

        include_once '../Model/conectaDB.php';
        $conectaDB = new conectaDB();
        $mensagem = "<p class='msgResp bg-success text-center'>Dados alterados com sucesso.</p>";
        if ($conectaDB->_construct() === true) {
            $sql = "update cliente set tipoCliente = '" . $cl->getTipoCliente() . "', nomeCliente = '" . $cl->getNomeCliente() . "', "
                . " cpf_cnpj = '" . $cl->getCpf_Cnpj() . "', fixo = '" . $cl->getFixo() . "', "
                . "movel = '" . $cl->getMovel() . "', email = '" . $cl->getEmail()  . "', "
                . "nomeRepresentante = '" . $cl->getNomeRepresentante() . "', "
                . "ativo = '" . $cl->getAtivo() . "', endereco_codEndereco = '" . $cl->getEndereco_codEndereco() . "', fkusuario = '" . $cl->getFkusuario() . "' where codCliente = '" . $cl->getCodCliente() . "'";
            //echo $sql;
            mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
        } else {
            $mensagem = "<p class='msgResp bg-warning text-center'>Problemas na conexão com o banco de dados.</p>";
        }
        $conectaDB->_destruct();
        return $mensagem;
    }

    public function excluirClienteDAO($codCliente)
    {
        $cliente = new Cliente();
        $cliente->setCodCliente($codCliente);
        include_once 'conectaDB.php';
        $conectaDB = new conectaDB();
        $mensagem = "<p class='msgResp bg-success text-center'>Dados excluídos com sucesso.</p>";
        if ($conectaDB->_construct() === true) {
            $sql = "delete from cliente where codCliente = '" . $cliente->getCodCliente() . "'";
            mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            //$linha = mysqli_fetch_array($query, MYSQLI_ASSOC);
        } else {
            $mensagem = "<p class='msgResp bg-warning text-center'>Problemas na conexão com o banco de dados.</p>";
        }
        $conectaDB->_destruct();
        return $mensagem;
    }

    public function proximoCodigoClienteDAO()
    {
        include_once 'conectaDB.php';
        $conectaDB = new conectaDB();
        $codCliente = 0;
        if ($conectaDB->_construct() === true) {
            $sql = "select codCliente from cliente order by codCliente asc";
            $query = mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            $linha = mysqli_fetch_array($query, MYSQLI_ASSOC);
            if ($linha) {
                $n = 1;
                do {
                    if ($n < $linha['codCliente']) {
                        $codCliente = $n;
                        break;
                    } else {
                        $codCliente = $n + 1;
                    }
                    $n++;
                } while ($linha = mysqli_fetch_array($query, MYSQLI_ASSOC));
            } else {
                $codCliente = 1;
            }
        }
        $conectaDB->_destruct();
        return $codCliente;
    }
}

//DAO dudu
class FornecedorDAO
{

    public function inserirFornecedorDAO($codigo, $nome, $razao, $cnpj, $telefone, $email, $cep, $cidade, $logradouro, $bairro, $complemento, $numero, $uf)
    {
        include_once 'ConectaDB.php';
        include_once 'Fornecedor.php';
        $fornece = new Fornecedor();
        $conectaDB = new ConectaDB();
        $fornece->setCodigo($codigo);
        $fornece->setNome($nome);
        $fornece->setRazao($razao);
        $fornece->setCnpj($cnpj);
        $fornece->setTelefone($telefone);
        $fornece->setEmail($email);
        $fornece->setCep($cep);
        $fornece->setCidade($cidade);
        $fornece->setLogradouro($logradouro);
        $fornece->setBairro($bairro);
        $fornece->setComplemento($complemento);
        $fornece->setNumero($numero);
        $fornece->setUf($uf);
        $mensagem = "<p class='msgResp bg-success text-center'>Dados inseridos com sucesso.</p>";

        if ($conectaDB->_construct() == true) {
            $sql = "insert into fornecedor values ('" . $fornece->getCodigo() . "', '" . $fornece->getNome() . "', '" . $fornece->getRazao() . "',"
                . " '" . $fornece->getCnpj() . "', '" . $fornece->getTelefone() . "', '" . $fornece->getEmail() . "', '" . $fornece->getCep() . "',"
                . " '" . $fornece->getCidade() . "', '" . $fornece->getLogradouro() . "', '" . $fornece->getBairro() . "',"
                . " '" . $fornece->getComplemento() . "', '" . $fornece->getNumero() . "', '" . $fornece->getUf() . "')";
            mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            //$linha = mysqli_fetch_array($query, MYSQLI_ASSOC);
        } else {
            $mensagem = "<p class='msgResp bg-warning text-center'>Problemas na conexão com o banco de dados.</p>";
        }
        $conectaDB->_destruct();
        return $mensagem;
    }

    public function editarFornecedorDAO($codigo, $nome, $razao, $cnpj, $telefone, $email, $cep, $cidade, $logradouro, $bairro, $complemento, $numero, $uf)
    {
        include_once 'ConectaDB.php';
        include_once 'Fornecedor.php';
        $fornece = new Fornecedor();
        $conectaDB = new ConectaDB();
        $fornece->setCodigo($codigo);
        $fornece->setNome($nome);
        $fornece->setRazao($razao);
        $fornece->setCnpj($cnpj);
        $fornece->setTelefone($telefone);
        $fornece->setEmail($email);
        $fornece->setCep($cep);
        $fornece->setCidade($cidade);
        $fornece->setLogradouro($logradouro);
        $fornece->setBairro($bairro);
        $fornece->setComplemento($complemento);
        $fornece->setNumero($numero);
        $fornece->setUf($uf);
        $mensagem = "<p class='msgResp bg-success text-center'>Dados inseridos com sucesso.</p>";

        if ($conectaDB->_construct() == true) {
            $sql = "update fornecedor set nomeFantasia = '" . $fornece->getNome() . "', razaoSocial = '" . $fornece->getRazao() . "',"
                . " cnpj = '" . $fornece->getCnpj() . "', telefone = '" . $fornece->getTelefone() . "', email = '" . $fornece->getEmail() . "', "
                .  " cep = '" . $fornece->getCep() . "', cidade = '" . $fornece->getCidade() . "', logradouro = '" . $fornece->getLogradouro() . "', "
                . "bairro = '" . $fornece->getBairro() . "', complemento = '" . $fornece->getComplemento() . "', numero = '" . $fornece->getNumero() . "', "
                . "uf = '" . $fornece->getUf() . "' where idfornecedor = '" . $fornece->getCodigo() . "'";
            mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            //$linha = mysqli_fetch_array($query, MYSQLI_ASSOC);
        } else {
            $mensagem = "<p class='msgResp bg-warning text-center'>Problemas na conexão com o banco de dados.</p>";
        }
        $conectaDB->_destruct();
        return $mensagem;
    }

    public function proximoCodigoFornecedorDAO()
    {
        include_once 'ConectaDB.php';
        $conectaDB = new ConectaDB();
        $codigo = 0;
        if ($conectaDB->_construct() === true) {
            $sql = "select idfornecedor from fornecedor";
            $query = mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            $linha = mysqli_fetch_array($query, MYSQLI_ASSOC);
            if ($linha) {
                $n = 1;
                do {
                    $n++;
                    if ($n < $linha['idfornecedor']) {
                        $codigo = $n;
                        break;
                    } else {
                        $codigo = $linha['idfornecedor'] + 1;
                    }
                } while ($linha = mysqli_fetch_array($query, MYSQLI_ASSOC));
            } else {
                $codigo = 1;
            }
        }
        $conectaDB->_destruct();
        return $codigo;
    }

    public function pesquisaFornecedorDAO()
    {
        include_once 'ConectaDB.php';
        $conectaDB = new ConectaDB();
        $linhaFornece = array();
        if ($conectaDB->_construct() === true) {
            $sql = "select * from fornecedor";
            $query = mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            while ($linha = mysqli_fetch_array($query)) {
                array_push($linhaFornece, $linha);
            }
            $conectaDB->_destruct();
        }
        return $linhaFornece;
    }

    public function excluiFornecedorDao($codigo)
    {
        include_once 'ConectaDB.php';
        include_once 'Fornecedor.php';
        $fornecedor = new Fornecedor();
        $conectaDB = new ConectaDB();
        $mensagem = "<p class='msgResp bg-success text-center'>Dados excluídos com sucesso.</p>";
        if ($conectaDB->_construct() === true) {
            $sql = "delete from fornecedor where idfornecedor = '$codigo'";
            mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            //$linha = mysqli_fetch_array($query, MYSQLI_ASSOC);
        } else {
            $mensagem = "<p class='msgResp bg-warning text-center'>Problemas na conexão com o banco de dados.</p>";
        }
        $conectaDB->_destruct();
        return $mensagem;
    }

    /* public function pesquisa($sql)
    {
        require_once 'ConectaDB.php';
        $conectaDB = new ConectaDB();
        $linhaSearch = array();
        if ($conectaDB->_construct() === true) {
            $query = mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            while ($linha = mysqli_fetch_array($query)) {
                array_push($linhaSearch, $linha);
            }
            $conectaDB->_destruct();
        }
        return $linhaSearch;
    } */
}

class produtoLoteDAO
{
    public function inserirProdutoLoteDAO($codigo, $nome, $dataProduto, $qtdEstoque, $valorCompra, $valorVenda, $situacao, $descricao, $dataValidade, $imagem, $forn_idforn)
    {
        include_once 'ConectaDB.php';
        include_once 'ProdutoLote.php';
        $prodLote = new ProdutoLote();
        $conectaDB = new ConectaDB();
        $prodLote->setCodigo($codigo);
        $prodLote->setNome($nome);
        $prodLote->setDataProduto($dataProduto);
        $prodLote->setQtdEst($qtdEstoque);
        $prodLote->setValCompra($valorCompra);
        $prodLote->setValVenda($valorVenda);
        $prodLote->setSituacao($situacao);
        $prodLote->setDesc($descricao);
        $prodLote->setDataVal($dataValidade);
        $prodLote->setImagem($imagem);
        $prodLote->setForn_IdForn($forn_idforn);
        $mensagem = "<p class='msgResp bg-success text-center'>Dados inseridos com sucesso.</p>";

        if ($conectaDB->_construct() == true) {
            $sql = "insert into produtoLote values ('" . $prodLote->getCodigo() . "', '" . $prodLote->getNome() . "', '" . $prodLote->getDataProduto() . "',"
                . " '" . $prodLote->getQtdEst() . "', '" . $prodLote->getValCompra() . "', '" . $prodLote->getValVenda() . "', '" . $prodLote->getSituacao() . "',"
                . " '" . $prodLote->getDesc() . "', '" . $prodLote->getDataVal() . "', '" . $prodLote->getImagem() . "', '" . $prodLote->getForn_IdForn() . "')";
            mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            //$linha = mysqli_fetch_array($query, MYSQLI_ASSOC);
        } else {
            $mensagem = "<p class='msgResp bg-warning text-center'>Problemas na conexão com o banco de dados.</p>";
        }
        $conectaDB->_destruct();
        return $mensagem;
    }

    public function editarProdutoLoteDAO($codigo, $nome, $dataProduto, $qtdEstoque, $valorCompra, $valorVenda, $situacao, $descricao, $dataValidade, $imagem, $forn_idforn)
    {
        include_once 'ConectaDB.php';
        include_once 'ProdutoLote.php';
        $prodLote = new ProdutoLote();
        $conectaDB = new ConectaDB();
        $prodLote->setCodigo($codigo);
        $prodLote->setNome($nome);
        $prodLote->setDataProduto($dataProduto);
        $prodLote->setQtdEst($qtdEstoque);
        $prodLote->setValCompra($valorCompra);
        $prodLote->setValVenda($valorVenda);
        $prodLote->setSituacao($situacao);
        $prodLote->setDesc($descricao);
        $prodLote->setDataVal($dataValidade);
        $prodLote->setImagem($imagem);
        $prodLote->setForn_IdForn($forn_idforn);
        $mensagem = "<p class='msgResp bg-success text-center'>Dados inseridos com sucesso.</p>";

        if ($conectaDB->_construct() == true) {
            $sql = "update produtoLote set nomeProduto = '" . $prodLote->getNome() . "', dataProduto = '" . $prodLote->getDataProduto() . "',
             qtdEstoque = '" . $prodLote->getQtdEst() . "', valorCompra = '" . $prodLote->getValCompra() . "',
              valorVenda = '" . $prodLote->getValVenda() . "', situacao = '" . $prodLote->getSituacao() . "',
               descricao = '" . $prodLote->getDesc() . "', dataValidade = '" . $prodLote->getDataVal() . "',
                imagem = '" . $prodLote->getImagem() . "', fornecedor_idfornecedor = '" . $prodLote->getForn_IdForn() . "'
                 where codLote = '" . $prodLote->getCodigo() . "'";
            mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            //$linha = mysqli_fetch_array($query, MYSQLI_ASSOC);
        } else {
            $mensagem = "<p class='msgResp bg-warning text-center'>Problemas na conexão com o banco de dados.</p>";
        }
        $conectaDB->_destruct();
        return $mensagem;
    }

    public function excluiProdutoLoteDao($codigo)
    {
        include_once 'ConectaDB.php';
        include_once 'ProdutoLote.php';
        $prodLote = new ProdutoLote();
        $conectaDB = new ConectaDB();
        $mensagem = "<p class='msgResp bg-success text-center'>Dados excluídos com sucesso.</p>";
        if ($conectaDB->_construct() === true) {
            $sql = "delete from produtoLote where codLote = '$codigo'";
            mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            //$linha = mysqli_fetch_array($query, MYSQLI_ASSOC);
        } else {
            $mensagem = "<p class='msgResp bg-warning text-center'>Problemas na conexão com o banco de dados.</p>";
        }
        $conectaDB->_destruct();
        return $mensagem;
    }

    public function proximoCodigoProdutoLoteDAO()
    {
        include_once 'ConectaDB.php';
        $conectaDB = new ConectaDB();
        $codigo = 0;
        if ($conectaDB->_construct() === true) {
            $sql = "select codLote from produtoLote";
            $query = mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            $linha = mysqli_fetch_array($query, MYSQLI_ASSOC);
            if ($linha) {
                $n = 1;
                do {
                    $n++;
                    if ($n < $linha['codLote']) {
                        $codigo = $n;
                        break;
                    } else {
                        $codigo = $linha['codLote'] + 1;
                    }
                } while ($linha = mysqli_fetch_array($query, MYSQLI_ASSOC));
            } else {
                $codigo = 1;
            }
        }
        $conectaDB->_destruct();
        return $codigo;
    }

    public function pesquisaProdutoLoteDAO()
    {
        include_once 'ConectaDB.php';
        $conectaDB = new ConectaDB();
        $linhaProd = array();
        if ($conectaDB->_construct() === true) {
            $sql = "select * from produtoLote";
            $query = mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            while ($linha = mysqli_fetch_array($query)) {
                array_push($linhaProd, $linha);
            }
            $conectaDB->_destruct();
        }
        return $linhaProd;
    }

    public function pesquisaCodProdutoDAO($codProduto)
    {
        include_once 'ConectaDB.php';
        $linhaCarrinho = array();
        $conectaDB = new ConectaDB();
        if ($conectaDB->_construct() === true) {
            $sql = "select * from produtoLote where codLote = '$codProduto'";
            $query = mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            while ($linha = mysqli_fetch_array($query)) {
                array_push($linhaCarrinho, $linha);
            }
            $conectaDB->_destruct();
        }
        return $linhaCarrinho;
    }

    public function atualizaEstoqueProdutoLoteDAO($codProduto, $qtd)
    {
        include_once 'ConectaDB.php';
        $conectaDB = new ConectaDB();
        if ($conectaDB->_construct() === true) {
            $sql = "update produtolote set qtdEstoque = (qtdEstoque - '$qtd') where codLote = '$codProduto'";
            mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            $conectaDB->_destruct();
        }
    }
}

class vendaDAO
{

    public function inserirVendaDAO($pagamento, $fkCliente, $fkEndereco)
    {
        include_once 'ConectaDB.php';
        include_once 'Venda.php';

        $conectaDB = new ConectaDB();
        $venda = new Venda();
        $venda->setPagamento($pagamento);
        $venda->setFkCliente($fkCliente);
        $venda->setFkEndereco($fkEndereco);
        $codigo = 0;
        if ($conectaDB->_construct() == true) {
            $sql = "select codVenda from venda";
            $query = mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            $linha = mysqli_fetch_array($query, MYSQLI_ASSOC);
            if ($linha) {
                $n = 1;
                do {
                    $n++;
                    if ($n < $linha['codVenda']) {
                        $codigo = $n;
                        break;
                    } else {
                        $codigo = $linha['codVenda'] + 1;
                    }
                } while ($linha = mysqli_fetch_array($query, MYSQLI_ASSOC));
            } else {
                $codigo = 1;
            }
            $sql = "insert into venda values ('$codigo', 0, current_time(), current_date(), "
                . "current_date(), '" . $venda->getPagamento() . "', 0, 0, 1, null, null, '"
                . $venda->getFkCliente() . "',  '" . $venda->getFkEndereco() . "')";

            mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
        }
        $conectaDB->_destruct();
        return $codigo;
    }

    public function inserirVendaProdutoLoteDAO($fkVenda, $codigoProduto, $qtdProduto, $valor)
    {
        $conectaDB = new ConectaDB();
        if ($fkVenda != null) {
            if ($conectaDB->_construct() == true) {
                $sql = "insert into venda_produtolote values ('$fkVenda', '$codigoProduto', '$qtdProduto', '$valor')";
                mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
                $sql = "update venda set qtdVenda = (qtdVenda + '$qtdProduto'), valorTotal = (valorTotal + '$valor') 
               where codVenda = '$fkVenda'";
                mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            }
        }
    }


    /*Tem que ver isso aqui para transformar em DAO, porque o professor colocar tudo local.
     Você tem que entender realmente o que ele estava pensando aqui.
     */


    public function pesquisaVendaCarrinhoDAO()
    {
        include_once 'ConectaDB.php';
        $conectaDB = new ConectaDB();
        $linhaCarrinho = array();
        if ($conectaDB->_construct() === true) {
            $sql = "select * from produtoLote";
            $query = mysqli_query($conectaDB->db, $sql) or die(mysqli_error($conectaDB->db));
            while ($linha = mysqli_fetch_array($query)) {
                array_push($linhaCarrinho, $linha);
            }
            $conectaDB->_destruct();
        }
        return $linhaCarrinho;
    }

    public function finalizarVenda()
    {
        include_once 'ConectaDB.php';
        $conectaDB = new ConectaDB();
    }
}
