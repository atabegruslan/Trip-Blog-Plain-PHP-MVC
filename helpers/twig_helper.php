<?php

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Twig\Lexer;
use Twig\TwigFilter;

function get_twig()
{
	$loader = new FilesystemLoader('views');
	$twig   = new Environment($loader);

	$md5Filter = new TwigFilter('md5', function($string) {
		return md5($string);
	});

	$twig->addFilter($md5Filter);

	$lexer = new Lexer($twig, [
	    'tag_comment'   => ['{#', '#}'],
	    'tag_block'     => ['{%', '%}'],
	    'tag_variable'  => ['{{', '}}'],
	    'interpolation' => ['#{', '}'],
	]);

	$twig->setLexer($lexer);

    return $twig;
}