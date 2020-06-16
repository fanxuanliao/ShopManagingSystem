<?php 
    include("pdoInc.php");

    $category_query = $dbh->prepare(        
        "
        select 
	        distinct category 
        from commodity
        "
        );
    $category_query->execute();
    $category_set = $category_query->fetchAll(PDO::FETCH_ASSOC);


    $commodity_query = $dbh->prepare(        
        "
        select 
            distinct commodity_name
        from commodity"
    );
    $commodity_query->execute();
    $commodity_set = $commodity_query->fetchAll(PDO::FETCH_ASSOC);

    $data = ["commodity_set" => $commodity_set, "category_set" => $category_set];
    echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
?>