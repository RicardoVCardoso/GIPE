<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>GIPE - Gestão Imobiliária</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="/dashboard">GIPE</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="/dashboard">Início</a></li>
        <li class="nav-item"><a class="nav-link" href="/condominios">Condomínios</a></li>
      </ul>
      <span class="navbar-text">
        Olá, <?= session()->get('nome') ?> | <a href="/auth/logout" class="text-danger">Sair</a>
      </span>
    </div>
  </div>
</nav>
<div class="container"></div>