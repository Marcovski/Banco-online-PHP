<?php

namespace app\controller;

use app\core\Controller;
use app\classes\Saldo;
use app\classes\Extrato;


class ContaController extends Controller
{
    private $extrato;
    private $saldo;
    public function __construct()
    {
        //Habilita segurança nesses módulos
        security();

        $this->saldo = new Saldo();
        $this->extrato = new Extrato();
    }

    //#### VIEW ####
    public function home()
    {
        $this->view('interna/home');
    }

    public function saldo()
    {
        $this->view('interna/saldo', [
           'saldo' => $this->saldo->getSaldo(),
           ]);
        }
        
        public function extrato()
        {
          $extrato = str_replace('@', '<br>', (new \app\classes\Extrato())->getExtrato());
            $this->view('interna/extrato', [
                'extrato' => $extrato, 
            ]);
        }
        
        public function deposito()
        {
            $this->view('interna/deposito',[
                'saldo' => (new \app\classes\Saldo())->getSaldo()
            ]);
        }
        
        public function saque()
        {
        $this->view('interna/saque',[
            'saldo' => (new \app\classes\Saldo())->getSaldo()
        ]);
    }
    
    //#### INTERNAL ####
    
    public function depositar()
    {
        $valor = filter_input(INPUT_POST,'txtValor',FILTER_SANITIZE_STRING);
        $this->saldo->depositando($valor);
        
    }
}
