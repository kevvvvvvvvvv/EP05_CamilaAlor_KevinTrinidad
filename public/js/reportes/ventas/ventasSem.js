//Para graficar ventas semanales
document.addEventListener('DOMContentLoaded', function () {

  Highcharts.chart('graficoVentasSem', {
      chart: { type: 'line' },
       title: { text: null },
       xAxis: { 
           title: {
               text: 'Días'
           },
           categories: jsonData.dias
       },
       yAxis: { 
           title: { 
               text: 'Ganancias' 
           } 
       },
       series: [
          { 
              name: 'Pastelería', 
              data: jsonData.ventasP,
              color: '#b88a64'
          },
           
          { 
              name: 'Cafetería', 
              data: jsonData.ventasC,
              color: '#6c6c70'
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


    document.getElementById('exportarGraficoSem').addEventListener('click', function () {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const form = document.getElementById('formExportar');
        // Valores de los inputs ocultos
        const fechaInicioN = form.querySelector('input[name="fechaInicioN"]').value;
        const fechaFinN = form.querySelector('input[name="fechaFinN"]').value;
        const totalPP = form.querySelector('input[name="totalPP"]').value;
        const totalPC = form.querySelector('input[name="totalPC"]').value;
        const total = form.querySelector('input[name="total"]').value;

        const chart = Highcharts.chart('graficoVentasSem', {
            chart: { type: 'line' },
            title: { text: null },
            xAxis: {
                title: { text: 'Días' },
                categories: jsonData.dias
            },
            yAxis: {
                title: { text: 'Ganancias' }
            },
            series: [
                { name: 'Pastelería', data: jsonData.ventasP, color: '#b88a64' },
                { name: 'Cafetería', data: jsonData.ventasC, color: '#6c6c70' }
            ]
        });

        setTimeout(() => {
            // Nodo SVG generado por Highcharts
            const svgElement = document.querySelector('#graficoVentasSem svg');

            // Función para convertir el SVG a PNG y se recopilan los datos
            convertirSVGAPNG(svgElement, function(blob) {
                const formData = new FormData();
                formData.append('graficoImagenSem', blob, 'grafico_semanal.png'); // Enviamos la imagen como un Blob
                formData.append('fechaInicioN', fechaInicioN);
                formData.append('fechaFinN', fechaFinN);
                formData.append('totalPP', totalPP);
                formData.append('totalPC', totalPC);
                formData.append('total', total);
                fetch(ventassemanalesUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: formData
                })
                .then(response => response.blob())
                .then(blob => {
                    const link = document.createElement('a');
                    const url = URL.createObjectURL(blob);
                    link.href = url;
                    link.download = 'reporte_ventas_semanales.pdf';
                    link.click();
                    URL.revokeObjectURL(url);
                })
                .catch(error => console.error('Error al enviar la imagen:', error));
            });
        }, 5000); // Espera para asegurarse de que el gráfico se haya renderizado completamente
    });

});


