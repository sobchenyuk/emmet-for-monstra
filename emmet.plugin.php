<?php

/**
 *  Emmet plugin for "textarea".
 *
 * @package Monstra
 * @subpackage Plugins
 * @author Sobchenyuk Andrey / ANDREY
 * @copyright 2016 Sobchenyuk Andrey / ANDREY
 * @version 1.0.3
 *
 */


// Register plugin
Plugin::register(__FILE__,
    __('Emmet'),
    __('Emmet plugin for "textarea".'),
    '1.0.3',
    'Sobchenyuk',
    'https://vk.com/sobcheniuk');


Action::add('admin_header', 'Emmet::EmmetJs');
Action::add('admin_header', 'Emmet::EmmetScript');


// Emmet plugin for "textarea"

class Emmet

{
    public static function EmmetJs()
    {

        echo '
        <link href="' . Option::get('siteurl') . '/plugins/emmet/lib/jquery-linedtextarea.css" type="text/css" rel="stylesheet" />
        <script src="' . Option::get('siteurl') . '/plugins/emmet/lib/jquery-linedtextarea.js"></script>
        <script src="' . Option::get('siteurl') . '/plugins/emmet/lib/emmet.min.js"></script>
        ';
    }

    public static function EmmetScript()
    {

        if (Request::get('action') == 'add_styles'|| Request::get('action') == 'edit_styles') {
            echo '<script>
         
         $(document).ready(function() {
        $("textarea#content").addClass("emmet-syntax-css lined");
        $(".source-editor.emmet-syntax-css.lined").linedtextarea(
		{selectedLine: 1}
	    );
        


        editor.setCursor(2,2);     // это значит поместить курсор на 3 строку (отсчёт от 0), символ 3

var pos=editor.posFromIndex(3);  //получить координаты 3-ей позиции (строку и символ)
editor.setCursor(pos.line,pos.ch);
         });
         
          require([\'stylesheet\', \'events\'], function(stylesheet, events){
	var _timedPub,
		indentation = \'    \',
		$editor = $(\'.CodeMirror.cm-s-mdn-like\').val(),
		style = document.createElement(\'style\');
	document.body.appendChild(style);
	stylesheet.init({
		element: style,
		indent: indentation
	});
  emmet.require(\'textarea\').setup({
    pretty_break: true,
    use_tab: true
	});
});


</script>';
        }else{
            echo("
		<script>
        emmet.require('textarea').setup({
            pretty_break: true,
            use_tab: true
                });
        </script>");
        }
    }

}


    