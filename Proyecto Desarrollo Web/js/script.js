$(document).ready(function(){
    $('#enviar').click(function(){
        var usuario = $('#usuario').val();
        var passwd = $('#passwd').val();
        
        if(usuario.length < 1){
            alert("Campo usuario vacío. Ingrese un usuario.");
        }
        if(passwd.length < 1){
            alert("Campo contraseña vacía. Ingrese una contraseña.");
        }
        
        if(usuario != 'admin' && usuario != 'asist'){
            alert("Usuario incorrecto.");
        }

        if(passwd != 'admin' && passwd != '123'){
            alert("Contraseña incorrecta.");
        }        

        if(usuario === 'admin' && passwd === 'admin'){
            alert("Sesión iniciada correctamente.");
            window.location.replace('admin/agregar.php');
        }

        if(usuario === 'asist' && passwd === '123') {
            alert("Sesión iniciada correctamente.");
            window.location.replace('asistente/indexasist.php');
        }
    });
});

