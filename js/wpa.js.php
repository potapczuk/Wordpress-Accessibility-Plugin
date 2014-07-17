jQuery(document).ready(function(){
    $('#acess-contraste').click(function(e)
    {
        e.preventDefault();
        $('link[@rel*=style][title=contraste]').each(function(i) 
        {
            this.disabled = false;	
        });
        createCookie('style', 'contraste', 365);
    }).blur();
    $('#acess-normal').click(function(e)
    {
        e.preventDefault();
        $('link[@rel*=style][title=contraste]').each(function(i) 
        {
            this.disabled = true;
        });
        eraseCookie('style');
    }).blur();
    $("#acess-a-mais").click(function(e){e.preventDefault();fontSize("aumentar")}).blur()
    $("#acess-a-menos").click(function(e){e.preventDefault();fontSize("diminuir")}).blur()
    $("#acess-a").click(function(e){e.preventDefault();fontSize("padrao")}).blur()
    var c = readCookie('style');
    if (c) {
        $('link[@rel*=style][title=contraste]').each(function(i) 
        {
            this.disabled = false;
        });	
    }
    
    $('#acess-alt-images').click(function(e)
    {
        e.preventDefault();
        $('img').each(function(i) 
        {
            var image = $(this);
            if(image.attr('alt').length <= 0){
                image.toggleClass('noAltText');
            }
        });
    }).blur();
});


// cookie functions http://www.quirksmode.org/js/cookies.html
function createCookie(name,value,days)
{
    if (days)
    {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}
function readCookie(name)
{
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++)
    {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name)
{
    createCookie(name,"",-1);
}

function fontSize(action, container){
    container = typeof(container) != 'undefined' ? container : "body" //se não for especificado um container será "div.texto"
    container = "body"
    baseSize = parseInt(jQuery(container).css("font-size")) //extraímos o font-size padrão, tomando como base o p do nosso container

    $fs = parseInt(jQuery(container).css("font-size"))
    if(action=="aumentar" && baseSize < 18) $fs+=2
    else if(action=="diminuir" && baseSize > 9) $fs-=2
    else if(action=="padrao") $fs=10
    jQuery(container).css("font-size", $fs)
}


//mapeamento para os atalhos funcionarem em todos os navegadores com jquery
jQuery(document).bind('keydown', 'alt+1', 
		function (){		
			document.getElementById('menustart').focus();
			}
);
jQuery(document).bind('keydown', 'alt+2', 
		function (){		
			document.getElementById('contentstart').focus();
			}
);
jQuery(document).bind('keydown', 'alt+3', 
		function (){		
			window.location="<?php echo $_GET['url']; ?>";
			}
);
jQuery(document).bind('keydown', 'alt+4', 
		function (){		
			document.getElementById('s').focus();
			}
);
jQuery(document).bind('keydown', 'alt+5', 
		function (){		
			window.location="<?php echo $_GET['url']; ?>/como-usar-o-site";
			}
);

