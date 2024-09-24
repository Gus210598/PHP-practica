function mayusculas(variableLocal) {
    variableLocal.value = variableLocal.value.toUpperCase();
}

function ver() {
    var valorIngreasado = document.getElementById("ahora").value;
    document.getElementById("ahora").innerHTML = "YOU CLICKED ME!";
    alert("Pasaste al fin");
}


function validaFormulario() {
    var valorIngreasado = document.getElementById('clave').value;
    if (valorIngreasado.length < 3) {
        alert("La clave debe tener mínimo 3 y máximo de 15 caracteres " + valorIngreasado.length);
        return false;
    }
    var valorIngreasado = document.getElementById('clave1').value;
    if (valorIngreasado.length < 3) {
        alert("La clave debe tener mínimo 3 y máximo de 15 caracteres " + valorIngreasado.length);
        return false;
    }
    var valorIngreasado1 = document.getElementById('clave').value;
    var valorIngreasado2 = document.getElementById('clave1').value;
    if (valorIngreasado1 != valorIngreasado2) {
        alert("Las claves ingresadas son diferentes");
        return false;
    }
    return true;
}

function validaFormularioCrear() {
    var valorIngreasado = document.getElementById('nombreUsuario').value;
    if (valorIngreasado.length < 3) {
        alert("Nombre de usuario debe tener mínimo 3 y máximo de 15 caracteres " + valorIngreasado.length);
        return false;
    }
    var valorIngreasado = document.getElementById('clave1').value;
    if (valorIngreasado.length < 3) {
        alert("Clave debe tener mínimo 3 y máximo de 10 caracteres " + valorIngreasado.length);
        return false;
    }
    var valorIngreasado = document.getElementById('clave2').value;
    if (valorIngreasado.length < 3) {
        alert("Clave debe usuario debe tener mínimo 3 y máximo de 10 caracteres " + valorIngreasado.length);
        return false;
    }
    var valorIngreasado1 = document.getElementById('clave1').value;
    var valorIngreasado2 = document.getElementById('clave2').value;
    if (valorIngreasado1 != valorIngreasado2) {
        alert("Las claves ingresadas son diferentes");
        return false;
    }
    if (!document.querySelector('input[name="tipoUsuario"]:checked')) {
        alert('Error, Selecciona un tipo usuario');
        return false;
    }

    return true;
}

function validaRadio() {
    if (!document.querySelector('input[name="turno"]:checked')) {
        alert('Error, Selecciona un turno');
        return false;
    }

    var valorIngreasado = document.getElementById('fechaProcesar').value;

    if (valorIngreasado == null || valorIngreasado == 0) {
        alert("Corregir la fecha no puede ir en blanco ");
        return false;
    }
    return true;
}