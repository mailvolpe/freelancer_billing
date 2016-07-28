# Freelancer Billing
Sistema Open Source para gestão de clientes e cobrança recorrente automatizada que:

1. Gera faturas automaticamente (mensal ou anual) de acordo com o plano do cliente.
2. Cobra o cliente, automaticamente informando (por e-mail) sobre suas faturas, vencimentos e atrasos.
3. Tem uma área para o cliente acessar ver suas faturas, pagar online ou enviar comprovante de pagamentos.

##Demonstração
- URL: http://freelancerbilling.formasites.com.br/
- User: **admin@admin.com**
- Pass: **admin**

##Descrição do Funcionamento a partir do modelo de dados
Link para video explicativo sobre o modelo de dados: (https://www.youtube.com/watch?v=cbCMy5xd_SQ)

###Clientes
Um cliente tem
- Nome, E-mail
- Exigir troca de senha (quando marcado o sistema não deixa ele fazer nada antes de cadstrar uma nova senha)
- Data e IP do último acesso
- Data de criação e ultima atualização
		
###Recorrências - ou Planos
Para cada cliente podemos cadastrar uma ou mais recorrências (Na interface isso está nomeado como Planos) As recorrencias são utilizadas para o sistema gerar faturas automaticamente.
Cada recorrencia tem:
- Valor e Descrição
- Dia do vencimento (as faturas serão geradas neste dia)
- Mes de vencimento (utilizado somente em recorrencias anuais)
- Núemero máximo de repetições (Se vazio, repete indefinidamente)
- Ativa ou Inativa
	
###Faturas
As faturas são os títulos que aparecem na área do cliente.
Cada fatura tem:
- Valor e Descrição
- Data do vencimento (as faturas serão geradas neste dia)
- Informações sobre o pagamento ou se está pendente
			
###Transações
Para cada fatura o sistema tem informações sobre transações relacionadas. O cliente pode iniciar uma transação para pagar uma fatura e essa transação fica vinculada à fatura.
Cada transação tem:
* Data da última atualização de status dessa transação
* Gateway ou meio de pagamento selecionado
* O código ou ID da transação no meio de pagamento selecionado (Ex.: ID da transação no PagSeguro)
* Status da transação
			
###Notificações
O sistema também gera notificações para para essas faturas
Cada notificação tem:
* Tipo de notificação (Aviso de fatura criada, Aviso de Fatura Vencida, Segundo Aviso de Fatura Vencida, etc). Para cada tipo teremos um template de email que será preenchido com os dados do cliente e da fatura.
* Informações sobre a abertura do e-mail de notificação contendo data e IP utilzados.

## Rotinas Automáticas
* O sistema deve criar faturas automaticamente a partir das regras cadastradas nos planos. (Faturas também podem ser criadas manualmente)
* O sistema deve enviar as notificações automaticamente a partir das faturas criadas.
			 
## Instalação
Vídeo explicativo para instalação: (https://www.youtube.com/watch?v=1MvsIhmpJzM)

1. Baixe o repositório
2. Crie a base de dados "billing" e importe o arquivo .sql (DUMP)
3. Coloque os arquivos em seu servidor local "Ex,: http://localhost" e pronto.

## Contribua

1. Veja as tarefas e próximos passos em (https://trello.com/b/SQzvgWzT/freelancer-billing)
2. Leia a documentação do framework utilizado: (http://www.codeigniter.com/userguide2/) É simples, leve tem uma curva de arendizado muito suave e várias funções e recursos embutidos.
