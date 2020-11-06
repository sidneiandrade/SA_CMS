<?php

#Todos os selects da página principal

#Slide
$slide = $pdo->prepare("SELECT * FROM SLIDES WHERE SD_STATUS = ? ORDER BY SD_ID DESC");
$slide->execute([1]);
$listSlide = $slide->fetchAll(PDO::FETCH_ASSOC);
$i = 0; 

#Destaque Empresa
$destaque = $pdo->query("SELECT * FROM DESTAQUE")->fetchAll(PDO::FETCH_ASSOC);

#Sobre Empresa
$sobre = $pdo->query("SELECT * FROM EMPRESA")->fetchAll(PDO::FETCH_ASSOC);

#Numeros
$numeros = $pdo->query("SELECT * FROM NUMEROS")->fetchAll(PDO::FETCH_ASSOC);

#Serviços
$servicos = $pdo->query("SELECT * FROM SERVICOS")->fetchAll(PDO::FETCH_ASSOC);

#Portfolio
$catPort = $pdo->prepare("SELECT * FROM CATEGORIAS WHERE CAT_ORIGEM = ? AND CAT_STATUS = ?");
$catPort->execute(['P',1]);
$listCat = $catPort->fetchAll(PDO::FETCH_ASSOC);

$dados = $pdo->prepare("SELECT * FROM PORTFOLIOS WHERE PORT_STATUS = ?");
$dados->execute([1]);
$dadosPort = $dados->fetchAll(PDO::FETCH_ASSOC);

#Clientes
$clientes = $pdo->prepare("SELECT * FROM CLIENTES WHERE CLI_STATUS = ?");
$clientes->execute([1]);
$listClientes = $clientes->fetchAll(PDO::FETCH_ASSOC);

#Depoimentos
$depoimentos = $pdo->query("SELECT * FROM DEPOIMENTOS")->fetchAll(PDO::FETCH_ASSOC);

#Membros
$membros = $pdo->prepare("SELECT * FROM MEMBROS WHERE MB_STATUS = ?");
$membros->execute([1]);
$listMembros =  $membros->fetchAll(PDO::FETCH_ASSOC);

#Valores
$valores = $pdo->query("SELECT * FROM VALORES")->fetchAll(PDO::FETCH_ASSOC);

#Perguntas
$perguntas = $pdo->prepare("SELECT * FROM PERGUNTAS WHERE PG_STATUS = ? ORDER BY PG_ID ASC");
$perguntas->execute([1]);
$listPerguntas = $perguntas->fetchAll(PDO::FETCH_ASSOC);

