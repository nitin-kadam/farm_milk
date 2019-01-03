<div class="row">
<div class="col">
<h2 class="title-1 m-b-25">Earnings By Items
<!-- 
<?php var_dump($result->id);?> -->
</h2>
<div class="table-responsive table--no-card m-b-40">
<table class="table table-borderless table-striped table-earning">
<thead>
<tr>
<th>date</th>
<th>order ID</th>
<th>name</th>
<th class="text-right">price</th>
<th class="text-right">quantity</th>
<th class="text-right">total</th>
</tr>
</thead>
<tbody><tr>
	<?php foreach ($result as $key ){?>
<tr>
<td><?php echo $key->create_on;?></td>
<td><?php echo $key->id;?></td>
<td><?php echo $key->product_name;?></td>
<td class="text-right"><?php echo $key->product_price;?></td>
<td class="text-right"><?php echo $key->product_quantity;?></td>
<td class="text-right"><?php echo $key->product_total;?></td>

<?php }
?></tr>

</tbody>
</table>
</div>
</div>

</div>