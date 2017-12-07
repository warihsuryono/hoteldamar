<?php

// kode
$asset_category->kode->CellCssStyle = "";
$asset_category->kode->CellCssClass = "";

// coa
$asset_category->coa->CellCssStyle = "";
$asset_category->coa->CellCssClass = "";

// category
$asset_category->category->CellCssStyle = "";
$asset_category->category->CellCssClass = "";

// penyusutan
$asset_category->penyusutan->CellCssStyle = "";
$asset_category->penyusutan->CellCssClass = "";

// coabiaya
$asset_category->coabiaya->CellCssStyle = "";
$asset_category->coabiaya->CellCssClass = "";

// coaakum
$asset_category->coaakum->CellCssStyle = "";
$asset_category->coaakum->CellCssClass = "";
?>
<p><span class="phpmaker"><h3><b>Asset Category</b></h3><br>
<!--a href="<?php echo $gsMasterReturnUrl ?>">Back to master page</a-->
<input type="button" value="Kembali" onclick="window.location='<?php echo $gsMasterReturnUrl ?>';">
</span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader">Kode</td>
			<td class="ewTableHeader">Coa</td>
			<td class="ewTableHeader">Category</td>
			<td class="ewTableHeader">Penyusutan (%)</td>
			<td class="ewTableHeader">COA Biaya Penyusutan</td>
			<td class="ewTableHeader">COA Akum.Penyusutan</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $asset_category->kode->CellAttributes() ?>>
<div<?php echo $asset_category->kode->ViewAttributes() ?>><?php echo $asset_category->kode->ListViewValue() ?></div></td>
			<td<?php echo $asset_category->coa->CellAttributes() ?>>
<div<?php echo $asset_category->coa->ViewAttributes() ?>><?php echo $asset_category->coa->ListViewValue() ?></div></td>
			<td<?php echo $asset_category->category->CellAttributes() ?>>
<div<?php echo $asset_category->category->ViewAttributes() ?>><?php echo $asset_category->category->ListViewValue() ?></div></td>
			<td<?php echo $asset_category->penyusutan->CellAttributes() ?>>
<div<?php echo $asset_category->penyusutan->ViewAttributes() ?>><?php echo $asset_category->penyusutan->ListViewValue() ?></div></td>
			<td<?php echo $asset_category->coabiaya->CellAttributes() ?>>
<div<?php echo $asset_category->coabiaya->ViewAttributes() ?>><?php echo $asset_category->coabiaya->ListViewValue() ?></div></td>
			<td<?php echo $asset_category->coaakum->CellAttributes() ?>>
<div<?php echo $asset_category->coaakum->ViewAttributes() ?>><?php echo $asset_category->coaakum->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
