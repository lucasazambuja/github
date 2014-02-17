<?php

function function_contato_enviar($email, $nome, $msg, $fone, $assunto){

// Se a pessoa enviar o formulÃ¡rio pega os valores

/*if (isset($_POST['nome'])) {
	$email = $_POST['email'];
	$padrao = 'lucassouzaazambuja2@gmail.com, contato@anfitria.com.br'; // Coloque seu e-mail dentro das aspas no lugar de exemplo@email.com
	$nome = $_POST['nome'];
	$msg = $_POST['mensagem'];
	$fone = $_POST['fone'];
	$assunto = $_POST['assunto'];
        */
        $erro = '';
        $padrao = 'contato@anfitria.com.br'; // Coloque seu e-mail dentro das aspas no lugar de exemplo@email.com
	
	// Verifica se todos os campos foram preenchidos
	
	if (empty($nome) OR empty($msg) OR empty($email)) {
		$erro .= 'Por favor, preencha pelo menos os campos NOME, EMAIL e MENSAGEM! ';
	}
	
	// Verifica tags HTML em qualquer um dos campos

  if (preg_match("/<([^>]+)>/i", $nome)) {
		$erro .= "Por favor, nÃ£o utilize tags HTML no campo Nome.";
   }
   
   if (preg_match("/<([^>]+)>/i", $email)) {
		$erro .= "Por favor, nÃ£o utilize tags HTML no campo E-mail. ";
   }

   if (preg_match("/<([^>]+)>/i", $msg)) {
		$erro .= "Por favor, nÃ£o utilize tags HTML no campo Mensagem. ";
   }
   
   if (preg_match("/<([^>]+)>/i", $fone)) {
		$erro .= "Por favor, nÃ£o utilize tags HTML no campo Telefone. ";
   }
//}

// Se passar sem erros

if ($erro == '') {
	
	// Pega a data e hora do envio e o IP da pessoa
	
	$data = date('d/m/Y - H:i:s');
	
	// Cria a Mensagem
	
	$msg2 = $msg . '<br>';
	$msg2 .= 'Contato enviado por: ' . $nome . '<br>';
	$msg2 .= 'Data: ' . $data . '<br>';
	$msg2 .= 'Email: '. $email;
	
	// Envia um email de contato para o email colocado no lugar de exemplo@email.com no topo
	
	 mail($padrao, $assunto, $msg2);
	
	// Se tudo estiver correto, confirma
	
	// echo "<center><font color=\"green\" face=\"verdana\" size=\"3\">Mensagem enviada com sucesso!</font></center>";
	$result = 'Mensagem enviada com sucesso!';
} else{
    // Se der algum erro
    
   $result = $erro;
}
echo '<script>alert(\''.$result.'\');</script>';
}
?>