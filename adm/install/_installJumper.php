<?php 

if(isset($_POST['HOST'])){
    $local          = $_POST['HOST'];
    $db             = $_POST['BANCO'];
    $login          = $_POST['USUARIO'];
    $password       = $_POST['SENHA'];
    $site           = $_POST['SITE'];
    $senhaInstall   = uniqid(rand(), true);
    
    try {
        $pdo = new PDO('mysql:host='.$local.';dbname='.$db, $login, $password, 
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    
        $banco = $pdo->query("

            SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
            START TRANSACTION;
            SET time_zone = '+00:00';

            /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
            /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
            /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
            /*!40101 SET NAMES utf8mb4 */;

            -- --------------------------------------------------------

            --
            -- Estrutura da tabela `cardapios`
            --

            CREATE TABLE `cardapios` (
            `card_id` int(11) NOT NULL,
            `card_nome` varchar(255) NOT NULL,
            `card_imagem` text NOT NULL,
            `card_url_imagem` text NOT NULL,
            `card_texto` text NOT NULL,
            `card_valor` decimal(18,2) NOT NULL,
            `card_categoria` int(11) NOT NULL,
            `card_status` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            -- --------------------------------------------------------

            --
            -- Estrutura da tabela `categorias`
            --

            CREATE TABLE `categorias` (
            `cat_id` int(11) NOT NULL,
            `cat_nome` varchar(255) NOT NULL,
            `cat_slug` varchar(255) NOT NULL,
            `cat_origem` varchar(50) NOT NULL,
            `cat_status` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            -- --------------------------------------------------------

            --
            -- Estrutura da tabela `clientes`
            --

            CREATE TABLE `clientes` (
            `cli_id` int(11) NOT NULL,
            `cli_empresa` varchar(255) NOT NULL,
            `cli_imagem` varchar(255) NOT NULL,
            `cli_url_imagem` text NOT NULL,
            `cli_status` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            -- --------------------------------------------------------

            --
            -- Estrutura da tabela `configuracoes`
            --

            CREATE TABLE `configuracoes` (
            `conf_id` int(11) NOT NULL,
            `conf_nome` varchar(255) NOT NULL,
            `conf_descricao` varchar(255) NOT NULL,
            `conf_logo` text NOT NULL,
            `conf_favicon` text NOT NULL,
            `conf_logo_url` text NOT NULL,
            `conf_favicon_url` text NOT NULL,
            `conf_email` varchar(255) NOT NULL,
            `conf_link` text NOT NULL,
            `conf_telefone` varchar(255) NOT NULL,
            `conf_endereco` text NOT NULL,
            `conf_cor_principal` varchar(7) NOT NULL,
            `conf_cor_secundaria` varchar(7) NOT NULL,
            `conf_instagram` text NOT NULL,
            `conf_facebook` text NOT NULL,
            `conf_youtube` text NOT NULL,
            `conf_linkedin` text NOT NULL,
            `conf_cnpj` varchar(18) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            --
            -- Extraindo dados da tabela `configuracoes`
            --

            INSERT INTO `configuracoes` (`conf_id`, `conf_nome`, `conf_descricao`, `conf_logo`, `conf_favicon`, `conf_logo_url`, `conf_favicon_url`, `conf_email`, `conf_link`, `conf_telefone`, `conf_endereco`, `conf_cor_principal`, `conf_cor_secundaria`, `conf_instagram`, `conf_facebook`, `conf_youtube`, `conf_linkedin`, `conf_cnpj`) VALUES
            (1, 'Jumper', 'O gerenciador de conteúdo ideal para sua empresa', '#', '#', '#', '#', 'contato@sadigital.com.br', '$site', '#', '#', '#76B82A', '#56960D', 'https://instagram.com/', 'https://facebook.com/', 'https://youtube.com/', 'https://linkedin.com/', '#');

            -- --------------------------------------------------------

            --
            -- Estrutura da tabela `contatos`
            --

            CREATE TABLE `contatos` (
            `cont_id` int(11) NOT NULL,
            `cont_nome` varchar(50) NOT NULL,
            `cont_email` varchar(100) NOT NULL,
            `cont_telefone` varchar(14) NOT NULL,
            `cont_assunto` varchar(50) NOT NULL,
            `cont_mensagem` text NOT NULL,
            `cont_visualizado` int(11) NOT NULL,
            `cont_resposta` text DEFAULT NULL,
            `cont_data` date NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            -- --------------------------------------------------------

            --
            -- Estrutura da tabela `cta`
            --

            CREATE TABLE `cta` (
            `cta_id` int(11) NOT NULL,
            `cta_titulo` varchar(255) NOT NULL,
            `cta_texto` varchar(255) NOT NULL,
            `cta_titulo_btn` varchar(255) NOT NULL,
            `cta_url_btn` text NOT NULL,
            `cta_cor_btn` varchar(7) NOT NULL,
            `cta_icone` varchar(20) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            -- --------------------------------------------------------

            --
            -- Estrutura da tabela `depoimentos`
            --

            CREATE TABLE `depoimentos` (
            `dep_id` int(11) NOT NULL,
            `dep_nome` varchar(255) NOT NULL,
            `dep_empresa` varchar(255) NOT NULL,
            `dep_texto` text NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            -- --------------------------------------------------------

            --
            -- Estrutura da tabela `destaque`
            --

            CREATE TABLE `destaque` (
            `des_id` int(11) NOT NULL,
            `des_icone` varchar(50) NOT NULL,
            `des_titulo` varchar(255) NOT NULL,
            `des_texto` varchar(255) NOT NULL,
            `des_status` int(11) NOT NULL,
            `des_emp_id` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            -- --------------------------------------------------------

            --
            -- Estrutura da tabela `empresa`
            --

            CREATE TABLE `empresa` (
            `emp_id` int(11) NOT NULL,
            `emp_descricao` text NOT NULL,
            `emp_imagem` text NOT NULL,
            `emp_url_imagem` text NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            --
            -- Extraindo dados da tabela `empresa`
            --

            INSERT INTO `empresa` (`emp_id`, `emp_descricao`, `emp_imagem`, `emp_url_imagem`) VALUES
            (1, '#', '#', '#');

            -- --------------------------------------------------------

            --
            -- Estrutura da tabela `membros`
            --

            CREATE TABLE `membros` (
            `mb_id` int(11) NOT NULL,
            `mb_nome` varchar(255) NOT NULL,
            `mb_imagem` text NOT NULL,
            `mb_url_imagem` text NOT NULL,
            `mb_cargo` varchar(255) NOT NULL,
            `mb_facebook` varchar(255) NOT NULL,
            `mb_twitter` varchar(255) NOT NULL,
            `mb_instagram` varchar(255) NOT NULL,
            `mb_linkedin` varchar(255) NOT NULL,
            `mb_status` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            -- --------------------------------------------------------

            --
            -- Estrutura da tabela `modulos`
            --

            CREATE TABLE `modulos` (
            `mod_id` int(11) NOT NULL,
            `mod_titulo` varchar(255) NOT NULL,
            `mod_slug` varchar(255) NOT NULL,
            `mod_descricao` varchar(255) NOT NULL,
            `mod_url` text NOT NULL,
            `mod_icone` varchar(50) NOT NULL,
            `mod_status` int(11) NOT NULL,
            `mod_menu` int(11) NOT NULL,
            `mod_ordem` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            --
            -- Extraindo dados da tabela `modulos`
            --

            INSERT INTO `modulos` (`mod_id`, `mod_titulo`, `mod_slug`, `mod_descricao`, `mod_url`, `mod_icone`, `mod_status`, `mod_menu`, `mod_ordem`) VALUES
            (1, 'Notícias', 'noticias', 'Modulo de Notícias', 'modulos/noticias/listarNoticias', 'layout', 1, 1, 4),
            (2, 'Páginas', 'paginas', 'Modulo de Páginas', 'modulos/paginas/listarPaginas', 'edit', 1, 0, 12),
            (3, 'Serviços', 'servicos', 'Conheça nossas soluções para sua empresa.', 'modulos/servicos/listarServicos', 'server', 1, 1, 2),
            (4, 'Portfólio', 'portfolio', 'Conheça nosso portfólio.', 'modulos/portfolios/listarPortfolios', 'image', 1, 1, 3),
            (5, 'Equipe', 'equipe', 'Conheça nossa equipe de sucesso.', 'modulos/membros/listarMembros', 'users', 1, 0, 8),
            (6, 'Clientes', 'clientes', 'Conheça alguns dos nossos clientes.', 'modulos/clientes/listarClientes', 'star', 1, 0, 5),
            (7, 'Valores', 'valores', 'Confira os valores dos nossos serviços.', 'modulos/valores/listarValores', 'dollar-sign', 1, 1, 9),
            (8, 'Perguntas Frequentes', 'perguntas-frequentes', '', 'modulos/perguntas/listarPerguntas', 'help-circle', 1, 0, 10),
            (9, 'Depoimentos', 'depoimentos', 'O que nossos clientes dizem sobre a gente!', 'modulos/depoimentos/listarDepoimentos', 'heart', 1, 0, 7),
            (10, 'Nossos Números', 'nossos-numeros', 'Modulos de Nossos Números', 'modulos/numeros/listarNumeros', 'trending-up', 1, 0, 1),
            (11, 'Slides', 'slides', 'Modulo de Slides', 'modulos/slides/listarSlides', 'play', 1, 0, 0),
            (12, 'Cardápio', 'cardapio', 'Modulo de Cardápio para Restaurante', 'modulos/cardapios/listarCardapios', 'layers', 1, 0, 11),
            (13, 'CTA', 'cta', 'Modulo de Call to Action', 'modulos/cta', 'at-sign', 1, 0, 6);

            -- --------------------------------------------------------

            --
            -- Estrutura da tabela `noticias`
            --

            CREATE TABLE `noticias` (
            `not_id` int(11) NOT NULL,
            `not_titulo` varchar(255) NOT NULL,
            `not_slug` varchar(255) NOT NULL,
            `not_imagem` text NOT NULL,
            `not_nome_imagem` varchar(255) NOT NULL,
            `not_texto` longtext NOT NULL,
            `not_categoria` int(11) NOT NULL,
            `not_data` date NOT NULL,
            `not_status` int(1) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            -- --------------------------------------------------------

            --
            -- Estrutura da tabela `numeros`
            --

            CREATE TABLE `numeros` (
            `num_id` int(11) NOT NULL,
            `num_icone` varchar(255) NOT NULL,
            `num_titulo` varchar(255) NOT NULL,
            `num_numero` int(11) NOT NULL,
            `num_status` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            -- --------------------------------------------------------

            --
            -- Estrutura da tabela `paginas`
            --

            CREATE TABLE `paginas` (
            `pag_id` int(11) NOT NULL,
            `pag_titulo` varchar(255) NOT NULL,
            `pag_slug` varchar(255) NOT NULL,
            `pag_imagem` text NOT NULL,
            `pag_nome_imagem` varchar(255) NOT NULL,
            `pag_texto` text NOT NULL,
            `pag_data` date NOT NULL,
            `pag_status` int(1) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            -- --------------------------------------------------------

            --
            -- Estrutura da tabela `perguntas`
            --

            CREATE TABLE `perguntas` (
            `pg_id` int(11) NOT NULL,
            `pg_pergunta` text NOT NULL,
            `pg_resposta` text NOT NULL,
            `pg_status` int(11) NOT NULL,
            `pg_ordem` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            -- --------------------------------------------------------

            --
            -- Estrutura da tabela `portfolios`
            --

            CREATE TABLE `portfolios` (
            `port_id` int(11) NOT NULL,
            `port_nome` varchar(255) NOT NULL,
            `port_slug` text NOT NULL,
            `port_empresa` varchar(255) NOT NULL,
            `port_categoria` int(11) NOT NULL,
            `port_texto` longtext NOT NULL,
            `port_url` text NOT NULL,
            `port_data` date NOT NULL,
            `port_status` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            -- --------------------------------------------------------

            --
            -- Estrutura da tabela `portfolio_imagem`
            --

            CREATE TABLE `portfolio_imagem` (
            `img_id` int(11) NOT NULL,
            `img_port_id` int(11) NOT NULL,
            `img_nome` varchar(255) NOT NULL,
            `img_imagem` text NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            -- --------------------------------------------------------

            --
            -- Estrutura da tabela `servicos`
            --

            CREATE TABLE `servicos` (
            `serv_id` int(11) NOT NULL,
            `serv_icone` varchar(255) NOT NULL,
            `serv_titulo` varchar(255) NOT NULL,
            `serv_texto` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            -- --------------------------------------------------------

            --
            -- Estrutura da tabela `skills`
            --

            CREATE TABLE `skills` (
            `sk_id` int(11) NOT NULL,
            `sk_titulo` varchar(50) NOT NULL,
            `sk_valor` int(11) NOT NULL,
            `sk_status` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            -- --------------------------------------------------------

            --
            -- Estrutura da tabela `slides`
            --

            CREATE TABLE `slides` (
            `sd_id` int(11) NOT NULL,
            `sd_titulo` varchar(100) NOT NULL,
            `sd_imagem` text NOT NULL,
            `sd_url_imagem` text NOT NULL,
            `sd_texto` text NOT NULL,
            `sd_url_botao` text NOT NULL,
            `sd_status` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            -- --------------------------------------------------------

            --
            -- Estrutura da tabela `usuario`
            --

            CREATE TABLE `usuario` (
            `usu_id` int(11) NOT NULL,
            `usu_nome` varchar(255) NOT NULL,
            `usu_email` varchar(255) NOT NULL,
            `usu_senha` varchar(255) NOT NULL,
            `usu_nivel` int(11) NOT NULL,
            `usu_status` int(11) NOT NULL,
            `usu_erro` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            --
            -- Extraindo dados da tabela `usuario`
            --

            INSERT INTO `usuario` (`usu_id`, `usu_nome`, `usu_email`, `usu_senha`, `usu_nivel`, `usu_status`, `usu_erro`) VALUES
            (1, 'Sidnei Andrade', 'contato@sadigital.com.br', md5('$senhaInstall'), 1, 1, 0);

            -- --------------------------------------------------------

            --
            -- Estrutura da tabela `valores`
            --

            CREATE TABLE `valores` (
            `val_id` int(11) NOT NULL,
            `val_titulo` varchar(255) NOT NULL,
            `val_valor` varchar(255) NOT NULL,
            `val_frequencia` varchar(255) NOT NULL,
            `val_texto` text NOT NULL,
            `val_url` text NOT NULL,
            `val_btn_titulo` text NOT NULL,
            `val_destaque` int(11) NOT NULL,
            `val_status` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            --
            -- Índices para tabelas despejadas
            --

            --
            -- Índices para tabela `categorias`
            --
            ALTER TABLE `categorias`
            ADD PRIMARY KEY (`cat_id`);

            --
            -- Índices para tabela `clientes`
            --
            ALTER TABLE `clientes`
            ADD PRIMARY KEY (`cli_id`);

            --
            -- Índices para tabela `configuracoes`
            --
            ALTER TABLE `configuracoes`
            ADD PRIMARY KEY (`conf_id`);

            --
            -- Índices para tabela `contatos`
            --
            ALTER TABLE `contatos`
            ADD PRIMARY KEY (`cont_id`);

            --
            -- Índices para tabela `cta`
            --
            ALTER TABLE `cta`
            ADD PRIMARY KEY (`cta_id`);

            --
            -- Índices para tabela `depoimentos`
            --
            ALTER TABLE `depoimentos`
            ADD PRIMARY KEY (`dep_id`);

            --
            -- Índices para tabela `destaque`
            --
            ALTER TABLE `destaque`
            ADD PRIMARY KEY (`des_id`);

            --
            -- Índices para tabela `membros`
            --
            ALTER TABLE `membros`
            ADD PRIMARY KEY (`mb_id`);

            --
            -- Índices para tabela `modulos`
            --
            ALTER TABLE `modulos`
            ADD PRIMARY KEY (`mod_id`);

            --
            -- Índices para tabela `noticias`
            --
            ALTER TABLE `noticias`
            ADD PRIMARY KEY (`not_id`);

            --
            -- Índices para tabela `numeros`
            --
            ALTER TABLE `numeros`
            ADD PRIMARY KEY (`num_id`);

            --
            -- Índices para tabela `paginas`
            --
            ALTER TABLE `paginas`
            ADD PRIMARY KEY (`pag_id`);

            --
            -- Índices para tabela `perguntas`
            --
            ALTER TABLE `perguntas`
            ADD PRIMARY KEY (`pg_id`);

            --
            -- Índices para tabela `portfolios`
            --
            ALTER TABLE `portfolios`
            ADD PRIMARY KEY (`port_id`);

            --
            -- Índices para tabela `portfolio_imagem`
            --
            ALTER TABLE `portfolio_imagem`
            ADD PRIMARY KEY (`img_id`);

            --
            -- Índices para tabela `servicos`
            --
            ALTER TABLE `servicos`
            ADD PRIMARY KEY (`serv_id`);

            --
            -- Índices para tabela `skills`
            --
            ALTER TABLE `skills`
            ADD PRIMARY KEY (`sk_id`);

            --
            -- Índices para tabela `slides`
            --
            ALTER TABLE `slides`
            ADD PRIMARY KEY (`sd_id`);

            --
            -- Índices para tabela `usuario`
            --
            ALTER TABLE `usuario`
            ADD PRIMARY KEY (`usu_id`);

            --
            -- Índices para tabela `valores`
            --
            ALTER TABLE `valores`
            ADD PRIMARY KEY (`val_id`);

            --
            -- AUTO_INCREMENT de tabelas despejadas
            --

            --
            -- AUTO_INCREMENT de tabela `categorias`
            --
            ALTER TABLE `categorias`
            MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT;

            --
            -- AUTO_INCREMENT de tabela `clientes`
            --
            ALTER TABLE `clientes`
            MODIFY `cli_id` int(11) NOT NULL AUTO_INCREMENT;

            --
            -- AUTO_INCREMENT de tabela `configuracoes`
            --
            ALTER TABLE `configuracoes`
            MODIFY `conf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

            --
            -- AUTO_INCREMENT de tabela `contatos`
            --
            ALTER TABLE `contatos`
            MODIFY `cont_id` int(11) NOT NULL AUTO_INCREMENT;

            --
            -- AUTO_INCREMENT de tabela `cta`
            --
            ALTER TABLE `cta`
            MODIFY `cta_id` int(11) NOT NULL AUTO_INCREMENT;

            --
            -- AUTO_INCREMENT de tabela `depoimentos`
            --
            ALTER TABLE `depoimentos`
            MODIFY `dep_id` int(11) NOT NULL AUTO_INCREMENT;

            --
            -- AUTO_INCREMENT de tabela `destaque`
            --
            ALTER TABLE `destaque`
            MODIFY `des_id` int(11) NOT NULL AUTO_INCREMENT;

            --
            -- AUTO_INCREMENT de tabela `membros`
            --
            ALTER TABLE `membros`
            MODIFY `mb_id` int(11) NOT NULL AUTO_INCREMENT;

            --
            -- AUTO_INCREMENT de tabela `modulos`
            --
            ALTER TABLE `modulos`
            MODIFY `mod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

            --
            -- AUTO_INCREMENT de tabela `noticias`
            --
            ALTER TABLE `noticias`
            MODIFY `not_id` int(11) NOT NULL AUTO_INCREMENT;

            --
            -- AUTO_INCREMENT de tabela `numeros`
            --
            ALTER TABLE `numeros`
            MODIFY `num_id` int(11) NOT NULL AUTO_INCREMENT;

            --
            -- AUTO_INCREMENT de tabela `paginas`
            --
            ALTER TABLE `paginas`
            MODIFY `pag_id` int(11) NOT NULL AUTO_INCREMENT;

            --
            -- AUTO_INCREMENT de tabela `perguntas`
            --
            ALTER TABLE `perguntas`
            MODIFY `pg_id` int(11) NOT NULL AUTO_INCREMENT;

            --
            -- AUTO_INCREMENT de tabela `portfolios`
            --
            ALTER TABLE `portfolios`
            MODIFY `port_id` int(11) NOT NULL AUTO_INCREMENT;

            --
            -- AUTO_INCREMENT de tabela `portfolio_imagem`
            --
            ALTER TABLE `portfolio_imagem`
            MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT;

            --
            -- AUTO_INCREMENT de tabela `servicos`
            --
            ALTER TABLE `servicos`
            MODIFY `serv_id` int(11) NOT NULL AUTO_INCREMENT;

            --
            -- AUTO_INCREMENT de tabela `skills`
            --
            ALTER TABLE `skills`
            MODIFY `sk_id` int(11) NOT NULL AUTO_INCREMENT;

            --
            -- AUTO_INCREMENT de tabela `slides`
            --
            ALTER TABLE `slides`
            MODIFY `sd_id` int(11) NOT NULL AUTO_INCREMENT;

            --
            -- AUTO_INCREMENT de tabela `usuario`
            --
            ALTER TABLE `usuario`
            MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

            --
            -- AUTO_INCREMENT de tabela `valores`
            --
            ALTER TABLE `valores`
            MODIFY `val_id` int(11) NOT NULL AUTO_INCREMENT;
            COMMIT;

            /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
            /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
            /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
        ");

        //enviar e-mail com a senha
        $nome       = "JUMPER - SA Digital";
        $email      = "contato@sadigital.com.br";
        $assunto    = "Instalação do Jumper";
        $resposta   = " <div style='background: #e1e1e1'>
                            <div style='background: #fff; margin: 0 auto; width: 700px; padding: 20px; height: 100%; text-align: center;'>
                                <img src='https://sadigital.com.br/cms/assets/img/logo-987000012.png' alt='Jumper' width='200' /><br>
                                <h1>Instalação realizada com sucesso!</h1> 
                                <br>Instalação do Jumper finalizou com sucesso segue abaixo a senha gerada automaticamente.
                                <br><strong>Senha:</strong> ".$senhaInstall."
                                <br><strong>OBS:</strong> <i>Altere a senha no primeiro acesso.</i>
                            </div>
                        </div>";
        
        $headers    = 'MIME-Version: 1.0' . "\r\n";
        $headers    .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers    .= 'From: ' . $nome . ' <'. $email .'>';

        $enviaremail = mail($email, $assunto, $resposta, $headers);

        $data = ['result' => 'ok', 'mensagem' => 'Gerenciador Jumper instalado com Sucesso!'];
        header('Content-type: application/json');
        echo json_encode($data);
    
    } catch (Exception $e) {
        $data = ['result' => 'error', 'mensagem' => $e];
        header('Content-type: application/json');
        echo json_encode($data);
    }
} else {
    $data = ['result' => 'error', 'mensagem' => ''];
    header('Content-type: application/json');
    echo json_encode($data);
}
