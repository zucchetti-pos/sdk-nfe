<?php

namespace App\Modules\NFE\Builder\Tags;

use App\Modules\NFE\Builder\Enums\HomologDefaultEnum;
use App\Modules\NFE\Builder\Enums\ProdutoGLPEnum;
use App\Modules\NFE\Enums\ModeloEnum;

class ProdBuilder
{
    public function execute($prod, $params)
    {
        $produto = new \stdClass();
        $produto->xProd = $prod['xProd'];
        $produto->cProd = $prod['cProd'];
        $produto->vProd = $prod['vProd'];
        $produto->vUnCom = $prod['vUnCom'];
        $produto->vUnTrib = $prod['vUnTrib'];
        $produto->item = $prod['item'];

        if (empty($prod['vUnTrib'])) {
            throw new \Exception("Error Processing Request");
        }
        $produto->aliquotaST = $prod['aliquotaST'] ?? null;
        $produto->baseICMSSTRetido = $prod['baseICMSSTRetido'] ?? 0;
        $produto->valorICMSSTRetido = $prod['valorICMSSTRetido'] ?? 0;
        $produto->valorICMSSubstituto = $prod['valorICMSSubstituto'] ?? 0;
        $produto->valorICMSST = $prod['valorICMSST'] ?? 0;
        $produto->valorBCST = $prod['valorBCST'] ?? 0;
        $produto->uCom = $prod['uCom'];
        $produto->uTrib = $prod['uTrib'];

        if (!empty($prod['sigla'])) {
            $produto->uTrib = $prod['sigla'];
        }

        $produto->qCom = $prod['qCom'];
        $produto->qTrib = $prod['qTrib'];
        $produto->CFOP = $prod['CFOP'];

        $barCode = $this->validateBarCode($prod['cEAN']);

        if ($params['isHomolog'] && $params['mod'] == ModeloEnum::NFCE->value) {
            $produto->xProd = HomologDefaultEnum::NOTA_FISCAL_SEM_VALOR->value;
        }
        if (!empty($barCode)) {
            $produto->cEAN = $barCode;
            $produto->cEANTrib = $barCode;
        }

        $produto->xPed = $prod['xPed'] ?? '';
        $produto->nItemPed = $prod['nItemPed'] ?? '';
        $produto->nFCI = $prod['nFCI'] ?? null;
        $valuePercentage = 0;

        if ($prod['vProd']) {
            $valuePercentage = (100 * $produto->vProd) / $prod['totalVProd'];
        }
        if (!empty($prod['vFrete'])) {
            $produto->vFrete = round(
                $this->calcPercentage($prod['vFrete'], $valuePercentage),
                2
            );
        }
        if (!empty($prod['vSeg'])) {
            $produto->vSeg = $this->calcPercentage($prod['vSeg'], $valuePercentage);
        }
        if (!empty($prod['vDesc'])) {
            $produto->vDesc = $prod['vDesc'];
            if (!empty($prod['discountIsPercentage'])) {
                $produto->vDesc = round($this->calcPercentage(
                    $produto->vProd,
                    $prod['vDesc']
                ), 2);
            }
        }
        if (!empty($prod['vOutro'])) {
            $produto->vOutro = round($this->calcPercentage($prod['vOutro'], $valuePercentage), 2);
        }
        if (!empty($prod['infAdProd'])) {
            $produto->infAdProd = $prod['infAdProd'];
        }
        $produto->cBenef = $prod['cBenef'] ?? null;
        if ($prod['NCM']) {
            $produto->NCM = $prod['NCM'];
        }
        if (!empty($prod['CEST'])) {
            $produto->CEST = $prod['CEST'];
        }
        if (!empty($prod['ANP'])) {
            $produto->ANP = new \stdClass();
            $produto->ANP->codigo = $prod['ANP']['codigo'];
            $produto->ANP->descricao = $prod['ANP']['descricao'];
        }
        if (!empty($prod['ANP']['codigo']) && $prod['ANP']['codigo'] == ProdutoGLPEnum::GLP_ANP_COD->value) {
            $produto->pGLP = number_format($prod['pGLP'] * 100, 2, '.', '');
            $produto->pGNn = number_format($prod['pGNn'] * 100, 2, '.', '');
            $produto->pGNi = number_format($prod['pGNi'] * 100, 2, '.', '');
            $produto->vPart = number_format($prod['vPart'], 2, '.', '');

            $produto->uTrib = ProdutoGLPEnum::GLP_UTRIB->value;
            $qUnTrib = $prod['qUnTrib'];
            $produto->qTrib = $qUnTrib * $prod['qCom'];

            if ($qUnTrib <= 0) {
                throw new \Exception('A quantidade tributável do produto tem que ser ser maior que 0');
            }

            $vUnTrib = $produto->vUnCom / $qUnTrib;
            $produto->vUnTrib = $this->adjustVUnTribTolerance($prod['vUnCom'], $qUnTrib, $vUnTrib);
        }
        
        $produto->indTot = 1;

        return $produto;
    }

    private function adjustVUnTribTolerance(float $vUnCom, float $qUnTrib, float $vUnTrib)
    {
        $checkTolerance = round($vUnCom - $vUnTrib * $qUnTrib, 2);
        $adjustRate = 0.001;
        if ($checkTolerance < 0) {
            $checkTolerance *= -1;
            $adjustRate *= -1;
        }
        if ($checkTolerance === 0.0 || $checkTolerance === 0.01) {
            return $vUnTrib;
        }

        $vUnTrib += $adjustRate;
        return $this->adjustVUnTribTolerance($vUnCom, $qUnTrib, $vUnTrib);
    }

    private function calcPercentage($value, $percent)
    {
        return $value * $percent / 100;
    }

    private function validateBarCode($barCode)
    {
        if (!empty($barCode)) {
            if ((strlen($barCode) == 14) && substr($barCode, 0, 1) == '0') {
                return substr($barCode, 1);
            }
            return $barCode;
        }
        return null;
    }
}