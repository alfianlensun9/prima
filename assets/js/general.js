$(function(){
    $('.btn-close-modal').on('click', () => {
        $('#modalDetail').modal('hide')  
    })
})
jQuery.fn.formatRupiah = function (){
    $(this[0]).on('keyup', function(){
        
        const result = formatRupiah($(this).val())
        $(this).val(result)
    })
}
jQuery.fn.select2Ajax = function ({url, id=0}){
    $(this[0]).select2({
        placeholder: "Ketik untuk mencari",
        ajax: {
            url: url,
            type: "post",
            dataType: "json",
            delay: 250,
            data: function (params) {
                return {
                    query: params.term,
                    id, 
                };
            },
            processResults: function (response) {
                return {
                    results: response,
                }
            },
            cache: true
        }
    });
}

 function customAlert(message) {

    // type = ['primary', 'info', 'success', 'warning', 'danger'];
    $.notify({
        // icon: "tim-icons icon-bell-55",
        message

    }, {
        type: 'danger',
        timer: 4000,
        placement: {
            from: 'top',
            align: 'center'
        }
    });
}


function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}