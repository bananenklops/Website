// Wird ausgeführt, sobald Seite geladen ist.
$(document).ready(function(){
    getAndFillGrid();

    var categoryItem = $('#menu-categories').find('li');
    categoryItem.on('click', function(){
        categoryItem.removeClass('active');
        $(this).addClass('active');
        getAndFillGrid();
    });

    $('#reset-order').on('click', function(){
        $.post('ajax.php', {'action': 'resetOrder'}, function(data){
            if (data.success)
                getAndFillGrid();
        }, 'json');
    });

    $('#commit-order').on('click', function(){
        var param = {
            'action': 'commitOrder'
        };
        $.post('ajax.php', param, function(data){
            if (data.success)
                getAndFillGrid();
        }, 'json');
    });
});

function getAndFillGrid()
{
    var listItem = $('ol.menu-item-listing').find('li');
    listItem.remove();
    var key = $('#menu-categories').find('.active').attr('data-key');

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
        var amount = item.unit !== "Stück" ? item.portion / 1000 + " " + item.unit : item.unit;
        amount = amount.replace('.',',');
        price = price.toString();
        price = price.replace('.',',');
        $.post('ajax.php', {'action': 'getOrder', 'param': {'key': 'product', 'id': item.ID}}, function(data){
            if (data.success === true)
                listItem = '<li data-ID="' + item.ID + '"><h2>' + item.name + '</h2><h2 class="orders">'+data.result+'x</h2><span>' + amount + '</span><h1>€ ' + price + '</h1></li>';
            else
                listItem = '<li data-ID="' + item.ID + '"><h2>' + item.name + '</h2><span>' + amount + '</span><h1>€ ' + price + '</h1></li>';
            $('ol.menu-item-listing').append(function(){
                return $(listItem).on('click', function(){
                    addOrder(this);
                });
            });
        }, 'json');
    });
}

function createMenuListing(data)
{
    var listItem = '';
    $.each(data.result, function(key, item){
        var price = item.price / 100;
        price = price.toString();
        price = price.replace('.',',');
        $.post('ajax.php', {'action': 'getOrder', 'param': {'key': 'menu', 'id': item.ID}}, function(data){
            if (data.success === true)
                listItem = '<li data-ID="' + item.ID + '" data-orders="0"><h2>' + item.name + '</h2><h2 class="orders">'+data.result+'x</h2><span>' + item.desc + '</span><h1>€ ' + price + '</h1></li>';
            else
                listItem = '<li data-ID="' + item.ID + '" data-orders="0"><h2>' + item.name + '</h2><span>' + item.desc + '</span><h1>€ ' + price + '</h1></li>';
            $('ol.menu-item-listing').append(function(){
                return $(listItem).on('click', function(){
                    addOrder(this);
                });
            });
        }, 'json');
    });
}

function addOrder(item)
{
    $.post('ajax.php', {
        'action': 'addOrder',
        'param': {
            'key': $('#menu-categories').find('.active').attr('data-key'),
            'id': $(item).attr('data-ID')
        }
    }, function(data){
        var orders = '<h2 class="orders">'+data.result+'x</h2>';
        $(item).find('h2.orders').remove();
        $(orders).insertAfter($(item).find('h2'));
    }, 'json');
}