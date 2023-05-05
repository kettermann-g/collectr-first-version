<?php
include("configConex.php");
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

$tituloAv = $_POST['tituloObAvDigit'];
$codbarAv = $_POST['codBarAvDigit'];
$dirAv = $_POST['selecDirAv'];
$rotAv = $_POST['selecRotAv'];
$formatoAv = $_POST['selecFormatoAv'];
$distAv = $_POST['selecDistAv'];
$diaLancAv = $_POST['diaLancAv'];
$mesLancAv = $_POST['mesLancAv'];
$anoLancAv = $_POST['anoLancAv'];

$query_insert_obraAv = "INSERT INTO obraav (tituloObAv, codBarAv, idDirAv, idRotAv, idFormatoAv, idDistAv, diaLancAv, mesLancAv, anoLancAv, addUserObAv, dataObraAv) VALUES ('$tituloAv', '$codbarAv', '$dirAv', '$rotAv', '$formatoAv', '$distAv', NULLIF('$diaLancAv', ''), NULLIF('$mesLancAv', ''), NULLIF('$anoLancAv', ''), '$idUser', DATE(NOW()))";

mysqli_query($conexao, $query_insert_obraAv);
$idImagemObAv = mysqli_insert_id($conexao);

echo "<br>" . $idImagemObAv;

if(!isset($_FILES) || count($_FILES)==0){
	die("<br />ERRO: Nenhum arquivo foi enviado");
	exit; 
} else { // INICIO else 1

	var_dump($_FILES); // apresentar o conteúdo da variável de ambiente $_FILES. Isso é útil durante o desenvolvimento
	
	// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
	if ($_FILES['inputImgObAv']['error'] != 0) {
		die("<br />ERRO: Não foi possível fazer o upload do arquivo. Motivo do erro: " . $codigoErro['erros'][$_FILES['inputImgObAv']['error']]);
		exit; // Para a execução do script pois ocorreu um erro
	} else { // INICIO else 2
			
			// Verifica a extensão do arquivo
			if(!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $_FILES['inputImgObAv']['type'])) {
				die("<br />ERRO: Extensão do arquivo de imagem é inválido. Por favor, envie arquivos com as seguintes extensões: jpeg, jpg, png ou gif");
				exit;
			} else { // INICIO else 3
			
				$arquivoNomeOriginal = $_FILES['inputImgObAv']['name'];
				$tmp = explode('.',$arquivoNomeOriginal);
				$extensao = strtolower(array_pop($tmp));
				
				$arquivoNovoNome = "obraAudiovisual_".$idImagemObAv.".".$extensao;
				$arquivoCaminhoCompleto = $diretorioImagem."/".$arquivoNovoNome;
				echo "<br />Novo nome do arquivo: ".$arquivoNovoNome; // Apenas para testar
				if (move_uploaded_file($_FILES['inputImgObAv']['tmp_name'], $arquivoCaminhoCompleto)) {
					echo "<br />Arquivo de imagem válido e enviado com sucesso.";
					
					// Atualizar no tabela do banco de dados o nome do arquivo de imagem
					$sql = "UPDATE obraav SET ImagemObAv = '$arquivoNovoNome' WHERE idObAv = $idImagemObAv";
					if(mysqli_query($conexao, $sql)){
						echo "<br />Registro atualizado com sucesso no banco de dados";
						header("location: navegar_obra_audiovisual.php");
					} else {
						echo "ERRO: Não foi possível executar o comando $sql. " . mysqli_error($conexao);
					}

				} else { echo "<br />Possível ataque de upload de arquivo!"; }
			} // FIM else 3
			
	} // FIM else 2
	
} // FIM else 1
mysqli_close($conexao);
?>