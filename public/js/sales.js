//  $(document).click(function(){
//     $("#nav-venta table tbody tr:first-child input").eq(0).focus();
//  });
 $(function() {
    $("#nav-venta table tbody tr.active input").eq(0).focus();
    $("#accordion_sales")
         .accordion({
             header: "> div > div > h3"
         })
         .sortable({
             axis: "y",
             handle: "h3",
             stop: function(event, ui) {
                 // IE doesn't register the blur when sorting
                 // so trigger focusout handlers to remove .ui-state-focus
                 ui.item.children("h3").triggerHandler("focusout");
                 // Refresh accordion to handle new order
                 $(this).accordion("refresh");
             }
         });

    $("#add_sales_espera").click(function() {
         r = $("#accordion_sales .group").length;
         cont = parseInt(r) + 1;
         $("#nav-ventas-espera-tab span").text(cont);
         title = 'Section ' + cont + ' : ';
         form = $("#nav-venta").html();
         coll_h = (r == 0) ? '' : 'collapse';
         content = '<div class="group"><div class="item"><h3>' + title + '</h3><div class="content ' + coll_h + '">' + form + '</div></div></div>';
         $("#accordion_sales").append(content);
         //$("botones_sale").hide();
    });
    $("#accordion_sales .item").click(function() {
         $(this).parents(".group").prependTo("#accordion_sales");
    });
 });
function clickTextField(THIS) {
    TR = $(THIS).parent().parent();
    $("#nav-venta table tbody tr").removeClass('active'); 
    TR.addClass("active");
}
 function keyTextField(THIS,e) {
    tis = $(THIS);
    var enter = 13;
    var keyLeft = 37;
    var keyRight = 39;
    var keyUp = 38;
    var keyDown = 40;
    var c_enter = 0;
    var TR = tis.parent().parent();
    var TR_index = TR.index();
    var moves = $("#nav-venta table tbody tr.active input"); 

    if (e.keyCode == enter && tis.hasClass("total")) { 
            console.log("enter");
            tis.parent().parent().removeClass('active');
            r = '<tr class="active">'+
                  '<td class="col-md-3 ">'+
                    '<input onclick="clickTextField(this)" onkeyup="keyTextField(this,event)" type="text" class="name form-control">'+
                  '</td>'+
                  '<td class="col-md-2">'+
                    '<input onclick="clickTextField(this)" onkeyup="keyTextField(this,event)" type="text" class="cantidad form-control">'+
                  '</td>'+
                  '<td class="col col-md-2">'+
                    '<input onclick="clickTextField(this)" onkeyup="keyTextField(this,event)" type="text" class="lote form-control">'+
                  '</td>'+
                  '<td class="col">'+
                    '<input onclick="clickTextField(this)" onkeyup="keyTextField(this,event)" type="text" class="psp form-control">'+
                  '</td>'+
                  '<td class="col">'+
                    '<input onclick="clickTextField(this)" onkeyup="keyTextField(this,event)" type="text" class="dscto form-control">'+
                  '</td>'+
                  '<td class="col">'+
                    '<input onclick="clickTextField(this)" onkeyup="keyTextField(this,event)" type="text" class="pvp form-control">'+
                  '</td>'+
                  '<td class="col">'+
                    '<input onclick="clickTextField(this)" onkeyup="keyTextField(this,event)" type="text" class="total form-control">'+
                  '</td>'+
               '</tr>';
            tbody = $("#nav-venta table tbody");
            tbody.append(r);  
            tr = $("#nav-venta table tbody tr");
            l_tr =tr.length;
            tr.eq(l_tr-1).find('td').eq(0).find('input').focus();
    }
    if (e.keyCode == enter) { 
        for(i = 0; i <= moves.length; i++) {
            if (moves[i] == tis.parent().parent().find("input:focus").get(0)) {
               $(moves[i + 1]).focus();
                break;
            }
        }
    }
    if (e.keyCode == keyRight) {
        for(i = 0; i <= moves.length; i++) {
            if (moves[i] == tis.parent().parent().find("input:focus").get(0)) {
               $(moves[i + 1]).focus();
                break;
            }
        }
    }
    if (e.keyCode == keyLeft) {
        for(i = 0; i <= moves.length; i++) {
            if (moves[i] == tis.parent().parent().find("input:focus").get(0)) {
               $(moves[i - 1]).focus();
                break;
            }
        }
    }
    if (e.keyCode == keyUp) { 
        $("#nav-venta table tbody tr").removeClass('active'); 
        $("#nav-venta table tbody tr").eq(TR_index-1).addClass("active");
        $("#nav-venta table tbody tr").eq(TR_index-1).find("td").eq(0).find('input').focus();
        console.log(TR_index-1);
    }
    if (e.keyCode == keyDown) {
        TR = $("#nav-venta table tbody tr").length; 
        if (TR == TR_index+1) { 
                $("#nav-venta table tbody tr").removeClass('active'); 
                $("#nav-venta table tbody tr").eq(0).addClass("active");
                $("#nav-venta table tbody tr").eq(0).find("td").eq(0).find('input').focus();
        }else{
                $("#nav-venta table tbody tr").removeClass('active'); 
                $("#nav-venta table tbody tr").eq(TR_index+1).addClass("active");
                $("#nav-venta table tbody tr").eq(TR_index+1).find("td").eq(0).find('input').focus(); 
        }
    }
}
 