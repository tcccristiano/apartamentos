<?php include_once $_SERVER['DOCUMENT_ROOT'].'/apartamentos/includes/header.php'; ?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/apartamentos/config/config.php'; ?>

<?

if(isset($_POST['logout'])){
    session_destroy();
    header("Location: index.php");
}

?>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            consutaMensagem();
        });
        function enviaMensagem(){

            var msg = $("textarea[name=msg]").val();

            $.ajax({
                type: "POST",
                url: 'mensagem.php',
                data: { msg: msg}
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
    <form class="form-horizontal" method="post" action="">
        <div class="control-group">
            <div class="controls">
                <textarea class="form-control" rows="3" name="msg" placeholder="Escreva sua mensagem..." required ></textarea>
            </div>
        </div>
        <div class="control-group">
            <div class="cont    rols">
                <input type="button" class="bt  n btn-primary" name="enviar" onclick="enviaMensagem()" value="enviar">
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <div class="resposta" style="display:none;"></div>
            </div>
        </div>

    </form>


<? include_once 'includes/footer.php'; ?>