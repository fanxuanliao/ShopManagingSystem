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

    $name_query = $dbh->prepare(        
        "
        select 
            distinct commodity_name
        from commodity"
    );
    $name_query->execute();
    $name_set = $name_query->fetchAll(PDO::FETCH_ASSOC);

    $data = ["name_set" => $name_set, "category_set" => $category_set];
    echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
?>