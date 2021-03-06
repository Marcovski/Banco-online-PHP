<?php

date_default_timezone_set('America/Sao_Paulo');

//Pasta na qual o projeto está hospedado
define('BASE', '/banco-online/');

//Pasta onde os arquivos vão ser salvos
define('DATA_PATH', 'dados');

//?url=saldo
//'URL' => 'Controladora@Método'
$router = [
    //View
    'home' => 'ContaController@home',
    'saldo' => 'ContaController@saldo',
    'extrato' => 'ContaController@extrato',
    'deposito' => 'ContaController@deposito',
    'saque' => 'ContaController@saque',
    'cadastro' => 'LoginController@cadastro',
    'ainvalido'=>'LoginController@ainvalido',
    //INTERNAL
    'auth' => 'LoginController@auth',
    'sair' => 'LoginController@logout',
    'register' => 'LoginController@register',
    //INTERNAL CONTA
    'depositar' =>'ContaController@depositar',


];
