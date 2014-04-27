<script type="text/javascript">
function validar(cadastrodeusuarios){
    if(cadastrodeusuarios.user_email.value.indexOf(('@' && '.'),0)== -1){
    alert("EMAIL invalido.");
    return false;
    }
if(cadastrodeusuarios.user_senha.value != cadastrodeusuarios.user_confirma.value){
    alert("Confirme sua senha!");
    return false;
    }else{
    return true;
    }
}
</script>