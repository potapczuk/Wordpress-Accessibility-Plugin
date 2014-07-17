=== WPA - WordPress Acessível ===
Desenvolvedores: Diego Potapczuk
Palavras-chaves: acessibilidade, pessoas com deficiência visual, usabilidade, ferramentas
Requer pelo menos: 2.7
Testado até: 2.9

== Descrição ==

Adiciona uma série de funcionalidades de navegação e acessibilidade para auxiliar os leitores que possuem deficiências visuais.

== Instalação ==

1. Faça o upload do diretório 'wpa' (incluindo todo os arquivos internos) para o diretório '/wp-content/plugins/';

2. Ative o plugin através do menu 'Plugins' no WordPress;

3. Adicione o seguinte código no cabeçalho do seu tema, bem abaixo da tag <body>;

<?php
if( function_exists('WPA_DP_TOOLBAR') )
	WPA_DP_TOOLBAR(array("html_wrap_open" => "<li>", "html_wrap_close" => "</li>") );
?>

4. Tenha certeza que a opção 'URLs amigáveis' esteja ativado para a página 'como usar o site' funcionar

5. Tenha certeza que o widget de pesquisa esteja ativado


== Instalation ==

1. Upload the `wpa` directory (including all files within) to the `/wp-content/plugins/` directory

2. Activate the plugin through the `Plugins` menu in WordPress

3. Add the following code to the header of your theme just bellow the <body> tag

<?php
if( function_exists('WPA_DP_TOOLBAR') )
	WPA_DP_TOOLBAR(array("html_wrap_open" => "<li>", "html_wrap_close" => "</li>") );
?>

4. Make sure the friendly URL is activated for the "how to use" page to work

5. Make sure the search widget is activated

== Frequently Asked Questions ==

= How can I add the toolbar to another area of my theme? =

In the Theme Editor, place this code block where you want the toolbar and it will appear in your theme:

<?php
if( function_exists('WPA_DP_TOOLBAR') )
	WPA_DP_TOOLBAR(array("html_wrap_open" => "<li>", "html_wrap_close" => "</li>") );
?>


== Registro de mudanças ==

= 0.1 =
Desenvolvimento inicial da ferramenta

= 0.2 =
Adicionado os links de pulo para página inicial e pesquisa
Adicionado teclas de atalhos para todos os links da barra
Modificado forma de inserir CSS e JS para arquivos externos
Retirado os CSS ainda não aceitos pela W3C
Retiradas todas as medidas absolutas do CSS
Adicionado separadores entre links
Adicionado noscript para cada script
Links de contraste transformados em imagens
Melhoradas as informações sobre como usar o site
Adicionado accesskeys direto no formulário de busca, conteúdo e menu
Adicionadas accesskeys via javascript para a utilização de alt+atalho para IE e FIREFOX

= 0.3 =
Adicionar botões para verificar HTML, CSS e Acessibilidade
Fazer ferramenta para alertar administrador de imagens sem alt tag

= Planejamento de versões =

0.4
Apagar a página de "como usar" ao desativar a extensão

0.5
Criar uma página de configuração permitindo controlar quais itens da extensão estarão ativos
Permitir ativar CSS com bordas arredondadas

0.6
Criar uma página de configuração para permitir colocar outros itens de "skip links"

0.7
Preparar extensão para internacionalização e traduzir para inglês

0.8
Criar versão da barra em formato widget

0.9
Verificar uso de teclas de atalho
