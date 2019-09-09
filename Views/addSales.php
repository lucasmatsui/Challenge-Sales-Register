<h1 id="modalTitleSale">Venda</h1>
<div id="messageSales"></div>
<form onsubmit="addSales(event)">
    <div class="id_and_search_container">
        <input type="text" name="idAddSale" id="idAddSale" placeholder="# Identificador do Vendedor">
        <div class="SearchSeller" id="SearchSeller" onclick="SearchSeller()">Buscar</div>
    </div>
    <input type="text" name="dateSale" class="dateSale" id="dateSale" required />
    <div class="nomeAddSale">Nome</div>
    <div class="emailAddSale">E-mail</div>
    <input type="text" name="priceAddSale" class="priceAddSale" id="priceAddSale" placeholder="Preço da venda">

    <div class="modalInputCommission">
        <span class="commissionText">Comissão R$:</span>
        <div id="valueComission">0.00</div>
    </div>

    <button type="submit" id="submitTextSale">Fazer Venda</button>
</form>
<script type="text/javascript">


$("#priceAddSale").on('keyup', function() {
    let priceAddSale = $("#priceAddSale").val();
    let newPriceAddSale = formatPriceToOperations(priceAddSale);
    let commission = newPriceAddSale * 0.085;
    
    $("#valueComission").html(format(commission));    
})

$("#idAddSale").mask('#');
$("#priceAddSale").mask("#.##0,00", {reverse: true});

$("#dateSale").daterangepicker({
    opens: 'right',
    drops:'down',
    singleDatePicker: true,
    startDate: new Date(),
    timePickerSeconds:true,
    timePicker24Hour:true,
    timePicker: true,
    locale: {
        applyLabel:'Selecionar',
        cancelLabel: 'Fechar',
        format: 'DD/MM/YYYY HH:mm:ss',
        "daysOfWeek": [
            "Dom",
            "Seg",
            "Ter",
            "Qua",
            "Qui",
            "Sex",
            "Sáb"
        ],
        "monthNames": [
            "Janeiro",
            "Fevereiro",
            "Março",
            "Abril",
            "Maio",
            "Junho",
            "Julho",
            "Agosto",
            "Setembro",
            "Outubro",
            "Novembro",
            "Dezembro"
        ],
    }
});
</script>

