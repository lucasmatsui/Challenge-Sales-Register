# Desafio Cadastro de vendas (TRAY).
- Projeto feito em estrutura MVC seguindo a PSR-4 (autoload com composer).
- 100% com PHP :heart:
- Tentando seguir alguns conceitos como Clean Code.

## Bibliotecas usadas.
- PHPmailer

## Funcionalidades.
- Crud em modal via AJAX.
- Mini sistema de notificações
- Geração de relatório.

## Como usar ?
- Primeiramente importe o Banco de dados para o seu SGBD que está em <b><i>/Database/sales_register.sql<i></b>
- Instale o gerenciador de dependencias (Composer).
- Entre na pasta do arquivo pelo Prompt/Terminal e execute <b>composer update</b>.
- Vá no arquivo <b>config.php</b> e altere as configurações de banco de dados.
- Verifique se no arquivo <b>httpd.conf</b> a linha: <b>LoadModule rewrite_module modules/mod_rewrite.so</b> está descomentado para funcionar a URL amigável.
- Jogue os arquivos na sua pasta APACHE geralmente (www/htdocs).
- Qualquer alteração no <b>styles.scss</b> recomendo que baixe a extensão do VScode <b>Live Sass Compiler</b> para buildar um css comum que o navegador entenda.

### Preview

