<?php

namespace Alura\Leilao\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;

class Avaliador
{
    /** @var float */
    private $menorValor = INF;
    /** @var float */
    private $maiorValor = 0;
    /** @var Lance[]|array */
    private $maiores;

    public function avalia(Leilao $leilao)
    {
        $leilao->finaliza();

        foreach ($leilao->getLances() as $lance) {
            if ($lance->getValor() > $this->maiorValor) {
                $this->maiorValor = $lance->getValor();
            }

            if ($lance->getValor() < $this->menorValor) {
                $this->menorValor = $lance->getValor();
            }

            $this->maiores = $this->avaliaTresMaioresLances($leilao);
        }
    }

    public function getMenorValor(): float
    {
        return $this->menorValor;
    }

    public function getMaiorValor(): float
    {
        return $this->maiorValor;
    }

    /**
     * @return Lance[]
     */
    public function getTresMaioresLances(): array
    {
        return $this->maiores;
    }

    /**
     * @param Leilao $leilao
     * @return Lance[]|array
     */
    private function avaliaTresMaioresLances(Leilao $leilao)
    {
        $lances = $leilao->getLances();
        usort($lances, function (Lance $lance1, Lance $lance2) {
            return $lance2->getValor() - $lance1->getValor(); //Devolve um número negativo se o primeiro item vier antes no array do segundo item, retorna um número negativo se o lance1 vier primeiro, retorna 0 se eles forem iguais e maior do que 0 se o lance2 tiver que vir primeiro. O lance1 é equivalante ao negativo e - lance2 é equivalente ao 0 positivo, seguindo esse raciocínio, se retornarmos o lance1 menos o lance2, teremos uma ordenação do array em ordem crescente, se ordenarmos o lance2 menos o lance1, teremos uma ordenação decrescente no array de valores
        });

        return array_slice($lances, 0, 3);
    }
}
