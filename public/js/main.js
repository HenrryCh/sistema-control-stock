// Previsualizar Foto
function colocarFoto($this,$img_thumbnail) {
    $imagenPrevisualizacion = document.querySelector($img_thumbnail);
    var userFile = document.getElementById($this);
    userFile.src = URL.createObjectURL(event.target.files[0]);
    $imagenPrevisualizacion.src = userFile.src; 
    console.log(this.name);
}
// Al presionar X, limpiar Foto
function limpiarFoto ($this,$img_thumbnail) {
    $($img_thumbnail).attr("src", "");
    document.getElementById($this).value='';
}

$(document).ready(function() {    
    $('#exportar').DataTable({        
        language: {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "", //"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
                 },
                 "sProcessing":"Procesando...",
            },
        //para usar los botones   
        responsive: true,
           
        buttons:[ 
            {
                extend:    'excelHtml5',
                text:      'Excel ',
                titleAttr: 'Exportar a Excel',
                className: 'btn btn-success',
                footer: true
            },
            {
                extend:    'pdfHtml5',
                text:      'PDF',
                titleAttr: 'Exportar a PDF',
                className: 'btn btn-danger',
                footer: true
            },
            {
                extend:    'copyHtml5',
                text:      'Copiar <i class="fa fa-clipboard"></i>',
                titleAttr: 'Copiar a clipboard',
                className: 'btn btn-info',
                footer: true
            },
            {
                extend:    'print',
                text:      '<i class="fa fa-print"></i> ',
                titleAttr: 'Imprimir',
                className: 'btn btn-info',
                footer: true
            },
        ],
        dom: '<"top"lBf>rtip',
        // lengthMenu: [10,25,50,100],  
        initComplete: function() {
            // Agregar espacio entre la longitud de registros y los botones
            $('.dataTables_length').addClass('mr-3');
        }
    });     
});

$(document).ready(function() {    
    $('#crud').DataTable({        
        language: {
                "zeroRecords": "No se encontraron registros",
                "info": "", //Mostrando _START_ - _END_ de _TOTAL_ registros",
                "infoEmpty": "Mostrando 0 - 0 de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
                 },
                 "sProcessing":"Procesando...",
                 "lengthMenu" : "Ver _MENU_",

            },
        // paging: false,
        ordering : false,
        lengthMenu: [10,25,50,100],
        //para usar los botones   
        responsive: "true",
        // dom: 'l<"toolbar">frtilp',       
        buttons:[ 
            // {
            //     extend:    'excelHtml5',
            //     text:      'Excel ',
            //     titleAttr: 'Exportar a Excel',
            //     className: 'btn btn-success',
            //     footer: true
            // },
            // {
            //     extend:    'pdfHtml5',
            //     text:      'PDF',
            //     titleAttr: 'Exportar a PDF',
            //     className: 'btn btn-danger',
            //     footer: true
            // },
            // {
            //     extend:    'copyHtml5',
            //     text:      'Copiar <i class="fa fa-clipboard"></i>',
            //     titleAttr: 'Copiar a clipboard',
            //     className: 'btn btn-info',
            //     footer: true
            // },
            // {
            //     extend:    'print',
            //     text:      '<i class="fa fa-print"></i> ',
            //     titleAttr: 'Imprimir',
            //     className: 'btn btn-info',
            //     footer: true
            // },
        ]           
    });     
});
