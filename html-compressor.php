<?php
/*
Plugin Name: HTML Compressor
Description: Minifica o HTML gerado pelo WordPress automaticamente.
Version: 1.0
Author: Seu Nome
*/

if (!defined('ABSPATH')) exit; // Segurança: impede acesso direto

class HTML_Compressor {

    public function __construct() {
        add_action('get_header', [$this, 'start_buffer']);
    }

    public function start_buffer() {
        ob_start([$this, 'compress_html']);
    }

    public function compress_html($buffer) {
        // Remove comentários HTML (exceto IE conditionals)
        $buffer = preg_replace('/<!--(?!\[if).*?-->/', '', $buffer);

        // Remove tabs, quebras de linha e espaços múltiplos
        $buffer = preg_replace('/\s{2,}/', ' ', $buffer);
        $buffer = str_replace(["\n", "\r", "\t"], '', $buffer);

        return $buffer;
    }
}

new HTML_Compressor();
