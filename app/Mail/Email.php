<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    // Função construtora
    public function __construct($data)
    {
        // Recebe os dados e os converte para uma variável da classe
        $this->data = $data;
    }

    public function build()
    {
        // Retorna o email formatado
        return $this->from('API_Teste@teste.com')->subject($this->data['titulo'])->view('email_template')->with('data', $this->data);
    }
}
