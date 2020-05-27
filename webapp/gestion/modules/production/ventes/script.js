$(function(){
    $("body").on("click", ".btnproduit", function(event) {
        var id = $(this).attr("data-id");
        $("td.produit-"+id).toggle(200);
        $("th.produit-"+id).toggle(200);
        $("button[data-id="+id+"]").toggleClass('btn-success');
    });
})