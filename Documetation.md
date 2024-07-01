
# Objetivo: 💻  

Criar um sistema que envie uma notificação para o celular do usuário sempre que o PC for ligado, utilizando PHP e a API do Pushbullet.


## Requisitos de Tecnologias Utilizadas na Aplicação: 👨🏻‍💻

- [PHP](https://www.php.net/docs.php): Linguagem de programação usada para criar o script que envia a notificação. Caso não tenha o PHP instalado, faça o download do [WAMP](https://wampserver.aviatechno.net/index.php?affiche=install&lang=en).
- [Visual Studio Code](https://code.visualstudio.com/download) ou algum editor de código-fonte.
- [Pushbullet](https://www.pushbullet.com): Serviço usado para enviar notificações entre dispositivos.
- [Task Scheduler do Windows](https://learn.microsoft.com/en-us/windows-server/administration/windows-commands/tasklist): Ferramenta do Windows 10 usada para executar o script PHP automaticamente ao iniciar o sistema.


## Passo a Passo da implementação 🖊

1. Configuração do Pushbullet:

    - Crie uma conta no [Pushbullet](https://www.pushbullet.com) se ainda não tiver uma.
    - Acesse as configurações de conta e gere uma API Key. Salve essa chave, ela será usada para autenticar e enviar notificações via API.
    
    <img src="/img/token/CreateAcessToken.jpg" />


4. Instale o aplicativo Pushbullet:

    - Acesse a PlayStore no seu celular e instale a aplicação Pushbullet ou [clique aqui](https://play.google.com/store/apps/details?id=com.pushbullet.android&hl=pt_BR&pli=1) para ir direto.
    - Já no aplicativo acesse a mesma conta criada no site do [Pushbullet](https://www.pushbullet.com), no passo anterior.


5. Desenvolvimento do Script PHP:

    - Baixe os arquivos [clicando aqui](https://github.com/NickolasMendes/NotifyPC/archive/refs/heads/main.zip).
    - Substitua 'SUA_API_KEY' na linha 3 no arquivo TurnOn.php pela API Key gerada no Pushbullet.


6. Configuração do Agendador de Tarefas do Windows 10:

    - Abra o Task Scheduler (Agendador de Tarefas) no Windows.
    - Na aba direita, vá em **Criar Tarefa**.
    - Ao abrir uma janela Criar Tarefa, na aba **Geral**: 
        - Em Nome coloque: **NotifyTurnOn**.
        - Mais abaixo, marque **"Executar estando o usuário conectado ou não"**.
        - Marque **"Não armazenar a senha. A tarefa terá acesso somente aos recursos do computador local."**
        - Marque **"Executar com privilégios mais altos"**.

        <img src="/img/config/abaGeral.jpg" />


    - Na aba **Disparadores**, clique em **Novo**:
        - Em Iniciar Tarefa, selecione "**Ao fazer logon**".
        - Verifique se está selecionado "**Qualquer Usuário**".
        - Verifique se está selecionado "**Habilitado**".
        - Clique em **OK**.

        <img src="/img/config/abaDisparador.jpg" />


    - Na aba **Ação**, clique em **Novo**:
        - Em Ação, verifique se está selecionado "Iniciar um programa".
        - Em Programa/script, coloque o diretório do arquivo PHP.exe. Se você fez o download do WAMP provavlemente sera esse seguinte diretório "C:\wamp64\bin\php\php8.1.13\php.exe".
        - Em Adicione argumentos (opcional), coloque o diretório do arquivo TurnOn.php onde você fez o download, um exemplo: "C:\Users\seuUsers\suaPasta\NotifyPC\TurnOn.php".
        - Clique em **OK**.

        <img src="/img/config/abaAcoes.jpg" />


    - Na aba **Condições**:
        - Verifique se está selecionado "**Iniciar a tarefa somente se o computador estiver ligado na rede elétrica**".
        - Desmarque a seleção "**Interromper se o computador passar a usar a bateria**".
        - Clique em **OK**.

        <img src="/img/config/abaCondicoes.jpg" />


    - Na aba **Configuração**:
        - Verifique se está selecionado "**Permitir que a tarefa seja executada por demanda**".
        - Desmarque a seleção "**Interromper a tarefa se ela for executada por mais de:**".
        - Desmarque a seleção "**Se a tarefa em execução não parar quando solicitado, força a interrupção**".
        - Em "Se a tarefa já estiver sendo executada, a seguinte regra será aplicada:", selecione "Colocar uma nova instância na fila".
        - Clique em **OK** para salvar a tarefa.

        <img src="/img/config/abaConfiguracoes.jpg" />

7. Testando a Aplicação:

    - Ainda na tela de Agendador de Tarefas, selecione a tarefa criada "NotifyTurnOn" até ela ficar azul e na direita clique em "**Executar**", isso fará com que rode o script em PHP e se estiver tudo devidamente configurado irá chegar a notificação do Aplicativo Pushbullet em seu celular!
    - Reinicie o computador para verificar se a notificação é enviada corretamente ao ligar o PC.




## ❌ ALGUMAS POSSIVEIS SOLUÇÕES CASO OBTENHA UM ERRO: 

1. **Verifique a API Key:**
   - Certifique-se de que você substituiu `SUA_API_KEY` no arquivo `TurnOn.php` pela chave API correta gerada no Pushbullet.
   - A API Key deve estar ativa e correta. Caso necessário, gere uma nova chave no Pushbullet e atualize o script.

2. **Valide a Configuração do Script PHP:**
   - Assegure-se de que o caminho para o arquivo `php.exe` no Task Scheduler esteja correto.
   - Verifique se o caminho para o arquivo `TurnOn.php` está correto nos argumentos do Task Scheduler.
   - Tente executar o comando manualmente no terminal para ver se o script PHP está funcionando corretamente:
     ```sh
     C:\caminho\para\php.exe C:\caminho\para\TurnOn.php
     ```

3. **Permissões e Execução do Task Scheduler:**
   - Certifique-se de que a tarefa no Task Scheduler está configurada para ser executada com privilégios elevados (marque a opção "Executar com privilégios mais altos").
   - Verifique se a opção "Executar estando o usuário conectado ou não" está marcada.

4. **Verifique Conexão com a Internet:**
   - Assegure-se de que seu PC está conectado à internet quando a notificação deve ser enviada, pois o script PHP precisa de acesso à internet para se comunicar com a API do Pushbullet.

5. **Verifique o Log do Task Scheduler:**
   - No Task Scheduler, verifique o histórico da tarefa para identificar possíveis erros de execução. Clique com o botão direito na tarefa, selecione "Exibir Histórico" e veja se há algum erro registrado.

6. **Erros Comuns e Soluções:**
   - **Erro 401 (Unauthorized):** A chave API está incorreta ou foi revogada. Verifique e atualize a API Key.
   - **Erro 500 (Internal Server Error):** Problema no servidor do Pushbullet. Tente novamente mais tarde.
   - **Erro de Caminho:** Verifique se os caminhos para `php.exe` e `TurnOn.php` estão corretos e sem erros de digitação.

7. **Ambiente PHP:**
   - Assegure-se de que o PHP está corretamente instalado e configurado no seu sistema. Verifique se o comando `php -v` no terminal retorna a versão correta do PHP.
   - Verifique se o PHP possui as extensões necessárias para funcionar corretamente.

8. **Configurações do Pushbullet:**
   - Verifique se as notificações estão habilitadas no aplicativo Pushbullet do seu celular.
   - Assegure-se de estar logado na mesma conta do Pushbullet no navegador e no aplicativo do celular.

Seguindo essas etapas, você deverá ser capaz de diagnosticar e corrigir a maioria dos problemas que podem ocorrer durante a implementação e execução da sua aplicação de notificação. Caso tenha mais alguma dificuldade acesse a documentação das aplicaçãoes utilziadas ([PHP](https://www.php.net/docs.php) e [Pushbullet](https://www.pushbullet.com)).

Apenas após fazer todos os testes e verificações de erros, caso não tenha solucionado entre em contato comigo!



## 🚀  Feito por:  

NICKOLAS MENDES (***[Berg](https://www.instagram.com/nmcamiliss/)***)

**=> GITHUB**: [https://github.com/NickolasMendes](https://github.com/NickolasMendes) <br />
**=> LinkeIn**: [https://www.linkedin.com/in/nickolas-mendes](https://www.linkedin.com/in/nickolas-mendes) <br />
**=> Portfólio**: [nickolasmendes.github.io/portfolio](nickolasmendes.github.io/portfolio) <br />

