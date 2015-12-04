<?php
$barCode = new CodigoDeBarras;

$codigo_de_barra = $barCode->gerarCodigo(Constants::CODIGO_BANCO_SANTANDER, BoletoSantander::NUM_MOEDA, DateTime::createFromFormat('Y-m-d', $model->data_vencimento)->format('d/m/Y'), $model->valor_boleto * 100, BoletoSantander::FIXO, $model->boletoCedente->identificacao_beneficiario, $model->nosso_numero, BoletoSantander::IOF, $model->codigo_da_carteira);

$linha_digitavel = $barCode->gerarLinhaDigitavel($codigo_de_barra);
?>

<table cellspacing=0 width="666" cellpadding=0  border=0>
    <tr>
        <td class="image-santander cp celula-bottom celula-right" align="center" height="37" width=160> 
        </td>
        <td class="cp celula-bottom celula-right celula-left" width=63 align=center>
            <font class=bc><?= Constants::CODIGO_BANCO_SANTANDER . "-" . Math::modulo11(Constants::CODIGO_BANCO_SANTANDER) ?></font>
        </td>
        <td class="ld celula-bottom celula-left scape-text-left-7" align=left width=453>
            <span class=ld> 
                <?= $linha_digitavel ?>
            </span>
        </td>
    </tr>
</table>
<!-- Tabela Segunda linha Ficha de compensassão exibindo: Local de pagamento; Vencimento-->
<table cellspacing=0 width="666" cellpadding=0 border=0>
    <tbody>
        <tr>
            <td class="scape-text-left-7 ct celula-top celula-right" valign=top width=471 height=13>Local de Pagamento</td>
            <td class="scape-text-left-7 ct celula-top" valign=top width=181 height=13>Vencimento</td>
        </tr>
        <tr>
            <td class="scape-text-left-11 cp celula-right celula-bottom" valign=top width=471 height=12>
                Pagar preferencialmente no Grupo Santander - GC
            </td>
            <td class="scape-text-right cp celula-bottom" valign=top align=right width=181 height=12> 
                <?= date('d/m/Y', strtotime($model->data_vencimento)) ?>
            </td>
        </tr>
    </tbody>
</table>
<!-- Tabela Terceira linha Ficha de compensassão exibindo: Beneficiário; Ponto Venda / Ident. Beneficiário;-->
<table cellspacing=0 width="666" cellpadding=0 border=0>
    <tbody>
        <tr height=13>
            <td class="scape-text-left-7 ct celula-right" valign=top width=471>Beneficiário</td>
            <td class="scape-text-left-7 ct" valign=top width=181>Agência / Ident. Beneficiário</td>
        </tr>
        <tr>
            <td class="scape-text-left-11 cp celula-right celula-bottom" valign=top width=471 height=12> 
                <?= $model->boletoCedente->nome_impressao ?>
            <td class="scape-text-left-11 cp celula-bottom" valign=top width=177 height=12> 
                <?php
                echo $model->boletoCedente->agencia . " / " . $model->boletoCedente->identificacao_beneficiario;
                ?>

            </td>
        </tr>
    </tbody>
</table>
<!-- Tabela Quarta linha Ficha de compensassão exibindo: Beneficiário; Ponto Venda / Ident. Beneficiário;-->
<table cellspacing=0 width="666" cellpadding=0 border=0>
    <tbody>
        <tr>
            <td class="scape-text-left-7 ct celula-right" valign=top width=88 height=13>Data do Documento</td>
            <td class="scape-text-left-7 ct celula-right" valign=top width=91 height=13>Número do Documento</td>
            <td class="scape-text-left-7 ct celula-right" valign=top width=88 height=13>Espécie Documento</td>
            <td class="scape-text-left-7 ct celula-right" valign=top width=88 height=13>Aceite</td>
            <td class="scape-text-left-7 ct celula-right" valign=top width=88 height=13>Data do Processamento</td>
            <td class="scape-text-left-7 ct" valign=top width=181 height=13>Nosso Número</td>
        </tr>
        <tr>
            <td class="scape-text-left-11 cp celula-right celula-bottom" valign=top align=left width=84 height=12>
                <?= date('d/m/Y', strtotime($model->data_documento)) ?>
            </td>
            <td class="scape-text-left-11 cp celula-right celula-bottom" valign=top width=87 height=12> 
                <?= $model->numero_documento ?>
            </td>
            <td class="scape-text-left-11 cp celula-right celula-bottom" valign=top  align=left width=84 height=12>
                <?= $model->especie_de_documento ?>
            </td>
            <td class="scape-text-left-11 cp celula-right celula-bottom" valign=top align=left  width=84 height=12>
                <?= $model->aceite ?>
            </td>
            <td class="scape-text-left-11 cp celula-right celula-bottom" valign=top align=left  width=84 height=12>
                <?= date('d/m/Y', strtotime($model->data_processamento)) ?>
            </td>
            <td class="scape-text-left-11 cp celula-bottom" valign=top align=right width=177 height=12> 
                <?= CodigoDeBarras::formataNumero($model->nosso_numero, 12, 0) . " " . Math::modulo11($model->nosso_numero); ?>
            </td>
        </tr>
    </tbody>
</table>
<!-- Tabela Quinta linha Ficha de compensassão exibindo: Carteira; Espécie;Quantidade;Valor Documento; (=) Valor documento;-->
<table cellspacing=0 width="666" cellpadding=0 border=0>
    <tbody>
        <tr>
            <td class="scape-text-left-7 ct celula-right" valign=top width=203 height=13>Carteira</td>
            <td class="scape-text-left-7 ct celula-right" valign=top width=53 height=13>Espécie</td>
            <td class="scape-text-left-7 ct celula-right" valign=top width=123 height=13>Quantidade</td>
            <td class="scape-text-left-7 ct celula-right" valign=top width=72 height=13>Valor</td>
            <td class=" scape-text-left-7 ct" valign=top width=181 height=13>(=) Valor documento</td>
        </tr>
        <tr>
            <td class="scape-text-left-11 cp celula-right celula-bottom" valign=top align=left height=12 width=199>
                <?= $model->codigo_da_carteira . ' - ' . BoletoSantander::descricaoCarteira($model->codigo_da_carteira) ?>
            </td>
            <td class="scape-text-left-11 cp celula-right celula-bottom" align=left valign=top  width=49>
                <?= Constants::TIPO_MOEDA ?>
            </td>
            <td class="scape-text-left-11 cp celula-right celula-bottom" valign=top  width=119>
                <?= $model->quantidade ?>
            </td>
            <td class="scape-text-left-11 cp celula-right celula-bottom" valign=top  width=68> 
                <?= !empty($model->valor_unitario) ? Yii::app()->numberFormatter->formatCurrency($model->valor_unitario, 'BRL') : '' ?>
            </td>
            <td class="scape-text-right cp celula-bottom" valign=top align=right width=181 height=12> 
                <?= !empty($model->valor_boleto) ? Yii::app()->numberFormatter->formatCurrency($model->valor_boleto, 'BRL') : '' ?>
            </td>
        </tr>
    </tbody>
</table>
<!-- Tabela Quinta linha Ficha de compensassão exibindo: Carteira; Espécie;Quantidade;Valor Documento; (=")" Valor documento;-->
<table cellspacing="0" cellpadding="0" width="666" border="0">
    <tbody>
        <tr>
            <td align="right" width="10">
                <table cellspacing="0" cellpadding="0" border="0" align="left">
                    <tbody>
                        <tr>
                            <td class="ct" valign="top" width="8" height="13">
                            </td>
                        </tr>
                        <tr>
                            <td class="cp" valign="top" width="8" height="12">
                            </td>
                        </tr>
                        <tr>
                            <td class="" valign="top" width="8" height="1">                                                                
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td valign="top" width="468" rowspan="5">
                <font class="ct">Instruções (termo de responsabilidade do beneficiário)</font>
                <br>
                <br>
                <span class="cp">
                    <?= $model->instrucoes_1 ?>
                    <br>
                    <?= $model->instrucoes_2 ?>
                    <br>
                    <br>
                    <?= $model->instrucoes_3 ?>
                    <br>
                </span>
            </td>
            <td align="right" width="188">
                <table width="188" cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                        <tr>
                            <td class="ct celula-left scape-text-left-7" valign="top" width="188" height="13">(-) Desconto</td>
                        </tr>
                        <tr>
                            <td class="cp celula-left" valign="top" align="right" width="188" height="12"><?= $model->valor_percentual_a_ser_concedido_do_desconto; ?></td>
                        </tr>
                        <tr>
                            <td class="celula-bottom" valign="top" width="188" height="1"></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td align="right" width="10">
                <table cellspacing="0" cellpadding="0" border="0" align="left">
                    <tbody>
                        <tr>
                            <td class="ct" valign="top" width="8" height="13">                      
                            </td>
                        </tr>
                        <tr>
                            <td class="cp" valign="top" width="8" height="12">
                            </td>
                        </tr>
                        <tr>
                            <td class="" valign="top" width="8" height="1">                                                                 
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td align="right" width="188">
                <table cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                        <tr>
                            <td class="ct celula-left scape-text-left-7" valign="top" width="185" height="13">(-) Abatimento</td>
                        </tr>
                        <tr>
                            <td class="cp celula-left" valign="top" align="right" width="185" height="12"><?= $model->valor_do_abatimento; ?></td>
                        </tr>
                        <tr>
                            <td class="celula-bottom" valign="top" width="188" height="1"></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td align="right" width="10">
                <table cellspacing="0" cellpadding="0" border="0" align="left">
                    <tbody>
                        <tr>
                            <td class="ct" valign="top" width="8" height="13">                      
                            </td>
                        </tr>
                        <tr>
                            <td class="cp" valign="top" width="8" height="12">
                            </td>
                        </tr>
                        <tr>
                            <td class="" valign="top" width="8" height="1">                                                                 
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td align="right" width="188">
                <table cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                        <tr>
                            <td class="ct celula-left scape-text-left-7" valign="top" width="185" height="13">(+) Mora</td>
                        </tr>
                        <tr>
                            <td class="cp celula-left" valign="top" align="right" width="185" height="12"><?= Yii::app()->numberFormatter->formatCurrency($model->juros_de_mora_por_dia_taxa, 'BRL') ?></td>
                        </tr>
                        <tr>
                            <td class="celula-bottom" valign="top" width="188" height="1"></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td align="right" width="10">
                <table cellspacing="0" cellpadding="0" border="0" align="left">
                    <tbody>
                        <tr>
                            <td class="ct" valign="top" width="8" height="13"></td>
                        </tr>
                        <tr>
                            <td class="cp" valign="top" width="8" height="12"></td>
                        </tr>
                        <tr>
                            <td class="cp" valign="top" width="8" height="1"></td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td align="right" width="188">
                <table cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                        <tr>
                            <td class="ct celula-left scape-text-left-7" valign="top" width="188" height="13">(+) Outros Acréscimos</td>
                        </tr>
                        <tr>
                            <td class="cp celula-left" valign="top" align="right" width="188" height="12"><?= $model->outros_acrescimos; ?></td>
                        </tr>
                        <tr>
                            <td class="celula-bottom" valign="top" width="188" height="1"></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td align="right" width="10">
                <table cellspacing="0" cellpadding="0" border="0" align="left">
                    <tbody>
                        <tr>
                            <td class="ct" valign="top" width="7" height="13"></td>
                        </tr>
                        <tr>
                            <td class="cp" valign="top" width="7" height="12"></td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td align="right" width="188">
                <table cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                        <tr>
                            <td class="ct celula-left scape-text-left-7" valign="top" width="187" height="13">(=) Valor Cobrado</td>
                        </tr>
                        <tr>
                            <td class="cp celula-left" valign="top" align="right" width="187" height="12">
                                <?= !empty($model->valor_cobrado) ? Yii::app()->numberFormatter->formatCurrency($model->valor_cobrado, 'BRL') : '' ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<table cellspacing="0" cellpadding="0" width="666" border="0">
    <tbody>
        <tr>
            <td class="celula-top" valign="top" width="666" height="1"></td>
        </tr>
    </tbody>
</table>
<table cellspacing="0" width="666" cellpadding="0" border="0">
    <tbody>
        <tr>                                            
            <td class="scape-text-left-7 ct" valign="top" width="659" height="13">Sacado:</td>
        </tr>
        <tr>                                            
            <td class="scape-text-left-20 cp" valign="top" width="646" height="12">
                <?= $model->sacado_nome . " CPF/CNPJ: " . $model->sacado_documento ?>
            </td>
        </tr>
    </tbody>
</table>
<table cellspacing="0" width="666" cellpadding="0" border="0">
    <tbody>
        <tr>
            <td class="scape-text-left-20 cp" valign="top" width="646" height="12">
                <?php
                echo $model->sacado_rua;
                echo " - " . $model->sacado_numero;
                echo"<br>";
                echo $model->sacado_bairro;
                echo"<br>";
                echo $model->sacado_cep;
                echo " - " . $model->sacado_cidade;
                echo "/" . $model->sacado_uf;
                echo"<br>";
                echo $model->sacado_complemento;
                ?>
            </td>
        </tr>
    </tbody>
</table>
<table cellSpacing="0" width="666" cellPadding="0" border="0" width="666">
    <tbody>
        <tr height="4"></tr>
        <tr>
            <td class="ct celula-bottom"  width="666" >Sacador/Avalista:</td>
        </tr>
    </tbody>
</table>
<table cellSpacing="0" cellPadding="0" width="666" border="0">
    <tbody>
        <tr height="4"></tr>
        <tr>
            <td width="416">                                    
            </td>
            <td width="250">
                <div align="center">
                    <h2 class="back cp">
                        <span>
                            Autenticação Mecânica
                        </span>
                    </h2>
                </div>
            </td>
        </tr>
    </tbody>
</table>
<table cellSpacing="0" cellPadding="0" width="666" border="0">
    <tbody>
        <tr>
            <td vAlign="bottom" align="left" height="50">
                <?php $barCode->renderizarBarras($codigo_de_barra); ?>
            </td>
        </tr>
    </tbody>
</table>
<table cellspacing="0" width="666" cellpadding="0" border="0">
    <tr>
        <td class="ct" width="666"></td>
    </tr>
    <tbody>
        <tr>
            <td class="cp celula-bottom-dashed" width="666">
                <div align="right">Ficha de Compensação</div>
            </td>
        </tr>
    </tbody>
</table>