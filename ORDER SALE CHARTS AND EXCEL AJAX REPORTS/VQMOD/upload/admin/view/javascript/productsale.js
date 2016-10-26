function getURLVar(key) {
    var value = [];
    var query = String(document.location).split('?');
    if (query[1]) {
        var part = query[1].split('&');

        for (i = 0; i < part.length; i++) {
            var data = part[i].split('=');

            if (data[0] && data[1]) {
                value[data[0]] = data[1];
            }
        }
        if (value[key]) {
            return value[key];
        } else {
            return '';
        }
    }
}

$(document).ready(function(){
    var max_visible; // show maximum visible
    var sort_url='';
    var limit_record = $('.current_limit_class').val(); // build limit
    var final_rec = $('.final_record_class').val(); // build final record
    max_visible = getMaxVisible(final_rec);
    // for sorting
    $(document).on('click','.sort-header',function(){
        $('.current_record_class').val(1);
        sort_url = $(this).attr('append_url');
        $('.current_sorting_class').val(sort_url);
        var post_data = $('#form-product-sale').serialize(); // get post data with serialize
        useAjax(post_data,sort_url);
        // change asc to desc
        if(sort_url.match(/=ASC/g)){
            $(this).attr('append_url',sort_url.replace("=ASC","=DESC"));
        }else{
            $(this).attr('append_url',sort_url.replace("=DESC","=ASC"));
        } // eo else
        // to show from first record
        $('.custom-pagination').bootpag({page:1});
    }); // eo document
    // category select
    $(document).on('change','#form-product-sale', function () {
        $('.current_record_class').val(1);
        var post_data = $('#form-product-sale').serialize(); // get post data with serialize
        useAjax(post_data,'');
        $('.custom-pagination').bootpag({page:1});
    }); // eo category select
    // boostrap bootpag
    $('.custom-pagination').bootpag({
        total: final_rec,
        page: 1,
        maxVisible: max_visible,
        leaps: true,
        firstLastUse: true,
        first: '←',
        last: '→',
        wrapClass: 'pagination',
        activeClass: 'active',
        disabledClass: 'disabled',
        nextClass: 'next',
        prevClass: 'prev',
        lastClass: 'last',
        firstClass: 'first'
    }).on("page", function(event, num){
        if($.isNumeric(num)){
            $('.current_record_class').val(num);
        }else{
            $('.current_record_class').val(1);
        }
        sort_url = $('.current_sorting_class').val();
        var post_data = $('#form-product-sale').serialize(); // get post data with serialize
        useAjax(post_data,sort_url);
    });
    // common function to process common ajax
    function useAjax(post_data,sort_url){
        $.ajax({
            url : 'index.php?route=sale/product_sale/ajaxProcess&token=' + getURLVar('token') + sort_url,
            method : 'POST',
            data :  post_data,
            success : function(data){
                var obj = JSON.parse(data);
                // for pagination
                final_rec = Math.ceil(obj.totals/limit_record);
                $('.final_record_class').val(final_rec);
                max_visible = getMaxVisible(final_rec);
                $('.custom-pagination').bootpag({total: final_rec, maxVisible: max_visible});
                // construct table
                var records = "";
                 var i=0;
                if(obj.status == 'success'){
                    $.each(obj.records,function(key,value){
                        records+= "<tr>" +
                        "<td class='text-left'>"+value['name']+"</td>"+
                        "<td class='text-left'>"+value['cat_name']+"</td>" +
                        "<td class='text-left'>"+value['tot_quantity']+"</td>" +
                        "<td class='text-left'>"+value['total_orders']+"</td>" +
                        "</tr>";
                        i++;
                    }); // eo each
                    $('tbody#append-records').html(records);
                }else{
                    $('tbody#append-records').html('<tr><td class="text-center" colspan="8">No results!</td></tr>');
                } // eo else
            } // eo success
        }); // eo ajax
    } // eo function
    function getMaxVisible(final_rec){
        if(final_rec > 5){
            max_visible = 5;
        }else if(final_rec < 5){
            max_visible = final_rec;
        }
        return max_visible;
    }
}); // eo ready

