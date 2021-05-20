$(document).ready(function() {
    $('#data_table').Tabledit({
        deleteButton: false,
        editButton: false,
        columns: {
            identifier: [0, 'codigoCu'],
            editable: [
                [1, 'tipo_curso'],
                [2, 'nombre_curso'],
                [3, 'tipo_contenido'],
                [4, 'descripcion'],
                [5, 'id_doc']
            ]
        },
        hideIdentifier: false,
        url: '../modificaciones/live_edit_cursos.php'
    });
});