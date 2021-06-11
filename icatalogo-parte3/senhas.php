<?php
//criptrografa a senha 

//testando os hashs
echo md5("nina");

echo "<br> <br>";

echo sha1("nina");

echo "<br> <br>";

// ESSE DAQUI GERA UMA NOVA SENHA CADA VEZ Q A PAGINA É CARRREGADA
echo password_hash("123456", PASSWORD_DEFAULT);