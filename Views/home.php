<div class="box_table">
    <h1>Vendas</h1>
    <div class="buttons_container">
        <button class="addSales" onclick="callHtmlAddSales()"><i class="fa fa-plus"></i></button>
        <button class="addSalesman" onclick="callHtmlAddNewSeller()"><i class="fa fa-plus"></i></button>
    </div>
    <table>
        <thead>
            <tr>
                <th># id</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Comissão</th>
                <th>Valor da venda</th>
                <th>Data de venda</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if(count($getListOfSales) > 0){
                foreach($getListOfSales as $getItemSale): ?>
                    <tr>
                        <td align="center"><?php echo $getItemSale['id_seller']; ?></td>
                        <td><?php echo $getItemSale['name']; ?></td>
                        <td><?php echo $getItemSale['email']; ?></td>
                        <td class="money">R$ <?php echo number_format($getItemSale['commission'], 3, ',', '.'); ?></td>
                        <td class="money">R$ <?php echo number_format($getItemSale['sale_price'], 2, ',', '.'); ?></td>
                        <td><?php echo date("d/m/Y H:i", strtotime($getItemSale['date_sale']))?></td>
                        <td class="buttons_options">
                            <button>
                                <i class="fas fa-ellipsis-v"></i>
                                <div class="modal_options">
                                    <a class="edit_button" onclick="callHtmlEditSales(<?php echo $getItemSale['id']; ?>)">Editar</a>
                                    <a class="delete_button" onclick="callHtmlDeleteSales(<?php echo $getItemSale['id']; ?>)" >Excluir</a>
                                </div>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php } else { ?>
                <tr>
                    <td colspan="7">Sem nenhuma venda no Momento!</td>
                </tr>
            <?php } ?>
        </tbody>
            
    </table>
</div>
