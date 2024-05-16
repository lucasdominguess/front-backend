<?php
// Senha a ser criptografada
$senha = '$2y$10$fGIRKYHh.LycrXwepKLqyeG.CYA08S0zbNoF.iRWXdxLkNYpkSwfq';

// Criptografar a senha
$senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

// Exibir a senha criptografada
echo 'Senha criptografada:', $senhaCriptografada;

// Verificar se a senha digitada corresponde à senha criptografada
if (password_verify($senha, $senhaCriptografada)) {
    echo 'Senha correta!';
} else {
    echo 'Senha incorreta!';
}
