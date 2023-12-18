// Datatable
new DataTable('#tabelDaftarKuisioner');
new DataTable('#tabelDaftarKuisioner2');

// tambah pertanyaan
let i = 2;
$('#sisip-pertanyaan').on('click', function() {
    $('#pertanyaan').append(`
        <div class="mb-3 card p-2">
            <label for="kuisioner${i}" class="form-label">Pertanyaan ${i}</label>
            <input type="text" class="form-control" id="kuisioner${i}" name="kuisioner[]" placeholder="Ketikkan pertanyaan disini...">
        </div>
    `);
    i++;
    if (i > 20) {
        $('#limit_res').html('<p class="text-muted">Limit 20 Pertanyaan</p>');
        $('#sisip-pertanyaan').hide();
    }
})