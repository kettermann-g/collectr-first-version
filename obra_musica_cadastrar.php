<?php

include("configConex.php");

$BDtabela = "obramu";
session_start();
$userSessao = $_SESSION['username'];
$idUser = $_SESSION['iduser'];

$extensoesAceitas = array("jpeg", "jpg", "png", "gif");

$diretorioImagem = 'C:\wamp\www\collectr\imagens';

$codigoErro['erros'][0] = 'Não houve erro';
$codigoErro['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
$codigoErro['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
$codigoErro['erros'][3] = 'O upload do arquivo foi feito parcialmente';
$codigoErro['erros'][4] = 'Não foi feito o upload do arquivo';

$tituloObMu = $_POST['nomeArMuDigit'];
$idArMu = $_POST['selecArDB'];
$codBar = $_POST['codBar'];
$idTipoMu = $_POST['selecTipoDB'];
$idFormatoMu = $_POST['selecFormatoDB'];
$labelMu = $_POST['nomeLabel'];
$diaLanc = $_POST['diaLanc'];
$mesLanc = $_POST['mesLanc'];
$anoLanc = $_POST['anoLanc'];

$query_insert_obMu = "INSERT INTO obramu (tituloObMu, idArMu, IDformatoMu, IDtipoMu, codBarMu, labelMu, diaLancObMu, mesLancObMu, anoLancObMu, addUserObMu, dataObraMu) VALUES ('$tituloObMu', '$idArMu', '$idFormatoMu', '$idTipoMu', '$codBar', '$labelMu', NULLIF('$diaLanc', ''), NULLIF('$mesLanc', ''), NULLIF('$anoLanc', ''), '$idUser', DATE(NOW())) ";

mysqli_query($conexao, $query_insert_obMu);
echo "Log realizado com sucesso <br>";
$idImagemObMu = mysqli_insert_id($conexao);



if(!isset($_FILES) || count($_FILES)==0){
	die("<br />ERRO: Nenhum arquivo foi enviado");
	exit; 
} else { // INICIO else 1

	var_dump($_FILES); // apresentar o conteúdo da variável de ambiente $_FILES. Isso é útil durante o desenvolvimento
	
	// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
	if ($_FILES['inputImgObMu']['error'] != 0) {
		die("<br />ERRO: Não foi possível fazer o upload do arquivo. Motivo do erro: " . $codigoErro['erros'][$_FILES['inputImgObMu']['error']]);
		exit; // Para a execução do script pois ocorreu um erro
	} else { // INICIO else 2
			
			// Verifica a extensão do arquivo
			if(!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $_FILES['inputImgObMu']['type'])) {
				die("<br />ERRO: Extensão do arquivo de imagem é inválido. Por favor, envie arquivos com as seguintes extensões: jpeg, jpg, png ou gif");
				exit;
			} else { // INICIO else 3
			
				$arquivoNomeOriginal = $_FILES['inputImgObMu']['name'];
				$tmp = explode('.',$arquivoNomeOriginal);
				$extensao = strtolower(array_pop($tmp));
				
				$arquivoNovoNome = "obraMusica_".$idImagemObMu.".".$extensao;
				$arquivoCaminhoCompleto = $diretorioImagem."/".$arquivoNovoNome;
				echo "<br />Novo nome do arquivo: ".$arquivoNovoNome; // Apenas para testar
				if (move_uploaded_file($_FILES['inputImgObMu']['tmp_name'], $arquivoCaminhoCompleto)) {
					echo "<br />Arquivo de imagem válido e enviado com sucesso.";
					
					// Atualizar no tabela do banco de dados o nome do arquivo de imagem
					$sql = "UPDATE obramu SET imagemObMu = '$arquivoNovoNome' WHERE IDobm = $idImagemObMu";
					if(mysqli_query($conexao, $sql)){
						echo "<br />Registro atualizado com sucesso no banco de dados";
						header("location: navegar_obra_musica.php");
					} else {
						echo "ERRO: Não foi possível executar o comando $sql. " . mysqli_error($conexao);
					}

				} else { echo "<br />Possível ataque de upload de arquivo!"; }
			} // FIM else 3
			
	} // FIM else 2
	
} // FIM else 1
mysqli_close($conexao);
?>