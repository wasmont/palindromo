<?php

    /**
     * This is the summary for a DocBlock. Utilizando o PHP Documentor***
     *
     * Esta é a minha implementação do Desafio referente
     * a verificação quando uma palavra uma string é um palíndromo / 
     * verifica-se também se um número também seja um palíndromo
     *
     * @author  Washington do Nascimento Monteiro <wasmont@gmail.com>
     *
     * @since 1.0
     *
     * @param string $palavra texto informado através do usuário.
     */

    interface TextoUsuario{
        function textoReverso(String $string) : String;
        function numeroReverso(int $valor) : String;
    };

    class Palindromo implements TextoUsuario
    {
        
        function textoReverso(String $texto) : String {

            $textoTratado = strtolower(trim($texto));
            if (strrev($textoTratado) == $textoTratado){ 
                return "O texto informado: $texto <br>SIM é um Palíndromo"; 
            }
            return "O texto informado: $texto <br>NÃO é um Palíndromo"; 

        }

        function numeroReverso(int $valor): String
        {
            $valorOriginal = $valor; 
            $reverso = 0; 

            while (floor($valorOriginal)) { 
                
                // O valor dividido por 10 sempre terá o resto com o mesmo valor do último digito do número informado como Resto da divisão
                $numero = $valorOriginal % 10; 
                // Muda a posição do numero (*Reverso*)
                $reverso = $reverso * 10 + $numero; 

                $valorOriginal = $valorOriginal/10;
            } 

            if ($reverso == $valor){ 
                return "O número informado: $valor <br>SIM é um Palíndromo"; 
            }
            return "O número informado: $valor <br>NÃO é um Palíndromo"; 

        }

    };



    //Consumo da interface - Palindromo
    class FormularioUsu extends Palindromo{

        protected $stringUsu;

        function __construct(String $string)
        {
            $this->stringUsu = $string;
        }

        function validarTipo () : String
        {
            $resultado = "";
            $tipoString = is_numeric ($this->stringUsu) ? true : false;
            
            if($tipoString) {

                $resultado = $this->numeroReverso($this->stringUsu);
            } else
                $resultado = $this->textoReverso($this->stringUsu);
            
            return $resultado;

        }
    }

    /*** Formulário para receber o valor/string informado através do usuário ***/
    $action = (isset($_REQUEST['validar-palindromo'] )) ? $_REQUEST['validar-palindromo']  : '';
    $string = (isset($_POST['valor'])) ? $_POST['valor'] : '';
    $resultado = "";
    if(!empty($string)) {

        $obj = new FormularioUsu($string);
        $resultado = $obj->validarTipo();
        $_GET['Resultado'] = $resultado;

    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <title>Desafio verificar se um Palíndromo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>

        <h2 class="centralizado">Verificar Palíndromo</h2>

        <form class="formulario" action="index.php?action=validar-palindromo" method=POST>
            <div class="form-group">
                <label for="valor">Verificar se é um Palíndromo informe o valor:</label>
                <input type="text" class="form-control" id="valor" name="valor" placeholder="Digite o valor...">
            </div>
            <div class="form-group verificar">
                <button type="submmit" class="btn btn-primary">Verificar</button>
            </div>
        </form>

        <div class="form-group resultado">
            <label for="resultado" class="borda">&nbsp;<?= !empty($_GET['Resultado']) ? $_GET['Resultado'] : "Washington Monteiro @2023" ?>&nbsp;</label>
        </div>

        <script src="" async defer></script>
    </body>
</html>

<style>
    .centralizado{
        text-align: center;
        margin-bottom: 2%;
    }

    .formulario{
        padding-left: 20px;
        padding-right: 20px;
    }

    .verificar{
        margin-top: 2%;
    }

    .resultado{
        margin-top: 3%;
        font-weight: bold; 
        text-align: center;
    }

    .borda{
        border:solid 1px;
        /*border-radius:20px;*/
        margin-left: 3px;
        background-color: bisque;
    }
</style>
