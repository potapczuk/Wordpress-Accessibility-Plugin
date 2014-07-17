<?php
/*
Plugin Name: WPA: WordPress Acessível
Plugin URI: http://www.diegoliveira.com.br/blog/wpa
Description: Adiciona uma série de funcionalidades de navegação e acessibilidade para auxiliar os leitores que possuem deficiências visuais.
Version: 0.9
Author: Diego Potapczuk
Author URI: http://www.diegoliveira.com.br/
*/

global $WPA_DP_version;
$WPA_DP_version = '0.9';

if( !isset($WPA_DP_locale) )
	$WPA_DP_locale = '';

// Pre-2.6 compatibility
if ( !defined('WP_CONTENT_URL') )
    define( 'WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
if ( ! defined( 'WP_PLUGIN_URL' ) )
      define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );

$WPA_DP_plugin_basename = plugin_basename(dirname(__FILE__));
$WPA_DP_plugin_url_path = WP_PLUGIN_URL.'/'.$WPA_DP_plugin_basename; // /wp-content/plugins/wpa

function WPA_DP_textdomain() {
	global $WPA_DP_plugin_url_path, $WPA_DP_plugin_basename;
	
	load_plugin_textdomain('wpa',
		$WPA_DP_plugin_url_path.'/languages',
		$WPA_DP_plugin_basename.'/languages');
}
add_action('init', 'WPA_DP_textdomain');

function WPA_DP_link_vars($linkname = FALSE, $linkurl = FALSE) {
	global $post;
	
	$linkname		= ($linkname) ? $linkname : get_the_title($post->ID);
	$linkname_enc	= rawurlencode( $linkname );
	$linkurl		= ($linkurl) ? $linkurl : get_permalink($post->ID);
	$linkurl_enc	= rawurlencode( $linkurl );	
	
	return compact( 'linkname', 'linkname_enc', 'linkurl', 'linkurl_enc' );
}

function WPA_DP_TOOLBAR( $args = false ) {

	global $WPA_DP_plugin_url_path;
	
	$server = $_SERVER['SERVER_NAME'];
	$endereco = $_SERVER ['REQUEST_URI'];
	
	$urlAtual = "http://" . $server . $endereco;
	
	if( $args )
		extract( $args ); // output_later, html_wrap_open, html_wrap_close, linkname, linkurl
?>
	
	<script src="<?php echo $WPA_DP_plugin_url_path; ?>/js/jquery.js" type="text/javascript"></script><noscript>.</noscript>
	<script src="<?php echo $WPA_DP_plugin_url_path; ?>/js/jquery.hotkeys.js" type="text/javascript"></script><noscript>.</noscript>
	<script src="<?php echo $WPA_DP_plugin_url_path; ?>/js/wpa.js.php?url=<?php echo bloginfo('url'); ?>" type="text/javascript"></script><noscript>.</noscript>
	<div id="acessibilidade">
        <img id="acess" src="<?php echo $WPA_DP_plugin_url_path; ?>/images/acess.png" alt="Barra de acessibilidade" width="29" height="33" />
        <a id="acess-como-usar" href="<?php bloginfo('url'); ?>/como-usar-o-site" accesskey="5">Como usar o site [alt+5]</a>
        <span class="escondido"> | </span>
        <a id="acess-ir-para-menu" class="escondido" href="#menustart">Ir para o menu [alt+1]</a>
        <span class="escondido"> | </span>
        <a id="acess-ir-para-conteudo" class="escondido" href="#contentstart">Ir para o conte&uacute;do [alt+2]</a>
        <span class="escondido"> | </span>
        <a class="acess-link-escondido escondido" href="<?php bloginfo('url'); ?>" accesskey="3">Ir para a página inicial [alt+3]</a>
        <span class="escondido"> | </span>
        <a class="acess-link-escondido escondido" href="#searchform">Ir para o formulário de pesquisa [alt+4]</a>
        <span class="escondido"> | </span>
        <a id="acess-normal" href="#" title="Cores normais do site">
            <img src="<?php echo $WPA_DP_plugin_url_path; ?>/images/c_normal.png" alt="Cores normais do site" />
        </a>
        <span class="escondido"> | </span>
        <a id="acess-contraste" href="#" title="Cores com alto contraste do site">
            <img src="<?php echo $WPA_DP_plugin_url_path; ?>/images/c_contraste.png" alt="Cores com alto contraste do site" />
        </a>
        <span class="escondido"> | </span>
        <a id="acess-a-menos" href="#" title="Diminuir o tamanho das letras">
            <img src="<?php echo $WPA_DP_plugin_url_path; ?>/images/acess_a_menos.png" alt="Diminuir o tamanho das letras" />
        </a>
        <span class="escondido"> | </span>
        <a id="acess-a" href="#" title="Tamanho das letras padr&atilde;o">
            <img src="<?php echo $WPA_DP_plugin_url_path; ?>/images/acess_a.png" alt="Tamanho das letras padr&atilde;o" />
        </a>
        <span class="escondido"> | </span>
        <a id="acess-a-mais" href="#" title="Aumentar o tamanho das letras">
            <img src="<?php echo $WPA_DP_plugin_url_path; ?>/images/acess_a_mais.png" alt="Aumentar o tamanho das letras" />
        </a>
    </div>
    <div class="clear"></div>
        <?php if(current_user_can('edit_page')):?>
        <div id="acessibilidade" class="administrador">
        <span class="escondido"> | </span>
        <a id="acess-alt-images" class="acess-link" href="#" title="Identificar imagens sem alt tag">
            Identificar imagens sem alt tag
        </a>
        <span class="escondido"> | </span>
        <a id="acess-html" class="acess-link" href="http://validator.w3.org/check?verbose=1&uri=<?php echo htmlentities2($urlAtual); ?>"
        title="Validar HTML"  target="_blank">
            Validar HTML
        </a>
        <span class="escondido"> | </span>
        <a id="acess-css" class="acess-link" href="http://jigsaw.w3.org/css-validator/validator?profile=css21&warning=0&uri=<?php echo htmlentities2($urlAtual); ?>"
        title="Validar CSS" target="_blank">
            Validar CSS
        </a>
        <span class="escondido"> | </span>
        <a id="acess-wcag" class="acess-link" href="http://www.sidar.org/hera/index.php.en?url=<?php echo htmlentities2($urlAtual); ?>"
        title="Validar WCAG 1.0" target="_blank">
            Validar WCAG 1.0
        </a>
        </div>
        <div class="clear"></div>
        <?php endif; ?>
<?php 
}

function WPA_DP_header($no_style_tag) {
	global $WPA_DP_plugin_url_path;
	?>
	<link rel="stylesheet" title="wpa" href="<?php echo $WPA_DP_plugin_url_path; ?>/styles/style.css" type="text/css" />
	<link rel="alternate stylesheet" title="contraste" href="<?php echo $WPA_DP_plugin_url_path; ?>/styles/contraste.css" type="text/css" />
	<?php
	
}
add_action('wp_head', 'WPA_DP_header');

function WPA_DP_search_accesskey($content) {
	$content = str_ireplace('id="s"', 'id="s" accesskey="4"', $content);
	return $content;
}
add_filter('get_search_form', 'WPA_DP_search_accesskey');

function WPA_DP_content_accesskey() {
	$content = '<a href="#contentstart" id="contentstart" accesskey="2" class="escondido">Início do Conteúdo</a>';
	echo $content;
}
add_action('loop_start', 'WPA_DP_content_accesskey');

function WPA_DP_sidebar_accesskey() {
	$content = '<a href="#menustart" id="menustart" accesskey="1" class="escondido">Início do Menu</a>';
	echo $content;
}
add_action('get_sidebar', 'WPA_DP_sidebar_accesskey');

function WPA_DP_install() {
	global $wpdb, $WPA_DP_version;

	$versao = get_option('WPA_DP_version');
	
	if($versao == false){
	    $table_name = $wpdb->prefix . "posts";
	    
	    $title = 'Como usar o site';
	    $url_name = 'como-usar-o-site';
	    $text = 'Essa página é destinada a dar algumas informações de como melhor usar esse site além de informar sobre a preocupação em tornar-lo acessível.

<strong>Barra de acessibilidade</strong>

Esse site possui uma barra de acessibilidade localizada no seu topo com o intuito de prover diversas ferramentas para que o visitante possa usufruir melhor das informações presentes.

<strong>Como aumentar o tamanho das letras deste site?</strong>

Para permitir que pessoas com dificuldades visuais possam ler os textos e navegar pelo site adequadamente, esse site permite que o visitante possa alterar o tamanho das letras facilmente através da barra de acessibilidade disponível no topo do site. Além disso, o visitante também pode usar os mecanismos disponíveis no seu navegador.

<strong>Como visualizar o site usando cores de alto contraste?

</strong>Para permitir uma melhor visualização do site e do seu conteúdo pelo visitante com problemas visuais e problemas de percepção de cores como o daltonismo, o site possui uma versão visual que usa cores de alto contraste e pode ser ativada usando o botão "C" amarelo localizado na barra de acessibilidade.

<strong>Como voltar a ver o site com as cores normais?</strong>

Depois de ativado o modo de cores de alto contraste para voltar para a visualização normal do site, basta clicar no primeiro botão "C" da barra de acessibilidade.

<strong>Como pular direto para o menu?</strong>

Para pular direto para o menu existe um link especial na barra de  acessibilidade logo após o "Como usar o site" que pode ser alcançado  utilizando a tecla "TAB" e colocando o foco do navegador sobre ele, ou  então pode se utilizar a tecla de acesso rápido "1".

<strong>Como pular direto para o conteúdo?</strong>

Para pular direto para o conteúdo existe um link especial na barra de acessibilidade logo após o "Como usar o site" que pode ser alcançado utilizando a tecla "TAB" e colocando o foco do navegador sobre ele, ou então pode se utilizar a tecla de acesso rápido "2".

<strong>Como voltar para a página inicial?</strong>

Para voltar para a página inicial existe um link especial na barra de  acessibilidade logo após o "Como usar o site" que pode ser alcançado  utilizando a tecla "TAB" e colocando o foco do navegador sobre ele, ou  então pode se utilizar a tecla de acesso rápido "3".

<strong>Como fazer uma busca no site?</strong>

É possível fazer uma busca pelo site utilizando o campo de busca localizado a direita do site no menu.

<strong>Como pular direto para o formulário de busca?</strong>

Para pular direto para o formulário de busca existe um link especial na barra de  acessibilidade logo após o "Como usar o site" que pode ser alcançado  utilizando a tecla "TAB" e colocando o foco do navegador sobre ele, ou  então pode se utilizar a tecla de acesso rápido "4".

<strong>Como vir para esta página?</strong>

Para vir para esta pagina existe um link especial na barra de  acessibilidade chamado "Como usar o site", ou  então pode se utilizar a tecla de acesso rápido "5".

<strong>Quais são as teclas de acesso rápido (Acesskeys)</strong><strong> para esse site?

</strong>Este site possui teclas de atalho para os seus principais links, essas teclas são acionadas utilizando a combinação de teclas do navegador mais o número do link, na frente desses links estão representados seu número entre colchetes, para facilitar o acesso a usuários videntes e não videntes. As teclas de atalho existentes nesse site seguem abaixo:
<ul>
	<li> Tecla alt+1 para ir para o menu;</li>
	<li>Tecla alt+2 para ir para o conteúdo;</li>
	<li>Tecla alt+3 para ir para a página inicial;</li>
	<li>Tecla alt+4 para ir para o formulário de busca;</li>
	<li>Tecla alt+5 para ir para esta página;</li>
</ul>
<strong>Diferença na tecla de atalho entre navegadores

</strong>No navegador Internet Explorer a tecla de atalho para utilizar os atalhos é o "alt", enquanto no navegador Firefox a tecla de atalho é "alt" + "shift". <strong>

</strong>

<strong>Padrões e Recomendações</strong>

Esse site tenta seguir os padrões e recomendações de HTML e CSS definidos pela W3C assim como as recomendações sobre acessibilidade definidos pelo WCAG e E-MAG. Porém devido algumas regras desses padrões e recomendações serem antiquadas e não práticas, e algumas técnicas novas no desenvolvimento de sites não serem contempladas por esses documentos, esse site não os segue fielmente.

<strong>Images no site:

</strong>Para um melhor uso do site por pessoas com problemas visuais e necessidades especiais, o site tem todas suas imagens descritas. Caso ache alguma imagem sem descrição, por favor, entre em contato para que possamos melhorar o acesso as informações para todos.

<strong>Uso de scripts no site:</strong>

Todo uso de javascript no site é definido a não impactar na navegação daqueles que não o possuem ou o têm desativado.

Se você tiver dificuldades em usar esse site, ou quiser mandar qualquer comentário ou observação, por favor entre em contato.';
	    
	    $insert = "INSERT INTO " . $table_name .
	        " (post_content, post_title, comment_status, ping_status, post_name, post_type, menu_order) " .
	        "VALUES ('".$text."', '".$wpdb->escape($title)."', 'closed', 'closed', '".$wpdb->escape($url_name)."', 'page', 99)";
	    
	    $results = $wpdb->query( $insert );
	    
	    add_option('WPA_DP_version', $WPA_DP_version);
	}
}

register_activation_hook(__FILE__,'WPA_DP_install');

?>