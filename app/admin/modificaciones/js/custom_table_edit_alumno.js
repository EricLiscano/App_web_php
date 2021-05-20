$(document).ready(function() {
    $('#data_table').Tabledit({
        deleteButton: false,
        editButton: false,
        columns: {
            identifier: [0, 'id'],
            editable: [
                [1, 'nombre'],
                [2, 'apellido'],
                [3, 'fechanac'],
                [4, 'documento'],
                [5, 'pais'],
                [6, 'telefono'],
                [7, 'direccion']
            ]
        },
        hideIdentifier: false,
        url: '../modificaciones/live_edit_alumno.php'
    });
});