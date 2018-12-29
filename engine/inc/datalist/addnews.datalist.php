<?php

require ENGINE_DIR . "/inc/datalist/global.datalist.php";

$dataListFirstRow = str_replace( '{NUM}', 1, $dataListTemplate );

$dataListHtml = str_replace( ['{dataListHeader}', '{dataListFirstRow}'], [$dataListHeader,$dataListFirstRow,2], $dataListAddnews );
