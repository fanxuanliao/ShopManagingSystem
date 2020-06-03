<?php
    include("pdoInc.php");
    if(isset($_GET['order_date'])){
        $sth = $dbh->prepare(        
            "
            select 
                commodity_stats.c_category as category,
                sum(commodity_stats.c_price * commodity_stats.c_amount) as category_sum
            from
            (
                select 
                    commodity.commodity_name as c_name,
                    commodity.category as c_category, 
                    commodity.sell_price as c_price, 
                    commodity.user_id as c_user_id, 
                    sold_commodity.amount as c_amount,
                    sold_commodity.order_date as order_date
                from commodity
                inner join
                (
                    select 
                        order_include.com_name, 
                        order_include.user_id, 
                        customer_order.accept_date as order_date,
                        amount
                    from customer_order
                    inner join order_include 
                    on order_include.order_number = customer_order.order_number
                    where customer_order.accept_date = ?

                ) sold_commodity on commodity.commodity_name = sold_commodity.com_name
            ) commodity_stats
            group by commodity_stats.c_category
            "
            );
        $sth->execute(array($_GET['order_date']));
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        $x = array();
        $y = array();
        foreach($rows as $row){
            array_push($x, $row['category']);
            array_push($y, $row['category_sum']);
        }
        $data = ["x" => $x, "y" => $y, "debug" => $rows];
        echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }
?>