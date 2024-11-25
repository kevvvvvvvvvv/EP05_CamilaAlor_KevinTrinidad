
// Función para mostrar el formulario correspondiente
function mostrarFormulario() {
    document.querySelectorAll('.formulario').forEach(form => form.style.display = 'none');
    
    if (document.getElementById('btnradio1').checked) {
        document.getElementById('formulario1').style.display = 'block';
    }
}

// Evento cuando cambia el estado de los botones de radio
document.querySelectorAll('input[name="btnradio"]').forEach(radio => {
  radio.addEventListener('change', mostrarFormulario);
});

// Mostrar el primer formulario por defecto
mostrarFormulario();


