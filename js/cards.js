$(document).ready(function(){
    $(document).on("click",".cardUpdate",function(){
        var id=$(this).data("id");
        var state=$("#upd"+id).css("display");
        if(state=="none")
        {
            $("#upd"+id).css("display","block");
        }
        else
        {
            $("#upd"+id).css("display","none");
        }
    });

    $(document).on("click",".updateCard",function(){
        var id=$(this).data("id");
        var name=$("#name"+id).val();
        var price=$("#price"+id).val();
        var unit=$("#unit"+id).val();
        var count=$("#count"+id).val();
        var highlited=$("#highlited"+id).val();
        var comment=$("#comment"+id).val();
        var priority=$("#priority"+id).val();
        var isnew=$("#isnew"+id).val();
        $.ajax({
            url: "sessions/card_update.php",
            type: 'POST',
            data: {
                id: id,
                name: name,
                price: price,
                unit: unit,
                count: count,
                highlited: highlited,
                comment: comment,
                priority: priority,
                isnew: isnew
            },
            success: function(response){
                var success=JSON.parse(response);
                if(success.success)
                {
                    //alert(price+" Ft/"+unit);
                    var message="Kártya sikeresen módosítva!";
                    $("#upd"+id).css("display","none");
                    var highlitedText="Nem";
                    if(highlited==1){highlitedText="Igen";}
                    var isnewText="Nem";
                    if(isnew==1){isnewText="Igen";}
                    $("#nam"+id).html(name);
                    $("#pric"+id).html(price);
                    $("#uni"+id).html(unit);
                    $("#cou"+id).html(count+" db");
                    $("#com"+id).html(comment);
                    $("#hig"+id).html(highlitedText);
                    $("#prio"+id).html(priority);
                    $("#isn"+id).html(isnewText);
                }
                else
                {
                    var message="Töltsd ki az összes mezőt!";
                }
                $("body").append(
                    '<div class="toast show fixed-bottom">'+
                        '<div class="toast-header">'+
                            '<strong class="me-auto">Módosítás</strong>'+
                            '<button type="button" class="btn-close" data-bs-dismiss="toast"></button>'+
                        '</div>'+
                        '<div class="toast-body">'+
                            '<p>'+message+'</p>'+
                        '</div>'+
                    '</div>'
                )
            },
        });
    });

    $(document).on("click","#more",function(){
        var name=$("#search").val();
        $.ajax({
            url: "sessions/card_index.php",
            type: 'POST',
            data: {
                name: name,
                search: true,
                category: 0,
                akey: "albr"
            },
            success: function(response){
                onSuccess(response);
            },
        });
    });

    $("#search").keyup(function(){
        var name=$("#search").val();
        $.ajax({
            url: "sessions/search.php",
            type: 'POST',
            data: {
                name: name,
                akey: "albr"
            },
            success: function(response){
                $("#cards").html("");
                onSuccess(response);
            },
        });
    });

    function getSelects(value)
    {
        var text="";
        if(value=="Igen")
        {
            text=
            '<option value="0">Nem</option>'+
            '<option value="1" selected>Igen</option>';
        }
        else
        {
            text=
            '<option value="0" selected>Nem</option>'+
            '<option value="1">Igen</option>';
        }
        return text;
    }

    function onSuccess(response)
    {
        var cards=JSON.parse(response);
        var html="";
        for (var i = 0; i < cards.length; i++) {
            var highligted="Nem";
            if(cards[i].highlited==1)
            {
                highligted="Igen";
            }
            var isnew="Nem";
            if(cards[i].isnew==1)
            {
                isnew="Igen";
            }
            $("#cards").append(
            '<div class="card mt-2 mb-2 bg-secondary rounded text-center">'+
                '<div class="card-body">'+
                    '<div class="row">'+
                        '<div class="col-6">'+
                            '<h4 class="card-title">'+cards[i].name+'</h4>'+
                            '<img src="./cardimages/'+cards[i].id+'-'+cards[i].img+'" style="height: 100px">'+
                            '<div class="mt-3">'+
                                '<form method="post" style="display: inline;">'+
                                    '<button type="submit" class="btn btn-danger" name="cardDelete"><i class="bi bi-trash3"></i></button>'+
                                    '<input type="hidden" value="'+cards[i].id+'" name="cardId">'+
                                '</form>'+
                                '<button class="btn btn-primary cardUpdate" data-id="'+cards[i].id+'"><i class="bi bi-pencil"></i></button>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-6">'+
                            '<p class="card-text"><strong>Kategória:</strong> '+cards[i].cname+'</p>'+
                            '<p class="card-text"><strong>Ár:</strong> <span id="pric'+cards[i].id+'">'+cards[i].price+'</span> Ft/<span id="uni'+cards[i].id+'">'+cards[i].unit+'</span></p>'+
                            '<p class="card-text"><strong>Készlet:</strong> <span id="cou'+cards[i].id+'">'+cards[i].count+' db</span></p>'+
                            '<p class="card-text"><strong>Megjegyzés:</strong> <span id="com'+cards[i].id+'">'+cards[i].comment+'</span></p>'+
                            '<p class="card-text"><strong>Kiemelt:</strong> <span id="hig'+cards[i].id+'">'+highligted+'</span></p>'+
                            '<p class="card-text"><strong>Prioritás:</strong> <span id="prio'+cards[i].id+'">'+cards[i].priority+'</span></p>'+
                            '<p class="card-text"><strong>Újdonság:</strong> <span id="isn'+cards[i].id+'">'+isnew+'</span></p>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<div id="upd'+cards[i].id+'" style="display: none">'+
                    '<div class="mb-3 mt-3">'+
                        '<label for="name" class="form-label">Név:</label>'+
                        '<input type="text" id="name'+cards[i].id+'" class="form-control" value="'+cards[i].name+'">'+
                    '</div>'+
                    '<div class="mb-3">'+
                        '<label for="price" class="form-label">Ár:</label>'+
                        '<input type="number" id="price'+cards[i].id+'" class="form-control" value="'+cards[i].price+'">'+
                    '</div>'+
                    '<div class="mb-3">'+
                        '<label for="unit" class="form-label">Egység:</label>'+
                        '<input type="text" id="unit'+cards[i].id+'" class="form-control" value="'+cards[i].unit+'">'+
                    '</div>'+
                    '<div class="mb-3">'+
                        '<label for="count" class="form-label">Darab:</label>'+
                        '<input type="number" id="count'+cards[i].id+'" class="form-control" value="'+cards[i].count+'">'+
                    '</div>'+
                    '<div class="mb-3">'+
                        '<label for="highlited" class="form-label">Kiemelt:</label>'+
                        '<select id="highlited'+cards[i].id+'" class="form-select">'+
                            getSelects(highligted)+
                        '</select>'+
                    '</div>'+
                    '<div class="mb-3">'+
                        '<label for="comment" class="form-label">Megjegyzés:</label>'+
                        '<textarea id="comment'+cards[i].id+'" class="form-control">'+cards[i].comment+'</textarea>'+
                    '</div>'+
                    '<div class="mb-3">'+
                        '<label for="priority" class="form-label">Prioritás:</label>'+
                        '<input type="number" id="priority'+cards[i].id+'" class="form-control" value="'+cards[i].priority+'">'+
                    '</div>'+
                    '<div class="mb-3">'+
                        '<label for="isnew" class="form-label">Újdonság:</label>'+
                        '<select id="isnew'+cards[i].id+'" class="form-select">'+
                            getSelects(isnew)+
                        '</select>'+
                    '</div>'+
                    '<button class="btn btn-primary updateCard" data-id="'+cards[i].id+'">Módosítás</button>'+
                '</div>'+
            '</div>');
        }
        //$("#cards").append(html);
    }
});