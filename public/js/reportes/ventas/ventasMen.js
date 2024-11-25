//Para graficar ventas mensuales
document.addEventListener('DOMContentLoaded', function () {

  Highcharts.chart('graficoVentasMen', {
      chart: { type: 'line' },
       title: { text: null },
       xAxis: { 
           title: {
               text: 'Días'
           },
           categories: jsonDataMen.dias
       },
       yAxis: { 
           title: { 
               text: 'Ganancias' 
           } 
       },
       series: [
          { 
              name: 'Pastelería', 
              data: jsonDataMen.ventasP,
              color: '#b88a64'
          },
           
          { 
              name: 'Cafetería', 
              data: jsonDataMen.ventasC,
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

    document.getElementById('exportarGraficoMen').addEventListener('click', function() {
        event.preventDefault();
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        //Datos del formulario
        const form = document.getElementById('formMensual');
        
        const nombreMes = form.querySelector('input[name="nombreMes"]').value;
        const year = form.querySelector('input[name="year"]').value;
        const totalPP = form.querySelector('input[name="totalPP"]').value;
        const totalPC = form.querySelector('input[name="totalPC"]').value;
        const total = form.querySelector('input[name="total"]').value;

        const chart =   Highcharts.chart('graficoVentasMen', {
            chart: { type: 'line' },
             title: { text: null },
             xAxis: { 
                 title: {
                     text: 'Días'
                 },
                 categories: jsonDataMen.dias
             },
             yAxis: { 
                 title: { 
                     text: 'Ganancias' 
                 } 
             },
             series: [
                { 
                    name: 'Pastelería', 
                    data: jsonDataMen.ventasP,
                    color: '#b88a64'
                },
                 
                { 
                    name: 'Cafetería', 
                    data: jsonDataMen.ventasC,
                    color: '#6c6c70'
                }
             ]
         });

        setTimeout(() => {
            
            const svgElement = document.querySelector('#graficoVentasMen svg'); 

            convertirSVGAPNG(svgElement, function(blob){

                const formData = new FormData();

                formData.append('graficoImagenMen', blob, 'grafico_mensual.png'); // Enviamos la imagen como un Blob
                formData.append('nombreMes', nombreMes);
                formData.append('year', year);
                formData.append('totalPP', totalPP);
                formData.append('totalPC', totalPC);
                formData.append('total', total);


                fetch(ventasmensualesUrl,{
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
                    link.download = 'reporte_ventas_mensuales.pdf'; // Nombre del archivo
                    link.click();
                    URL.revokeObjectURL(url);
                })
                .catch(error => console.error('Error al enviar la imagen:', error));
            }); 
        },5000);
    });

});



