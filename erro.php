<?php

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;

require_once __DIR__ . '/vendor/autoload.php';

$leilao = new Leilao('Um objeto muito legal');

$umUsuario = new Usuario('Márcio Miranda');

$leilao->recebeLance(new Lance($umUsuario, 1000));
$leilao->recebeLance(new Lance($umUsuario, 1500));

