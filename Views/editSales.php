<h1>Editar Venda</h1>
<div id="messageSales"></div>
<form onsubmit="editSale(event)">
    <div class="nomeEditSale"><?php echo $infoAboutSale["name"]; ?></div>
    <div class="emailEditSale"><?php echo $infoAboutSale["email"]; ?></div>
    <input type="text" name="dateEditSale" value="<?php echo date("d/m/Y H:i:s", strtotime($infoAboutSale["date_sale"]));?>" id="dateEditSale" readonly>
    <input type="text" name="priceEditSale" value="<?php echo number_format($infoAboutSale["sale_price"], 2, ",", "."); ?>" id="priceEditSale" placeholder="Preço da venda">
    <div class="InputCommissionEdit">
        <span class="commissionTextEdit">Comissão R$:</span>
        <div id="valueComissionEdit"><?php echo number_format($infoAboutSale["commission"], 2, ",", "."); ?></div>
    </div>
    <input type="hidden" id="idHiddenEdit" value="<?php echo $infoAboutSale['id']; ?>" />
    <button type="submit">Atualizar</button>
</form>
<script>
$("#priceEditSale").on('keyup', function() {
    let priceAddSale = $("#priceEditSale").val();
    let newPriceAddSale = formatPriceToOperations(priceAddSale);
    let commission = newPriceAddSale * 0.085;
    
    $("#valueComissionEdit").html(format(commission)); 
})

$("#priceEditSale").mask("#.##0,00", {reverse: true});

$("#dateEditSale").daterangepicker({
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