<?php

class MapperSegmentoSantander implements MapperSegmento {

    public function map($remessa, BoletoActiveRecord $boleto, $numero_sequencial, BoletoCedenteActiveRecord $cedente) {
        $segmentoP = new SantanderLayout240SegmentoP;

        $segmentoP->lote_de_servico = 1;
        $segmentoP->numero_sequencial_do_registro_no_lote = $numero_sequencial;
        $segmentoP->codigo_de_movimento = $boleto->remessa;
        $segmentoP->agencia_mantenedora_da_conta = $cedente->agencia;
        $segmentoP->digito_verificador_da_agencia_1 = $cedente->digito_verificador_agencia;
        $segmentoP->numero_da_conta_corrente = $cedente->numero_conta_corrente;
        $segmentoP->digito_verificador_da_conta = $cedente->digito_verificador_conta;
        $segmentoP->conta_cobranca = $cedente->numero_conta_corrente;
        $segmentoP->digito_verificador_conta_cobranca = $cedente->digito_verificador_conta;
        $segmentoP->identificacao_do_titulo_no_banco = $boleto->nosso_numero . Math::modulo11($boleto->nosso_numero);
        $segmentoP->codigo_da_carteira = SantanderConstants::TIPO_DE_COBRANCA_REMESSA_COBRANCA_SIMPLES_RAPIDA_COM_REGISTRO;
        $segmentoP->forma_de_cadastramento_do_titulo_no_banco = SantanderConstants::FORMA_DE_CADASTRAMENTO_COBRANCA_REGISTRADA;
        $segmentoP->tipo_de_documento = SantanderConstants::TIPO_DE_DOCUMENTO_ESCRITURAL;
        $segmentoP->numero_do_doucumento_de_cobranca = $boleto->numero_documento;
        $segmentoP->data_de_vencimento_do_titulo = DateTime::createFromFormat('Y-m-d', $boleto->data_vencimento)->format('dmY');
        $segmentoP->valor_nominal_do_titulo = $boleto->valor_boleto * 100;
        $segmentoP->especie_do_titulo = SantanderConstants::ESPECIE_DO_TITULO_DS;
        $segmentoP->data_da_emissao_do_titulo = DateTime::createFromFormat('Y-m-d', $boleto->data_documento)->format('dmY');
        $segmentoP->codigo_do_juros_de_mora = SantanderConstants::CODIGO_DO_JUROS_MORA_POR_DIA;
        $segmentoP->data_do_juros_de_mora = DateTime::createFromFormat('Y-m-d', $boleto->data_vencimento)->format('dmY');
        $segmentoP->juros_de_mora_por_dia_taxa = ceil($boleto->juros_de_mora_por_dia_taxa * 100);
        if ($boleto->numero_de_dias_para_baixa_devolucao != null) {
            $segmentoP->codigo_para_baixa_devolucao = SantanderConstants::CODIGO_PARA_BAIXA_DEVOLUCAO_BAIXAR_DEVOLVER;
            $segmentoP->numero_de_dias_para_baixa_devolucao = $boleto->numero_de_dias_para_baixa_devolucao;
        } else
            $segmentoP->codigo_para_baixa_devolucao = SantanderConstants::CODIGO_PARA_BAIXA_DEVOLUCAO_NAO_BAIXAR_NAO_DEVOLVER;

        $result = [];
        $result[] = $segmentoP;

        if ($boleto->remessa == SantanderConstants::CODIGO_DE_MOVIMENTO_PARA_REMESSA_ENTRADA_DE_TITULO) {
            $segmentoQ = new SantanderLayout240SegmentoQ;
            $segmentoQ->lote_de_servico = 1;
            $segmentoQ->numero_sequencial_do_registro_no_lote = ++$numero_sequencial;
            $segmentoQ->codigo_de_movimento = $boleto->remessa;

            $segmentoQ->tipo_de_inscricao_do_sacado = $boleto->sacado_tipo_inscricao;
            $segmentoQ->numero_de_inscricao_do_sacado = $boleto->sacado_documento;
            $segmentoQ->nome = $boleto->sacado_nome;
            $segmentoQ->endereco = substr($boleto->sacado_rua, 0, 40 - (strlen($boleto->sacado_numero) + 3)) . " N" . $boleto->sacado_numero;
            $segmentoQ->bairro = $boleto->sacado_bairro;
            $segmentoQ->cep = substr($boleto->sacado_cep, 0, 5);
            $segmentoQ->sufixo_do_cep = substr($boleto->sacado_cep, 5, 3);
            $segmentoQ->cidade = $boleto->sacado_cidade;
            $segmentoQ->unidade_da_federacao = $boleto->sacado_uf;

            $segmentoR = new SantanderLayout240SegmentoR;
            $segmentoR->lote_de_servico = 1;
            $segmentoR->numero_sequencial_do_registro_no_lote = ++$numero_sequencial;
            $segmentoR->codigo_de_movimento = $boleto->remessa;
            $segmentoR->codigo_da_multa = SantanderConstants::CODIGO_DA_MULTA_PORCENTAGEM;
            $segmentoR->data_da_multa = DateTime::createFromFormat('Y-m-d', $boleto->data_vencimento)->format('dmY');
            $segmentoR->valor_percentual_a_ser_aplicado = Yii::app()->params['porcentagem_multa_atraso_boleto'] * 10000;

            $segmentoS = new Layout240SegmentoS(IReadable::EOL_WIN);
            $segmentoS->codigo_do_banco_na_compensacao = SantanderConstants::CODIGO_DO_BANCO;
            $segmentoS->lote_de_servico = 1;
            $segmentoS->numero_sequencial_do_registro_no_lote = ++$numero_sequencial;
            $segmentoS->codigo_de_movimento = $boleto->remessa;
            $segmentoS2 = new Layout240SegmentoSImpressao2;


            $segmentoS2->mensagem_5 = $boleto->instrucoes_1;
            $segmentoS2->mensagem_6 = $boleto->instrucoes_2;
            $segmentoS2->mensagem_7 = $boleto->instrucoes_3;
            $segmentoS->setImpressao($segmentoS2);

            $result[] = $segmentoQ;
            $result[] = $segmentoR;
            $result[] = $segmentoS;
        }


        $boleto_remessa = new BoletoRemessaActiveRecord;
        $boleto_remessa->remessa_id = $remessa;
        $boleto_remessa->boleto_id = $boleto->id;
        $boleto_remessa->data_do_vencimento_do_titulo = $boleto->data_vencimento;
        $boleto_remessa->valor_nominal_do_titulo = $boleto->valor_boleto;
        $boleto_remessa->codigo_do_juros_de_mora = SantanderConstants::CODIGO_DO_JUROS_MORA_POR_DIA;

        $boleto_remessa->data_do_juros_de_mora = $boleto->data_vencimento;
        $boleto_remessa->juros_de_mora_por_dia_taxa = $boleto->juros_de_mora_por_dia_taxa;
        $boleto_remessa->identificacao_do_titulo_na_empresa = $boleto->nosso_numero;
        $boleto_remessa->codigo_para_baixa_devolucao = SantanderConstants::CODIGO_PARA_BAIXA_DEVOLUCAO_NAO_BAIXAR_NAO_DEVOLVER;
        $boleto_remessa->codigo_movimento = $boleto->remessa;
        $boleto->remessa = null;

        if ($boleto_remessa->save())
            $boleto->save();

        return $result;
    }

}
