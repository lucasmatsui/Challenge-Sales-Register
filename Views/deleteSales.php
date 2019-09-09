<h1>Deseja mesmo excluir essa venda ?</h1>
<div id="messageSales"></div>
<div class="buttonsDelete_container">
    <button type="submit" class="confirmDelete" onclick="ConfirmDeleteSale(<?php echo $id; ?>)">Sim</button>
    <button type="submit" class="declineDelete">Não</button>
</div>
<script>
$(".declineDelete").on('click', function() {
    hideModalMain();
});
</script>
