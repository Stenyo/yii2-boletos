<!-- Tabela com Logo; Codigo do banco com Digito verificador; Representação numerica do conteudo do codigo de barras -->
<table cellspacing="0" width="666" cellpadding="0" border="0">
    <tr>
        <td class="cp celula-bottom celula-right logo-empresa" align="center" width="150"> 
            <!-- <img class="imagem-center" src="imagens/logo-chapada-boleto.jpg"  height="37" border="0"> -->
        </td>
        <td class="cp celula-bottom celula-right celula-left" align="center" width="63">
            <font class="bc"><?php echo Constants::CODIGO_BANCO_SANTANDER . "-" . Math::modulo11(Constants::CODIGO_BANCO_SANTANDER) ?></font>
        </td>
        <td class="ld scape-text-left-7 celula-bottom celula-left " align="left" width="453">
            <?php echo $titulo ?>
        </td>
    </tr>
</table>
<!-- Tabela Primeira linha do sacado exibe: Beneficiário; Agencia/CodigodoBeneficiário; Especie; quantidade; nosso numero -->
<table cellspacing="0" width="666" cellpadding="0" border="0">
    <tbody>
        <tr>
            <td class="scape-text-left-7 ct celula-top celula-right" valign="top" width="525" height="13">Beneficiário</td>
            <td class="scape-text-left-7 ct celula-top" valign="top" width="141" height="13">Vencimento</td>
        </tr>
        <tr>
            <td class="scape-text-left-11 cp celula-right" width="521" height="12"> 
                <?php echo $model->boletoCedente->nome; ?>
            </td>
            <td class="cp scape-text-left-11" align="left" width="137" height="12">
                <?php echo $model->data_vencimento ?>
            </td>
        </tr>
    </tbody>
</table>
<!-- Tabela Segunda linha exibindo: Numero do documento; CPF/CNPJ; Vencimento; ValorDocumento -->
<table cellspacing="0" width="666" cellpadding="0" border="0">
    <tbody>
        <tr>
            <td class="scape-text-left-7 ct celula-top celula-right" valign="top" width="176" height="13">Sacado</td>
            <td class="scape-text-left-7 ct celula-top celula-right" valign="top" width="162" height="13">Número do Documento</td>
            <td class="scape-text-left-7 ct celula-top celula-right" valign="top" width="166" height="13">Nosso Número</td>
            <td class="scape-text-left-7 ct celula-top" valign="top" width="141" height="13">Valor Documento</td>
        </tr>
        <tr>
            <td class="scape-text-left-11 cp celula-right celula-bottom" valign="top" width="172" height="12"> 
                <?php echo $model->sacado_nome ?>
            </td>
            <td class="cp celula-right celula-bottom" valign="top" align="center" width="169" height="12"> 
                <?php echo $model->numero_documento ?>
            </td>
            <td class="cp celula-right celula-bottom" valign="top" align="center" width="173" height="12"> 
                <?php                 
                    echo CodigoDeBarras::formataNumero($model->nosso_numero,12,0) . Math::modulo11($model->nosso_numero);
                ?>
            </td>
            <td class="scape-text-right cp celula-bottom" valign="top" align="right" width="141" height="12">
                <?php echo $model->valor_boleto ?>
            </td>
        </tr>
    </tbody>
</table>
<!-- Tabela Quinta linha exibindo: Instruções-->
<table cellspacing="0" width="666" cellpadding="0" border="0">
    <tbody>
        <tr>
            <td class="ct"  width="7" height="12"></td>
            <td class="ct celula-right"  width="564" >Instruções(termo de resposabilidade do cliente)</td>
            <td class="ct"  width="7" height="12"></td>
            <td class="ct"  width="88" >Autenticação Mecânica</td>
        </tr>
        <tr height="220">
            <td  width="7" ></td>
            <td class=" logo-backgroun-empresa cp celula-right" width="564" >
                <span class="campo" >
                    <?php echo $model->demostrativo ?><br>
                </span>
            </td>
            <td  width="7" ></td>
            <td  width="88" ></td>
        </tr>
    </tbody>
</table>
<!-- Tabela Espaçamento entre Recibo do sacado e Ficha de compensasão -->
<table cellspacing="0" width="666" cellpadding="0" border="0">
    <tbody>
        <tr>
            <td width="7"></td>
            <td  width="564" class="cp celula-right"></td>
            <td width="7"></td>
            <td width="88"></td>
        </tr>
    </tbody>
</table>
<!-- Tabela Corte da ficha de compensassão  -->
<table cellspacing="0" width="666" cellpadding="0" border="0">
    <tr>
        <td class="ct" width="666"></td>
    </tr>
    <tbody>
        <tr>
            <td class="ct celula-bottom-dashed" width="666">
                <div align="right">Corte na linha pontilhada</div>
            </td>
        </tr>
    </tbody>
</table>
<br>
