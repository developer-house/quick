require('select2');

if ($(".select2")[0]) {
    $('.select2').select2({
        allowClear: true,
        theme: "classic",
        placeholder: "Seleccione",
    });
}


