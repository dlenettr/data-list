<?php

$dataListAssets = <<< HTML
<style>
#dlList { border-top: 1px solid #ddd; border-left: 0; border-right: 0; padding: 5px 0; }
#dlList .row:first-child { line-height: 35px; }
#dlList .row { margin: 0; border-bottom: 1px solid #ddd; padding: 3px 0; }
#dlList .row:nth-child(even) { background: #fefefe; }
#dlList .row:nth-child(odd) { background: #f0f0f0; }
</style>
<script>
function addList() {
	num = parseInt( $("#dlLastRow").val() ) + 1;
	row = '{$dataListTemplate}'.replace( /{NUM}/g, num );
	$("#dlList").append( row );
	$("#dlLastRow").val( num );
}
function removeList( id ) {
	num = parseInt( $("#dlLastRow").val() ) + 1;
	$("div[data-list='" + id + "']").remove();
	$("#dlLastRow").val( num );
}
</script>
HTML;

$dataListAddnews = <<< HTML
{$dataListAssets}
<div class="form-group">
	<div class="row">
		<div class="col-md-12" id="dlList">
			{dataListHeader}
			{dataListFirstRow}
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="pull-right">
				<button class="btn btn-sm btn-success" type="button" onclick="addList();"><i class="fa fa-plus"></i> {$lang['data_list_3']}</button>
			</div>
		</div>
	</div>
	<input type="hidden" id="dlLastRow" value="1" />
</div>
HTML;

$dataListEditnews = <<< HTML
{$dataListAssets}
<div class="form-group">
	<div class="row">
		<div class="col-md-12" id="dlList">
			{dataListHeader}
			{dataListRows}
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="pull-right">
				<button class="btn btn-sm btn-success" type="button" onclick="addList();"><i class="fa fa-plus"></i> {$lang['data_list_3']}</button>
			</div>
		</div>
	</div>
	<input type="hidden" id="dlLastRow" value="{last}" />
</div>
HTML;

?>