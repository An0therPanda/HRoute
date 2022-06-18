var datos = localStorage.info == null ? [] : JSON.parse(localStorage.info);

const getIdTraslado = () => {
    return datos.length == 0 ? 1 : datos[datos.length - 1].idTraslado + 1;
}

const guardarDatos = () => {
    localStorage.info = JSON.stringify(datos);
}

let guardar = () => {
    let origen = document.querySelector("#oriTraslado").value;
    let destino = document.querySelector("#desTraslado").value;
    let tipo = document.querySelector("#tipoTraslado").value;
    let trabajador = document.querySelector("#trabajadorTraslado").value;
    let nomPer = document.querySelector("#nomPersonal").value;
    let nomPac = document.querySelector("#nomPaciente").value;

    datos.push({
        'idTraslado' : getIdTraslado(),
        'origen' : origen,
        'destino' : destino,
        'tipo' : tipo,
        'nomPer' : nomPer,
        'nomPac' : nomPac,
        'trabajador' : trabajador,
    });

    guardarDatos();

    listar();
}

let listar = () => {
    let tabla = $("#tblDatos");
    tabla.html("");
    datos.forEach(element => {
        tabla.append (`
            <tr>
                <td>${element.idTraslado}</td>
                <td>${element.origen}</td>
                <td>${element.destino}</td>
                <td>${element.tipo}</td>
                <td>${element.nomPer}</td>
                <td>${element.nomPac}</td>
                <td>${element.trabajador}</td>
                <td><button class="btn btn-primary" onclick="editar(${element.idTraslado})">Editar</button></td> 
                <td><button class="btn btn-danger" onclick="eliminar(${element.idTraslado})">Eliminar</button></td>   
            </tr>
        `);
    });
}

let editar = (idTras) => {
    let origen = $("#oriTraslado");
    let destino = $("#desTraslado");
    let tipo = $("#tipoTraslado");
    let trabajador = $("#trabajadorTraslado");
    let nomPer = $("#nomPersonal");
    let nomPac = $("#nomPaciente");
    let id = $("#txtId");

    let btnGuardar = $("#btnGuardar");
    let btnModificar = $("#btnModificar");

    let resultado = datos.find(e => e.idTraslado == idTras);
    let resultadoIndex = datos.findIndex(e => e.idTraslado == idTras);

    if(resultado != undefined){
        btnGuardar.hide();
        btnModificar.show();

        origen.val(resultado.origen);
        destino.val(resultado.destino);
        tipo.val(resultado.tipo);
        trabajador.val(resultado.trabajador);
        nomPer.val(resultado.nomPer);
        nomPac.val(resultado.nomPac);

        id.val(resultadoIndex);
    }else{
        alert("No lo encontro");
    }
}


let modificar = () => {
    let origen = $("#oriTraslado").val();
    let destino = $("#desTraslado").val();
    let tipo = $("#tipoTraslado").val();
    let trabajador = $("#trabajadorTraslado").val();
    let nomPer = $("#nomPersonal").val();
    let nomPac = $("#nomPaciente").val();
    let id = $("#txtId").val();
    let num = parseInt(id);

    let btnGuardar = $("#btnGuardar");
    let btnModificar = $("#btnModificar");

    datos[id].origen = origen;
    datos[id].destino = destino;
    datos[id].tipo = tipo;
    datos[id].trabajador = trabajador;
    datos[id].nomPer = nomPer;
    datos[id].nomPac = nomPac;

    btnGuardar.show();
    btnModificar.hide();

    guardarDatos();

    listar();

    alert("Se modifico");
}


let eliminar = (idTras) => {
    let resultadoIndex = datos.findIndex(e => e.idTraslado == idTras);

    if(resultadoIndex != -1){

        datos.splice(resultadoIndex, 1);

        guardarDatos();

        listar();
    }else{
        alert("No lo encontro");
    }
}