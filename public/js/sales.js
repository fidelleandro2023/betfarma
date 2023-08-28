 $(function() {
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