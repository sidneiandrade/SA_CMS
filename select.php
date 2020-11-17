<?php

#Todos os selects da página principal

#Slide
$slide = $pdo->prepare("SELECT * FROM slides WHERE sd_status = ? ORDER BY sd_id DESC");
$slide->execute([1]);
$listSlide = $slide->fetchAll(PDO::FETCH_ASSOC);
$i = 0; 

#Destaque Empresa
$destaque = $pdo->query("SELECT * FROM destaque")->fetchAll(PDO::FETCH_ASSOC);

#Sobre Empresa
$sobre = $pdo->query("SELECT * FROM empresa")->fetchAll(PDO::FETCH_ASSOC);

#Numeros
$numeros = $pdo->query("SELECT * FROM numeros")->fetchAll(PDO::FETCH_ASSOC);

#Serviços
$servicos = $pdo->query("SELECT * FROM servicos")->fetchAll(PDO::FETCH_ASSOC);

#Noticias
$noticias = $pdo->query("SELECT * FROM noticias WHERE not_status = 1 ORDER BY not_id DESC LIMIT 3")->fetchAll(PDO::FETCH_ASSOC);

#Portfolio Categoria
$catPort = $pdo->prepare("SELECT * FROM categorias WHERE cat_origem = ? AND cat_status = ?");
$catPort->execute(['P',1]);
$listCat = $catPort->fetchAll(PDO::FETCH_ASSOC);

#Portfolio Conteudo
$dados = $pdo->prepare("SELECT * FROM portfolios WHERE port_status = ? ORDER BY port_id DESC");
$dados->execute([1]);
$dadosPort = $dados->fetchAll(PDO::FETCH_ASSOC);

#Clientes
$clientes = $pdo->prepare("SELECT * FROM clientes WHERE cli_status = ?");
$clientes->execute([1]);
$listClientes = $clientes->fetchAll(PDO::FETCH_ASSOC);

#Depoimentos
$depoimentos = $pdo->query("SELECT * FROM depoimentos")->fetchAll(PDO::FETCH_ASSOC);

#Membros
$membros = $pdo->prepare("SELECT * FROM membros WHERE mb_status = ?");
$membros->execute([1]);
$listMembros =  $membros->fetchAll(PDO::FETCH_ASSOC);

#Valores
$valores = $pdo->query("SELECT * FROM valores")->fetchAll(PDO::FETCH_ASSOC);

#Perguntas
$perguntas = $pdo->prepare("SELECT * FROM perguntas WHERE pg_status = ? ORDER BY pg_id DESC");
$perguntas->execute([1]);
$listPerguntas = $perguntas->fetchAll(PDO::FETCH_ASSOC);

