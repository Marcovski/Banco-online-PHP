<?php

namespace app\controller;

use app\core\Controller;

class loginController extends Controller
{
    //#### VIEW ####
    public function login()
    {
        $this->view('externa/login');
    }

    /**
     * Carrega a view para cadastrar um usuário
     *
     * @return void
     */
    public function cadastro()
    {
        $this->view('externa/cadastro');
    }

    public function ainvalido()
    {
        $this->view('externa/registro', [
            'situacao' => ' Acesso negado.'
        ]);
    }

    //#### INTERNAL ####
    public function auth()
    {
        $cpf = filter_input(INPUT_POST, 'txtCpf',FILTER_SANITIZE_STRING);
        $dirPath = DATA_PATH . '/' . trataCPF($cpf);

        if(!validaCPF($cpf)){
            $this->view('externa/registro', [
                'situacao' => ' Cpf não encontrado.'
            ]);
            return;
        }

        $filename = $dirPath . '/dados.txt';
        $data = json_decode(ler($filename));

        session_start();
        $_SESSION['logado'] = true;
        $_SESSION['cpf'] = trataCPF($data->cpf);

        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        setcookie('user_name', $data->nome, time() + 3600, '/');
        header('Location: ' . BASE . '?url=home');

    }

    public function register()
    {
        $formData = (object) [
            'nome' => filter_input(INPUT_POST, 'txtNome', FILTER_SANITIZE_STRING),
            'cpf' => filter_input(INPUT_POST, 'txtCpf', FILTER_SANITIZE_STRING),
            'email' => filter_input(INPUT_POST, 'txtEmail', FILTER_SANITIZE_EMAIL),
            'nascimento' => filter_input(INPUT_POST, 'txtNascimento', FILTER_SANITIZE_STRING)
        ];

        //dd($formData);
        if (!$this->validate($formData)) {
            //Exibir mensagem, cria tela...
            return;
        }

        //dados/128411891891
        $dirPath = DATA_PATH . '/' . trataCPF($formData->cpf);

        if (is_dir($dirPath)) {
            $this->view('externa/registro', [
                'situacao' => ' Ja cadastrado.'
            ]);
        } else if (!is_dir($dirPath)) {
            $this->view('externa/registro', [
                'situacao' => 'Cadastrado com sucesso'
            ]);
        }

        criarDiretorio($dirPath);

        //dados/128411891891/dados.txt
        $path = $dirPath . '/dados.txt';

        gravar($path, json_encode($formData));
    }

    private function validate($formData)
    {
        if (!validaCPF($formData->cpf)) {
            return false;
        }

        if (strlen($formData->nome) < 5 || strlen($formData->nome) > 50) {
            return false;
        }

        if (strlen($formData->email) < 5 && strlen($formData->email) > 50 || !preg_match('/.+@\w+\..+/', $formData->email)) {
            return false;
        }

        if (!preg_match('/^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/', $formData->nascimento)) {
            return false;
        }
        return true;
    }

    public function logout()
    {
        session_start();
        if (isset($_SESSION['logado'])) {
            session_destroy();
        }

        header('Location: ' . BASE);
    }
}
