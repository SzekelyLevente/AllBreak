$(document).ready(function(){
    $("#more").on("click",function(){
        if(getUrlParameter("name")!=null||getUrlParameter("minprice")!=null||getUrlParameter("maxprice")!=null||getUrlParameter("category")!=null)
        {
            var name=getUrlParameter("name");
            var minprice=getUrlParameter("minprice");
            var maxprice=getUrlParameter("maxprice");
            var category=getUrlParameter("category");
            var search=getUrlParameter("search");
            $.ajax({
                url: "sessions/card_index.php",
                type: 'POST',
                data: {
                    name: name,
                    minprice: minprice,
                    maxprice: maxprice,
                    category: category,
                    search: search,
                    akey: "albr"
                },
                success: function(response){
                    onSuccess(response);
                },
            });
        }
        else
        {
            $.ajax({
                url: "sessions/card_index.php",
                type: 'POST',
                data: {
                    akey: "albr"
                },
                success: function(response){
                    onSuccess(response);
                },
            });
        }
    });

    function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
        return null;
    };
    
    function onSuccess(response)
    {
        var cards=JSON.parse(response);
        var html="";
        for (var i = 0; i < cards.length; i++) {
            html+='<div class="col-md-4 col-sm-6 col-6 mb-3">'+''
              +'<div class="card h-100 d-flex flex-column" title="'+cards[i].name+'">'+''
                  +'<img src="./cardimages/'+cards[i].id+'-'+cards[i].img+'" class="card-img-top" alt="product">'+''
                  +'<div class="card-body d-flex flex-column flex-grow-1">'+''
                      +'<h5 class="card-title">'+cards[i].name+'</h5>'+''
                      +'<p class="card-text" class="flex-grow-1">'+cards[i].comment+'</p>'+''
                      +'<p class="card-text"><strong>Kategória:</strong> '+cards[i].cname+'</p>'+''
                      +'<p class="card-text"><strong>Készleten:</strong> '+cards[i].count+' db</p>'+''
                      +'<p class="card-text"><strong>Ár:</strong> '+cards[i].price+' Ft/'+cards[i].unit+'</p>'+''
                  +'</div>'+''
              +'</div>'+''
            +'</div>';
        }
        $("#cards").append(html);
    }
});