// Wird ausgeführt, sobald Seite geladen ist.
$(document).ready(function(){
    getAndFillGrid();

    var categoryItem = $('#menu-categories').find('li');
    categoryItem.on('click', function(){
        $('ol.menu-item-listing').find('li').remove();
        categoryItem.removeClass('active');
        $(this).addClass('active');
        getAndFillGrid();
    });
});

function getAndFillGrid()
{
    var key = $('#menu-categories').find('.active').attr('data-key');
    var param = {};

    switch (key) {
        case 'product':
            $.post('ajax.php', {'action': 'getProduct'}, function(data){createProductListing(data)}, 'json');
            break;
        case 'menu':
            $.post('ajax.php', {'action': 'getMenu'}, function(data){createMenuListing(data)}, 'json');
            break;
    }
}

function createProductListing(data)
{
    var listItem = '';
    $.each(data.result, function(key, item){
        var price = item.price / 100;
        price = price.toString();
        price = price.replace('.',',');
        listItem = '<li data-ID="' + item.ID + '"><h2>#' + item.ID + ' ' + item.name + '</h2><span>' + item.unit + '</span><h1>€ ' + price + '</h1></li>';
        $('ol.menu-item-listing').append($(listItem));
    });
}

function createMenuListing(data)
{
    var listItem = '';
    $.each(data.result, function(key, item){
        var price = item.price / 100;
        price = price.toString();
        price = price.replace('.',',');
        listItem = '<li data-ID="' + item.ID + '"><h2>#' + item.ID + ' ' + item.name + '</h2><span>' + item.unit + '</span><h1>€ ' + price + '</h1></li>';
        $('ol.menu-item-listing').append($(listItem));
    });
}