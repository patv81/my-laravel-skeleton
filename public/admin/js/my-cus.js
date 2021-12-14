$(document).ready(function() {
    let btnSearch=$('button#btn-search');
    let btnClear = $('button#btn-clear');
    let inputSearchVallue= $('input[name=search_value]');
    let inputSearchFild= $('input[name=search_field]');
    $('a.select-field').click(function(e){
        e.preventDefault();
        let field = $(this).data('field');
        let fieldName = $(this).html();
        $('button.btn-active-field').html(fieldName+'<span class="caret"></span>');
        inputSearchFild.val(field);
    });

    btnSearch.click(function(e){
        let pathname= window.location.pathname;
        let params =['filter_status'];
        let searchParams = new URLSearchParams(window.location.search);
        let link ="";
        $.each(params,function(key,param){
            if(searchParams.has(param)){
                link += param+'='+searchParams.get(param) +'&'
            }
        });
        let search_value=inputSearchVallue.val();
        let search_field = inputSearchFild.val();
        if(search_value.replace(/\s/g,"")==""){
            alert("Nhập vào giá trị cần tìm");
        }else{
            window.location.href=pathname+'?'+link+'search_field='+search_field+'&search_value='+search_value;
        }
    })

    btnClear.click(function(e){
        let pathname= window.location.pathname;
        let params =['filter_status'];
        let searchParams = new URLSearchParams(window.location.search);
        let link ="";
        $.each(params,function(key,param){
            if(searchParams.has(param)){
                link += param+'='+searchParams.get(param) +'&'
            }
        });
        let search_value=inputSearchVallue.val();
        let search_field = inputSearchFild.val();
        window.location.href=pathname+'?'+link.slice(0,-1);

    })
});