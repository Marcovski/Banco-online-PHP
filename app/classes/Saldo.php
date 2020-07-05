<?php

namespace app\classes;
use app\classes\Extrato;
class Saldo
{
    private $path;
    private $saldo;
    public function __construct()
    {
        $cpf = $_SESSION['cpf'] ?? null;

        $this->path = DATA_PATH . '/' . trataCPF($cpf) . '/saldo.txt';
         if(file_exists($this->path)){
            $this->saldo = ler($this->path);
         }else{
             gravar($this->path, '0', 'w+');
         }
    }

    public function depositando($valor){

        $valor = str_replace([','],'.',$valor);

        $valor = number_format($valor, 2, '.','');
        
        $soma= number_format($valor + $this->saldo,2, '.','');

        gravar($this->path,$soma);
        $mensagemExtrato = 'Deposito de <span style="color:rgb(53, 102, 236);font-weight:bold;">R$ ' . $valor . '</span>' . '@';
        (new Extrato())->setExtrato($mensagemExtrato);
        header('Location: ' . BASE . '?url=saldo');
    }
    
    public function getSaldo(){
        return $this->saldo;

    }

    public function sacar($valor){

        $valor = str_replace([','],'.',$valor);

        $valor = number_format($valor, 2, '.','');
        
        $subtrai= number_format($this->saldo - $valor ,2, '.','');

        

        gravar($this->path,$subtrai);

        $mensagemSaque = 'Saque de <span style="color:rgb(218, 5, 5);font-weight:bold;">R$ ' . $valor . '</span>' . '@';
        (new Extrato())->setExtrato($mensagemSaque);
        header('Location: ' . BASE . '?url=saldo');
    }


    
}