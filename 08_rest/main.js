$('#product_id').on('input', function(){
    console.log('id has been inputted');
    $.ajax({
        url: 'api/v1/products/'+$('#product_id').val(),
        // data: {
        //     id: $('#product_id').val()
        // },
        method: "GET",
        error:function (xhr, ajaxOptions, thrownError){
            $('.result').html(xhr.responseText);
        }
    }).done(function(data){
        // console.log(JSON.stringify(data));
        var parsed = JSON.parse(data);
        console.log(parsed.category);
        // $('.result').html("<div>"+data+"</div>");
        $('.result').html(show(parsed));
    });
})

function show(data){
    var str1 = "<h4>Наименование</h4>"+"<p>"+data.name+"</p>";
    var str2 = "<h4>Описание</h4>"+"<p>"+data.description+"</p>";
    var str3 = "<h4>Категория</h4>"+"<p>"+data.category.name+"</p>";
    var str4= "<h4>Цена</h4>"+"<p>"+data.price+"</p>";
    return str1+str2+str3+str4;
}
