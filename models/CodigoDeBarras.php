<?php

class CodigoDeBarras {

    public $fino = 1;
    public $largo = 3;
    public $altura = 50;

    public function gerarCodigo($codigoBanco, $nummoeda, $dataVencimento, $valor, $fixo, $codigoCliente, $nossoNumero, $iof, $carteira) {
        $dataVencimento = self::fatorVencimento($dataVencimento);
        $valor = self::formataNumero($valor, 10, 0, "valor");
        $codigoCliente = self::formataNumero($codigoCliente, 7, 0);
        //nosso número (sem dv) é 11 digitos
        $nnum = self::formataNumero($nossoNumero, 12, 0);
        //dv do nosso número
        $dv_nosso_numero = Math::modulo11($nnum, 9, 0);
        // nosso número (com dvs) são 13 digitos
        $nossoNumero = $nnum . $dv_nosso_numero;

        $numero_barra = $codigoBanco . $nummoeda . $dataVencimento . $valor . $fixo . $codigoCliente . $nossoNumero . $iof . $carteira;
        return (substr($numero_barra, 0, 4) . self::digitoVerificadorBarra($numero_barra) . substr($numero_barra, 4));
    }

    public function gerarLinhaDigitavel($codigoGerado) {
        // Posição 	Conteúdo
        // 1 a 3    Número do banco
        // 4        Código da Moeda - 9 para Real ou 8 - outras moedas
        // 5        Fixo "9'
        // 6 a 9    PSK - codigo cliente (4 primeiros digitos)
        // 10 a 12  Restante do PSK (3 digitos)
        // 13 a 19  7 primeiros digitos do Nosso Numero
        // 20 a 25  Restante do Nosso numero (8 digitos) - total 13 (incluindo digito verificador)
        // 26 a 26  IOS
        // 27 a 29  Tipo Modalidade Carteira
        // 30 a 30  Dígito verificador do código de barras
        // 31 a 34  Fator de vencimento (qtdade de dias desde 07/10/1997 até a data de vencimento)
        // 35 a 44  Valor do título
        // 1. Primeiro Grupo - composto pelo código do banco, código da moéda, Valor Fixo "9"
        // e 4 primeiros digitos do PSK (codigo do cliente) e DV (modulo10) deste campo
        $campo1 = substr($codigoGerado, 0, 3) . substr($codigoGerado, 3, 1) . substr($codigoGerado, 19, 1) . substr($codigoGerado, 20, 4);
        $campo1 = $campo1 . Math::modulo10($campo1);
        $campo1 = substr($campo1, 0, 5) . '.' . substr($campo1, 5);



        // 2. Segundo Grupo - composto pelas 3 últimas posiçoes do PSK e 7 primeiros dígitos do Nosso Número
        // e DV (modulo10) deste campo
        $campo2 = substr($codigoGerado, 24, 10);
        $campo2 = $campo2 . Math::modulo10($campo2);
        $campo2 = substr($campo2, 0, 5) . '.' . substr($campo2, 5);


        // 3. Terceiro Grupo - Composto por : Restante do Nosso Numero (6 digitos), IOS, Modalidade da Carteira
        // e DV (modulo10) deste campo
        $campo3 = substr($codigoGerado, 34, 10);
        $campo3 = $campo3 . Math::modulo10($campo3);
        $campo3 = substr($campo3, 0, 5) . '.' . substr($campo3, 5);



        // 4. Campo - digito verificador do codigo de barras
        $campo4 = substr($codigoGerado, 4, 1);



        // 5. Campo composto pelo fator vencimento e valor nominal do documento, sem
        // indicacao de zeros a esquerda e sem edicao (sem ponto e virgula). Quando se
        // tratar de valor zerado, a representacao deve ser 0000000000 (dez zeros).
        $campo5 = substr($codigoGerado, 5, 4) . substr($codigoGerado, 9, 10);

        return "$campo1 $campo2 $campo3 $campo4 $campo5";
    }

    public function renderizarBarras($valor) {



        $barcodes[0] = "00110";
        $barcodes[1] = "10001";
        $barcodes[2] = "01001";
        $barcodes[3] = "11000";
        $barcodes[4] = "00101";
        $barcodes[5] = "10100";
        $barcodes[6] = "01100";
        $barcodes[7] = "00011";
        $barcodes[8] = "10010";
        $barcodes[9] = "01010";

        for ($f1 = 9; $f1 >= 0; $f1--) {
            for ($f2 = 9; $f2 >= 0; $f2--) {
                $f = ($f1 * 10) + $f2;
                $texto = "";
                for ($i = 1; $i < 6; $i++) {
                    $texto .= substr($barcodes[$f1], ($i - 1), 1) . substr($barcodes[$f2], ($i - 1), 1);
                }
                $barcodes[$f] = $texto;
            }
        }


//Desenho da barra
//Guarda inicial
        echo "<div class='barra-p' style='width:{$this->fino}px; height:{$this->altura}px;'></div>";
        echo "<div class='barra-b' style='width:{$this->fino}px; height:{$this->altura}px;'></div>";
        echo "<div class='barra-p' style='width:{$this->fino}px; height:{$this->altura}px;'></div>";
        echo "<div class='barra-b' style='width:{$this->fino}px; height:{$this->altura}px;'></div>";

        $texto = $valor;
        if ((strlen($texto) % 2) <> 0) {
            $texto = "0" . $texto;
        }

// Draw dos dados
        while (strlen($texto) > 0) {
            $i = round(self::esquerda($texto, 2));
            $texto = self::direita($texto, strlen($texto) - 2);
            $f = $barcodes[$i];
            for ($i = 1; $i < 11; $i+=2) {
                if (substr($f, ($i - 1), 1) == "0") {
                    $f1 = $this->fino;
                } else {
                    $f1 = $this->largo;
                }
                echo "<div class='barra-p' style='width:{$f1}px; height:{$this->altura}px;'></div>";
                if (substr($f, $i, 1) == "0") {
                    $f2 = $this->fino;
                } else {
                    $f2 = $this->largo;
                }

                echo "<div class='barra-b' style='width:{$f2}px; height:{$this->altura}px;'></div>";
            }
        }

// Draw guarda final
        echo "<div class='barra-p' style='width:{$this->largo}px; height:{$this->altura}px;'></div>";
        echo "<div class='barra-b' style='width:{$this->fino}px; height:{$this->altura}px;'></div>";
        echo "<div class='barra-p' style='width:1px; height:{$this->altura}px;'></div>";
    }

    protected function esquerda($entra, $comp) {
        return substr($entra, 0, $comp);
    }

    protected function direita($entra, $comp) {
        return substr($entra, strlen($entra) - $comp, $comp);
    }

    protected function diasParaDataBase($year, $month, $day) {
        $century = substr($year, 0, 2);
        $year = substr($year, 2, 2);
        if ($month > 2) {
            $month -= 3;
        } else {
            $month += 9;
            if ($year) {
                $year--;
            } else {
                $year = 99;
                $century --;
            }
        }
        return ( floor(( 146097 * $century) / 4) +
                floor(( 1461 * $year) / 4) +
                floor(( 153 * $month + 2) / 5) +
                $day + 1721119);
    }

    public function fatorVencimento($data) {
        $data = explode("/", $data);
        $ano = $data[2];
        $mes = $data[1];
        $dia = $data[0];
        return (abs((self::diasParaDataBase("1997", "10", "07")) - (self::diasParaDataBase($ano, $mes, $dia))));
    }

    public static function formataNumero($numero, $loop, $insert, $tipo = "geral") {
        if ($tipo == "geral") {
            $numero = str_replace(",", "", $numero);
            while (strlen($numero) < $loop) {
                $numero = $insert . $numero;
            }
        }
        else if ($tipo == "valor") {
            /*
              retira as virgulas
              formata o numero
              preenche com zeros
             */
            $numero = str_replace(",", "", $numero);
            while (strlen($numero) < $loop) {
                $numero = $insert . $numero;
            }
        }
        else if ($tipo == "convenio") {
            while (strlen($numero) < $loop) {
                $numero = $numero . $insert;
            }
        }
        return $numero;
    }

    public function digitoVerificadorBarra($numero) {
        $resto2 = Math::modulo11($numero, 9, 1);
        if ($resto2 == 0 || $resto2 == 1 || $resto2 == 10) {
            $dv = 1;
        } else {
            $dv = 11 - $resto2;
        }
        return $dv;
    }

}

?>
