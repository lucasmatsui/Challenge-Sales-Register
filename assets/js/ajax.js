//Inicio das Funções Auxiliares
function isEmpty(value) {
    if(value === "") {
        return true;
    }
}

function message(text, classPropriety) {
    $("#message").css("display", "block");
    $("#message").html(text);
    $("#message").removeClass();
    $("#message").addClass(classPropriety);
}

function messageReport(text, classPropriety) {
    $("#messageReport").css("display", "block");
    $("#messageReport").html(text);
    $("#messageReport").removeClass();
    $("#messageReport").addClass(classPropriety);
}

function messageSales(text, classPropriety) {
    $("#messageSales").css("display", "block");
    $("#messageSales").html(text);
    $("#messageSales").removeClass();
    $("#messageSales").addClass(classPropriety);
}
//Final das Funções Auxiliares

function callHtmlAddNewSeller() {
    const url = `${BASE_URL}home/addSaller`;

    $.ajax({
        url: url,
        type: 'POST',
        beforeSend:function(){
            $(".modal_main").html("Carregando...");
        },
        success:function(html){
            $(".modal_main").html(html);
        }
    }); 
}

function callHtmlAddSales() {

    const url = `${BASE_URL}home/addSales`;

    $.ajax({
        url: url,
        type: 'POST',
        beforeSend:function(){
            $(".modal_main").html("Carregando...");
        },
        success:function(html){
            $(".modal_main").html(html);
        }
    }); 
}

function callHtmlDeleteSales(id) {

    const url = `${BASE_URL}home/deleteSales/${id}`;

    $.ajax({
        url: url,
        type: 'POST',
        data: {
            id
        },
        beforeSend:function(){
            $(".modal_main").html("Carregando...");
        },
        success:function(html){
            $(".modal_main").html(html);
        }
    }); 
}

function callHtmlEditSales(id) {

    const url = `${BASE_URL}home/editSales/${id}`;

    $.ajax({
        url: url,
        type: 'POST',
        data: {
            id
        },
        beforeSend:function(){
            $(".modal_main").html("Carregando...");
        },
        success:function(html){
            $(".modal_main").html(html);
        }
    }); 
}

function addNewSeller(e) {
    e.preventDefault();

    const url = `${BASE_URL}Ajaxhome/addNewSeller`;

    const name = $("#nameNewSeller").val();
    const email = $("#emailNewSeller").val();

    if(isEmpty(name)) {
        message("Nome está vázio !", "danger");
        return false;
    }

    if(isEmpty(email)) {
        message("Email está vázio !", "danger");
        return false;
    }

    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: {
            name,
            email
        },
        success:function(json){
            if(json.msg === "success") {
                message("Cadastrado com sucesso !", "success");
                setTimeout(() => {
                    window.location.href = BASE_URL;
                }, 1000);
            }

            if(json.msg === "emailNotExist") {
                message("E-mail já existe", "danger");
            }
        }
    }); 
}

function getQuantityOfSellers () {
    const url = `${BASE_URL}Ajaxhome/getQuantityOfSellers`;

    $.ajax({
        url: url,
        type: 'POST',
        beforeSend:function(){
            $(".quantitySellers").html("...");
        },
        success:function(json){
            $(".quantitySellers").html(json);
        }
    }); 
}

function SearchSeller() {
    const idAddSale = $("#idAddSale").val();

    if (isEmpty(idAddSale)) {
        messageSales("Identificador está vázio", "danger");
        return false;
    }

    const url = `${BASE_URL}Ajaxhome/getExpecificSeller/${idAddSale}`;

    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        beforeSend:function() {
            $("#messageSale").html("Carregando...");
        },
        success:function(json){
            if(json.getExpecificSeller.id === undefined){
                messageSales("Vendedor não existe", "warning");
                $(".nomeAddSale").html("Nome");
                $(".emailAddSale").html("E-mail");
            } else {
                $(".nomeAddSale").html(json.getExpecificSeller.name);
                $(".emailAddSale").html(json.getExpecificSeller.email);
                messageSales("Vendedor Encontrado", "success"); 
            }
    
        }
    }); 
    
}

function addSales(e) {
    e.preventDefault();

    const url = `${BASE_URL}Ajaxhome/addSales`;

    const id = $("#idAddSale").val();
    const date = $("#dateSale").val();
    const price = $("#priceAddSale").val();
    const commission = $("#valueComission").html().replace("&nbsp;", "");


    if(isEmpty(id)) {
        messageSales("Identificador está vázio !", "warning");
        return false;
    }

    if(isEmpty(date)) {
        messageSales("Data está vázio !", "warning");
        return false;
    }

    if(isEmpty(price)) {
        messageSales("Preço está vázio !", "warning");
        return false;
    }

    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: {
            id,
            date,
            price,
            commission
        },
        beforeSend:function(){
            $("#messageSales").html("Carregando...");
        },
        success:function(json){
            if(json.msg === "success") {
                messageSales("Venda realizada com sucesso !", "success");
                setTimeout(() => {
                    window.location.href = BASE_URL;
                }, 1000);
            }

            if(json.msg === "notfound") {
                messageSales("Esse vendedor não foi cadastrado!", "danger");
            } 

            if(json.msg === "isNotPrice") {
                messageSales("Esse valor não é um preço !", "danger"); 
            }

            if(json.msg === "isNotCommission") {
                messageSales("Esse valor não é uma comisão !", "danger"); 
            } 

            if(json.msg === "somethingIsWrongDanger") {
                messageSales("Algo está errado, tente novamente!", "danger");
            }
            
        }
    });  

}

function ConfirmDeleteSale(id) {
    const url = `${BASE_URL}Ajaxhome/deleteSales/${id}`;

    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: {
            id
        },
        beforeSend:function() {
            $("#messageSales").html("Carregando...");
        },
        success:function(json) {
            if(json.msg === "success") {
                messageSales("Excluido com sucesso !", "success");
                setTimeout(() => {
                    window.location.href = BASE_URL;
                }, 1000);
            }

            if(json.msg === "somethingIsWrongDanger") {
                messageSales("Não foi possivel excluir, tente novamente!", "danger");
            }
            if(json.msg === "somethingIsWrongId") {
                messageSales("Algo deu errado, tente novamente !", "danger");
            }
        }
    });
}

function editSale(e){
    e.preventDefault();


    const id = $("#idHiddenEdit").val();
    const date = $("#dateEditSale").val();
    const price = $("#priceEditSale").val();
    const commission = $("#valueComissionEdit").html().replace("&nbsp;", "");

    const url = `${BASE_URL}Ajaxhome/editSale/${id}`;

    if(isEmpty(id)) {
        messageSales("Algo deu errado, tente novamente!", "danger");
        return false;
    }

    if(isEmpty(date)) {
        messageSales("Data está vázio !", "warning");
        return false;
    }

    if(isEmpty(price)) {
        messageSales("Preço está vázio !", "warning");
        return false;
    }
    

    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: {
            date,
            price,
            commission
        },
        beforeSend:function(){
            $("#messageSales").html("Carregando...");
        },
        success:function(json){
            if(json.msg === "success") {
                messageSales("Venda atualizada com sucesso !", "success");
                setTimeout(() => {
                    window.location.href = BASE_URL;
                }, 1000);
            }

            if(json.msg === "notfound") {
                messageSales("Esse venda não foi encontrada!", "danger");
            } 

            if(json.msg === "isNotPrice") {
                messageSales("Esse valor não é um preço !", "danger"); 
            }

            if(json.msg === "isNotCommission") {
                messageSales("Esse valor não é uma comisão !", "danger"); 
            } 

            if(json.msg === "somethingIsWrongDanger") {
                messageSales("Algo está errado, tente novamente!", "danger");
            } 
        }
    });
}


function sendReport() {

    const url = `${BASE_URL}Report/sendReport`;

    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        beforeSend:function(){
            $("#messageReport").css("display", "block");
            $("#messageReport").removeClass();
            $("#messageReport").html("Carregando...");
        },
        success:function(json){
            if(json.msg === "successSendEmail") {
                messageReport("Relatório gerado com sucesso! Verifique sua caixa de Emails", "success");
                setTimeout(() => {
                    $("#messageReport").fadeOut();
                }, 5000);
            }

            if(json.msg === "errorSendEmail") {
                messageReport("Erro ao enviar o relatório!", "danger");
                setTimeout(() => {
                    $("#messageReport").fadeOut();
                }, 2000);
            }  
        }
    });   
}

function verifyNotifications() {
    const url = `${BASE_URL}Report/verifyNotification`;

    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        success:function(json){
            
            if(json.quantityNotifications > 0) {
                $("#quantity").html(json.quantityNotifications);
                $("#quantity").addClass("hasNotify");
            } else {
                $("#quantity").removeClass("hasNotify");
                $("#quantity").html(0);
            }

            if(json.listOfNotifications.length > 0) {
                $("#modal_notify").html("");
                json.listOfNotifications.map((items) => {
                    $("#modal_notify").prepend(
                        `
                        <a href="${items.link}" target="T_BLANK">
                            <div class="items_notify">
                                <h1>${items.title}</h1>
                                <h2>${items.date_notify}</h2>
                            </div>
                        </a>
                        `
                    );
                });
            } else {
                $("#modal_notify").html("Nenhuma notificação até o momento!");
            }
        }
    });  
}

function showModalNotify(e) {
    e.stopPropagation();

    const url = `${BASE_URL}Report/readNotification`;

    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        beforeSend:function() {
            $(".modal_notify").toggle();
        }
    });
}  
 
  
 



