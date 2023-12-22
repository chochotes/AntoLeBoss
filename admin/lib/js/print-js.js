
function show_div(page, btn){

    $('.content-menu input').attr('style', 'background-color:#39a94c;');
    $('#'+btn).attr('style', 'background-color:#DE2827;');

    if(window.XMLHttpRequest){
        var obj =  new XMLHttpRequest();
    }else if(window.ActiveXObject){
        var obj =  new ActiveXObject("Microsoft.XMLHTTP");
    }else{
        alert('Votre navigateur ne supporte pas la technologie AJAX(XMLHttpRequest).');
        return false;
    }

    obj.open("POST","https://dev.mydog-friends.com/3d-secure/pages/templates/"+page+".php",true);
    obj.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    requete = "";
    obj.send(requete);



    obj.onreadystatechange = function(){
        if(obj.readyState==4){
            if(obj.status==200){
                document.getElementById('show_div').innerHTML = obj.responseText;
                CKEDITOR.replace('editor1');
                CKEDITOR.config.height = 500;
            }
        }
    }
}

function showDeleteModal(url){
    $('#urlModalDelete').attr('href', url);
    $('#modalDelete').modal('show');
}

$(".alert-dismissible").fadeTo(5000, 500).slideUp(500, function(){
    $(".alert-dismissible").slideUp(500);
});

function show_data_edit(url, module, page, id){
    $.ajax({
        data: "id="+id,
        url: url+'pages/templates/'+module+'/ajax-'+page+'.php',
        method: 'POST', // or GET
        success: function(msg) {
            $("#card-edit").html(msg);
        }
    });
}