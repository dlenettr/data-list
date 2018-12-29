<?php

require ROOT_DIR . "/language/" . $config['langs'] . "/datalist.lng";
require ENGINE_DIR . "/data/datalist.conf.php";

$js_data = "";
foreach( $data_list_conf as $key => $attr ) {
	if ( is_array( $attr[2] ) ) {
		$js_data .= "<div class=\"col-md-" . $attr[1] . "\"><select class=\"form-control dl_{$key}\" name=\"data[{NUM}][" . $key . "]\">";
		foreach( $attr[2] as $_k => $_v ) {
			if ( count( $attr ) == 4 ) {
				$js_data .= "<option value=\"" . $_k . "\"" . ( $_k == $attr[3] ? " selected" : "" ) . ">" . $_v . "</option>";
			} else {
				$js_data .= "<option value=\"" . $_k . "\">" . $_v . "</option>";
			}
		}
		$js_data .= "</select></div>";
	} else {
		$js_data .= "<div class=\"col-md-" . $attr[1] . "\"><input type=\"text\" class=\"form-control dl_{$key}\" name=\"data[{NUM}][" . $key . "]\" value=\"\" placeholder=\"" . $attr[0] . "\" /></div>";
	}
}

$dataListHeader = '<div class="row"><div class="col-md-1">' . $lang['data_list_0'] . '</div>';
foreach( $data_list_conf as $key => $attr ) { $dataListHeader .= "<div class=\"col-md-" . $attr[1] . "\">" . $attr[0] . "</div>"; }
$dataListHeader .= '<div class="col-md-1">' . $lang['data_list_1'] . '</div></div>';
$dataListTemplate = '<div class="row" data-list="{NUM}"><div class="col-md-1">{NUM}</div>' . $js_data . '<div class="col-md-1"><button class="btn btn-sm btn-danger" onclick="removeList({NUM});"><i class="fa fa-trash"></i> ' . $lang['data_list_2'] . '</button></div></div>';

include ENGINE_DIR . "/inc/datalist/assets.datalist.php";