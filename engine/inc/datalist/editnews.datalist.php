<?php

require ENGINE_DIR . "/inc/datalist/global.datalist.php";

$dataListRows = "";

$newsid = intval( $_GET['id'] );
$sel_data = $db->super_query( "SELECT data FROM " . PREFIX . "_data_list WHERE news_id = '" . $newsid . "'");

if ( ! empty( $sel_data['data'] ) ) {
    $data_list = json_decode( $sel_data['data'], true );
    $n = 1;
    foreach( $data_list as $c => $data ) {
        $dataListRow = "<div class=\"row\" data-list=\"{$n}\"><div class=\"col-md-1\">{$n}</div>";
        foreach( $data_list_conf as $key => $attr ) {
            $value = $data[$key];
            if ( is_array( $attr[2] ) ) {
                $dataListRow .= "<div class=\"col-md-" . $attr[1] . "\"><select class=\"form-control dl_{$key}\" name=\"data[{$n}][" . $key . "]\">";
                foreach( $attr[2] as $_k => $_v ) {
                    $dataListRow .= "<option value=\"" . $_k . "\"" . ( $_k == $value ? " selected" : "" ) . ">" . $_v . "</option>";
                }
                $dataListRow .= "</select></div>";
            } else {
                $dataListRow .= "<div class=\"col-md-" . $attr[1] . "\"><input type=\"text\" class=\"form-control dl_{$key}\" name=\"data[{$n}][{$key}]\" value=\"{$value}\" placeholder=\"" . $attr[0] . "\" /></div>";
            }
        }
        $dataListRow .= "<div class=\"col-md-1\"><button class=\"btn btn-sm btn-danger\" onclick=\"removeList({$n});\"><i class=\"fa fa-trash\"></i> " . $lang['data_list_2'] . "</button></div></div>";
        $dataListRows .= $dataListRow;
        $n++;
    }
}

$dataListLast = $n-1;

$dataListHtml = str_replace( ['{dataListHeader}', '{dataListRows}', '{last}'], [$dataListHeader,$dataListRows,$dataListLast], $dataListEditnews );
