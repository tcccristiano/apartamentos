<?php include_once $_SERVER['DOCUMENT_ROOT'].'/apartamentos/includes/header.php'; ?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/apartamentos/config/config.php'; ?>

<?

if(isset($_POST['logout'])){
    session_destroy();
    header("Location: index.php");
}

$apartamento = new apartamentos();

$condominio = $apartamento->listarApartamento($_SESSION['apartamentoId']);

?>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            consutaMensagem();
        });
        function enviaMensagem(){

            var msg = $("textarea[name=mensagem]").val();
            $.ajax({
                type: "POST",
                url: 'mensagem.php',
                data: { mensagem: msg}
            }).done(function( msg ) {
                    consutaMensagem();
                    $('.resposta').html(msg).css('display', 'block');
                });
        }

        function consutaMensagem(){
            $.ajax({
                type: "POST",
                url: 'mensagem.php'
            }).done(function( msg ) {
                    $('.resposta').html(msg).css('display', 'block');
                });
        }

        setInterval(function(){
            consutaMensagem();
        }, 20000);

    </script>



    <body>
    <div class="container">
        <div class="hero-unit">
<!--            <h1>Olá, --><?// echo $_SESSION['nome']; ?><!--</h1>-->
            <h1>Condomínio <? echo $condominio['nome']; ?></h1>
            <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
        </div>
    <form class="form-horizontal" method="post" action="">
        <div class="control-group">
            <div class="controls">
                <textarea style="width: 75%;" class="form-control" rows="3" name="mensagem" placeholder="Escreva uma mensagem aos condôminos..." required ></textarea>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <input type="button" class="btn btn-primary" name="enviar" onclick="enviaMensagem()" value="Enviar">
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <div class="resposta" style="display:none;"></div>
            </div>
        </div>

    </form>


<? include_once 'includes/footer.php'; ?>