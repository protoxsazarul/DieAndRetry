$( document ).ready(function() {
    // Gestion de la taile du thead 
    Gnamewidth= $("#Gname").outerWidth();
    Gplatwidth= $("#Gplat").outerWidth();
    Gpubwidth= $("#Gpub").outerWidth();
    Gdevwidth= $("#Gdev").outerWidth();
    Gconstwidth= $("#Gconst").outerWidth();
    Gdetailwidth= $("#Gdetail").outerWidth();

    $('#GHname').width(Gnamewidth);
    $('#GHplat').width(Gplatwidth);
    $('#GHpub').width(Gpubwidth);
    $('#GHdev').width(Gdevwidth);
    $('#GHconst').width(Gconstwidth);
    $('#GHdetail').width(Gdetailwidth);
    
});
