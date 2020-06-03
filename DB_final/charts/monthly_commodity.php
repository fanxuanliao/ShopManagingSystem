<?php
    include("pdoInc.php");
    class dataset{
        public $label;
        public $dataList;
        function __construct($label, $dataList)
        {
            $this->label = $label;
            $this->dataList = $dataList;
        }
    }
    function populateDateDataset(){

    }

    $sth = $dbh->prepare(        
        "
        select 
            commodity_stats.c_category as category,
            commodity_stats.order_date as order_date,
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
                where customer_order.accept_date = '2020-05-26'
            ) sold_commodity on commodity.commodity_name = sold_commodity.com_name
        ) commodity_stats
        where commodity_stats.c_category = '家電'
        group by commodity_stats.order_date, commodity_stats.c_category
        "
        );
    $sth->execute();
    $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    $x = array();
    $y = array();
    foreach($rows as $row){
        array_push($x, $row['category']);
        array_push($y, $row['category_sum']);
    }
    $x = ["2020-05-01", "2020-05-20", "2020-05-28"];
    $y = [new dataset("ProductA", [10,20,30]), new dataset("ProductB", [15,5,10])];
    $data = ["x" => $x, "y" => $y, "debug" => "1"];
    echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
