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

        if (Request::get('action') == 'add_styles') {
            echo '<script>

$(document).ready(function() {
        $("textarea#content").addClass("emmet-syntax-css lined").css("display","block");
        $(".CodeMirror.cm-s-mdn-like").css("display","none");
        $(".source-editor.emmet-syntax-css.lined").linedtextarea(
		{selectedLine: 1}
	    );
         });
         
         require([\'stylesheet\', \'events\'], function(stylesheet, events){
	var _timedPub,
		indentation = \'    \',
		
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
	var texthandler = function(e){
		if(_timedPub !== false){
			window.clearTimeout(_timedPub);
		}
		_timedPub = window.setTimeout(function(){
			events.publish(\'/push/rules\', $editor.val());
      _timedPub = false;
		}, 500);
	};
	events.subscribe(\'/push/rules\', function(val){
		stylesheet.setString(val);
	});
	$editor.on(\'keydown\', texthandler);
	/* Only here to show that the indentation rule is flexible */
  events.publish(\'/push/rules\', $editor.val());
	$(\'input[name=\"indent\"]\').val(indentation),
	$(\'button[name=\"update\"]\').on(\'click\', function(){
		indentation = $(\'input[name=\"indent\"]\').val().replace(\'\\t\',\'\t\');
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


    