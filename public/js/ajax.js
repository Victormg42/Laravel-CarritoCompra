window.onload = function() {
    modal = document.getElementById('myModal');
    //read();
}

function objetoAjax() {
    var xmlhttp = false;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

/*function read() {
    console.log('read');
    var section = document.getElementById('section-3');
    var buscador = document.getElementById('searchRestaurante').value;
    var ajax = new objetoAjax();
    var token = document.getElementById('token').getAttribute('content');
    // Busca la ruta read y que sea asyncrono
    ajax.open('POST', 'readAdmin', true);
    var datasend = new FormData();
    datasend.append('filtro', buscador);
    datasend.append('_token', token);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(ajax.responseText);
            var tabla = '';
            if (respuesta.length > 0) {
                document.getElementById('footer0').style.display = "none";
                document.getElementById('footer').style.display = "block";
                for (let i = 0; i < respuesta.length; i++) {
                    tabla += '<div class="card float-left">';
                    tabla += '<img class="card-img-top img-fluid" src="data:image/png;base64,' + respuesta[i].ruta_fot + '" alt="error" style="height:60%;"></img>';
                    tabla += '<p class="card-title ml-3">' + respuesta[i].nombre_loc + '</p>';
                    tabla += '<div class="button-group">';
                    tabla += '<button onclick="borrarRestaurante(' + respuesta[i].id + ')" class="btn btn-outline-danger" style="width: 50%;">Borrar</button>';
                    tabla += '<button onclick="openModal1(' + respuesta[i].id + ',&#039;' + respuesta[i].nombre_loc + '&#039;,&#039;' + respuesta[i].direccion_loc + '&#039;,&#039;' + respuesta[i].telefono_loc + '&#039;,&#039;' + respuesta[i].email_loc + '&#039;,&#039;' + respuesta[i].web_loc + '&#039;,&#039;' + respuesta[i].precio_loc + '&#039;,&#039;' + respuesta[i].horario_loc + '&#039;)" class="btn btn-outline-secondary" style="width: 50%;">Actualizar</button>';
                    tabla += '</div>';
                    tabla += '</div>';
                }
            } else {

                document.getElementById('footer').style.display = "none";
                document.getElementById('footer0').style.display = "block";
                tabla += '<h3>0 Resultados</h3>';
            }
            if (respuesta.length < 12 && respuesta.length > 0) {
                document.getElementById('footer').style.display = "none";
                document.getElementById('footer0').style.display = "block";
            }
            section.innerHTML = tabla;
        }
    }
    ajax.send(datasend);
}*/

/*function insertarRestaurante() {
    var listatipo = document.getElementsByClassName("tipo");
    var tipo = [];
    for (let i = 0; i < listatipo.length; i++) {
        if (listatipo[i].checked) {
            tipo.push(listatipo[i].value);
        }
    }
    var ajax = new objetoAjax();
    var token = document.getElementById('token').getAttribute('content');
    var mensaje = document.getElementById('msg');
    var nombre = document.getElementById('nombre_res').value;
    var direccion = document.getElementById('direccion_res').value;
    var telefono = document.getElementById('telf_res').value;
    var email = document.getElementById('email_res').value;
    var web = document.getElementById('web_res').value;
    var precio = document.getElementById('precio_res').value;
    var horario = document.getElementById('horario_res').value;
    var image = document.getElementById('image_res');
    var img = image.files[0];
    var image1 = document.getElementById('image_menu');
    var img1 = image1.files[0];
    ajax.open('POST', 'insertarRestaurante', true);
    var datasend = new FormData();
    if (tipo.length != 0) {
        console.log(tipo);
        datasend.append('tipo', JSON.stringify(tipo));
    }
    datasend.append('nombre_res', nombre);
    datasend.append('direccion_res', direccion);
    datasend.append('telf_res', telefono);
    datasend.append('email_res', email);
    datasend.append('web_res', web);
    datasend.append('precio_res', precio);
    datasend.append('horario_res', horario);
    datasend.append('imagen', img);
    datasend.append('menu', img1);
    datasend.append('_token', token);

    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(ajax.responseText);
            if (respuesta.resultado == 'OK') {
                mensaje.innerHTML = 'Restaurante registrado correctamente';
                document.getElementById('forminsert').reset();
                closeModal();
            } else {
                mensaje.innerHTML = respuesta.resultado;
            }
            read();
        }
    }
    ajax.send(datasend);
}*/

/*function borrarRestaurante(id) {
    var ajax = new objetoAjax();
    var mensaje1 = document.getElementById('mensaje1');
    var token = document.getElementById('token').getAttribute('content');
    ajax.open('POST', 'borrarRestaurante', true);
    var datasend = new FormData();
    datasend.append('id', id);
    datasend.append('_token', token);

    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(ajax.responseText);
            if (respuesta.resultado == 'OK') {
                mensaje1.innerHTML = 'Restaurante eliminado correctamente';
            } else {
                mensaje1.innerHTML = respuesta.resultado;
            }
            read();
        }
    }
    ajax.send(datasend);
}*/

/*function updateRestaurante() {
    var ajax = new objetoAjax();
    var mensaje1 = document.getElementById('msg1');
    var token = document.getElementById('token').getAttribute('content');
    var id = document.getElementById('id_restaurante').value;
    var nombre = document.getElementById('nom_restaurante').value;
    var direccion = document.getElementById('direccion_restaurante').value;
    var telf = document.getElementById('telf_restaurante').value;
    var email = document.getElementById('email_restaurante').value;
    var web = document.getElementById('web_restaurante').value;
    var precio = document.getElementById('preciomedio_restaurante').value;
    var horario = document.getElementById('horario_restaurante').value;

    var image = document.getElementById('file_foto');
    var images = document.getElementById('file_foto').value;
    if (images != "") {
        var img = image.files[0];
    }

    var imagemenu = document.getElementById('file_menu');
    var imagesmenu = document.getElementById('file_menu').value;
    if (imagesmenu != "") {
        var imgmenu = imagemenu.files[0];
    }
    ajax.open('POST', 'updateRestaurante', true);
    var datasend = new FormData();
    datasend.append('id_restaurante', id);
    datasend.append('nom_restaurante', nombre);
    datasend.append('direccion_restaurante', direccion);
    datasend.append('telf_restaurante', telf);
    datasend.append('email_restaurante', email);
    datasend.append('web_restaurante', web);
    datasend.append('precio_restaurante', precio);
    datasend.append('horario_restaurante', horario);
    if (images != "") {
        datasend.append('file_foto', img);
        datasend.append('file', true);
    }
    if (imagesmenu != "") {
        datasend.append('file_menu', imgmenu);
        datasend.append('filemenu', true);
    }
    datasend.append('_token', token);

    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(ajax.responseText);
            if (respuesta.resultado == 'OK') {
                mensaje1.innerHTML = 'Restaurante actualizado correctamente';
                closeModal1();
            } else {
                mensaje1.innerHTML = respuesta.resultado;
            }
            read();
        }
    }
    ajax.send(datasend);
}*/

function openModal() {
    modal.style.display = "block";
}

function closeModal() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}