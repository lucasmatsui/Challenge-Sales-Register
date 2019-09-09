function showModalMain() {
    $("body, html").css("overflow", "hidden");
    $(".modal_main_container").show();
    $(".modal_main").fadeIn('fast');
}  


function hideModalMain() {
    $("body, html").css("overflow", "auto");
    $(".modal_main_container").hide();
}

function format(v){
    var test = parseFloat(v).toLocaleString("pt-BR", { style: "currency" , currency:"BRL"});
    return test.replace('R$', "");
}

function formatPriceToOperations(num) {
    let price = num.replace(/\./g, "");
    let newPrice = price.replace(/,/g, ".");
    return newPrice;
}


$("#notify").on('click', function(e) { 
    e.stopPropagation();
});

$(".modal_notify").on('click', function(e) {
    e.stopPropagation();
});

$("body").on('click', function() {
    $(".modal_notify").css('display', 'none');
});


$(".addSales").on('click', function() {
    showModalMain();
});


$(".addSalesman").on('click', function() {
    showModalMain();
});

$(".delete_button").on('click', function() {
    showModalMain();
});


$(".edit_button").on('click', function() {
    showModalMain();
});



$(".modal_main_container").on('click', function() {
    hideModalMain();
});



$(".modal_main").on('click', function(e) {
    e.stopPropagation();
});



$(document).ready(function(){

    getQuantityOfSellers();
    verifyNotifications();

    setInterval(function() {
        getQuantityOfSellers();
    }, 10000);

    setInterval(function() {
        verifyNotifications();
    }, 5000);

});
