
//Para graficar ventas mensuales
document.addEventListener('DOMContentLoaded', function () {

    jsonData.cantidad = jsonData.cantidad.map(Number);


    Highcharts.chart('graficoEmpleadosMen', {
        chart: { type: 'column' },
            title: { text: null },
            xAxis: { 
                title: {
                    text: 'Empleados'
                },
                categories: jsonData.empleados
            },
            yAxis: { 
                title: { 
                    text: 'Cantidad vendida' 
                } 
            },
            series: [
                { 
                    name: 'Cantidad vendida', 
                    data: jsonData.cantidad.map((cantidad, index) => ({
                        y: cantidad,
                        color: ['#9d523b', '#b88a64', '#d4b398'][index % 3]
                    })),
                    showInLegend: false
                }
            ]
    });

    function convertirSVGAPNG(svgElement, callback) {
        var canvas = document.createElement('canvas');
        var ctx = canvas.getContext('2d');
        var svgData = new XMLSerializer().serializeToString(svgElement);
        var img = new Image();

        // Crear un Blob con el contenido SVG
        var svgBlob = new Blob([svgData], {type: 'image/svg+xml'});
        var url = URL.createObjectURL(svgBlob);

        img.onload = function() {
            // Ajusta el tamaño del canvas al tamaño de la imagen cargada
            canvas.width = img.width*2;
            canvas.height = img.height*2;

            ctx.drawImage(img, 0, 0);
            var pngData = canvas.toDataURL('image/png'); // Imagen en formato PNG

            // Convierte el PNG a un Blob
            var byteString = atob(pngData.split(',')[1]); // Decodifica base64 a binario
            var arrayBuffer = new ArrayBuffer(byteString.length);
            var uintArray = new Uint8Array(arrayBuffer);
            for (var i = 0; i < byteString.length; i++) {
                uintArray[i] = byteString.charCodeAt(i);
            }
            var blob = new Blob([uintArray], {type: 'image/png'}); // Crea el Blob de la imagen PNG
            callback(blob); // Pasa el Blob al callback
        };

        img.src = url;
    }

    document.getElementById('exportarGraficoMen').addEventListener('click', function() {
        event.preventDefault();
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        //Datos del formulario
        const form = document.getElementById('formEmpleado');

        const nombreMes = form.querySelector('input[name="nombreMes"]').value;
        const year = form.querySelector('input[name="year"]').value;
        const empMasVentas = form.querySelector('input[name="empMasVentas"]').value;
        const empMasCant = form.querySelector('input[name="empMasCant"]').value;

        jsonData.cantidad = jsonData.cantidad.map(Number);
    
        var chart = Highcharts.chart('graficoEmpleadosMen', {
            chart: { type: 'column' },
                title: { text: null },
                xAxis: { 
                    title: {
                        text: 'Empleados'
                    },
                    categories: jsonData.productos
                },
                yAxis: { 
                    title: { 
                        text: 'Cantidad vendida' 
                    } 
                },
                series: [
                    { 
                        name: 'Cantidad vendida', 
                        data: jsonData.cantidad.map((cantidad, index) => ({
                            y: cantidad,
                            color: ['#9d523b', '#b88a64', '#d4b398'][index % 3]
                        })),
                        showInLegend: false
                    }
                ]
        });
    
        setTimeout(() => {
            
            const svgElement = document.querySelector('#graficoEmpleadosMen svg'); 

            convertirSVGAPNG(svgElement, function(blob){

                const formData = new FormData();

                formData.append('graficoImagenMen', blob, 'grafico_mensual.png'); // Enviamos la imagen como un Blob
                formData.append('nombreMes', nombreMes);
                formData.append('year', year);
                formData.append('empMasVentas', empMasVentas);
                formData.append('empMasCant', empMasCant);

                fetch(empleadomesUrl,{
                    method: 'POST',
                    headers:{
                        'X-CSRF-TOKEN':csrfToken
                    },
                    body:formData
                })
                .then(response => {
                    return response.blob();
                })
                .then(blob => {
                    const link = document.createElement('a');
                    const url = URL.createObjectURL(blob);
                    link.href = url;
                    link.download = 'reporte_empleados_mensuales.pdf'; // Nombre del archivo
                    link.click();
                    URL.revokeObjectURL(url);
                })
                .catch(error => console.error('Error al enviar la imagen:', error));
            }); 
        },5000);
    });
});


