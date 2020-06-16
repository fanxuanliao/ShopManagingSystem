<?php
    include("pdoInc.php");
    function createDateRangeArray($strDateFrom,$strDateTo)
    {
        // takes two dates formatted as YYYY-MM-DD and creates an
        // inclusive array of the dates between the from and to dates.

        // could test validity of dates here but I'm already doing
        // that in the main script

        $aryRange=array();

        $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
        $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

        if ($iDateTo>=$iDateFrom)
        {
            array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
            while ($iDateFrom<$iDateTo)
            {
                $iDateFrom+=86400; // add 24 hours
                array_push($aryRange,date('Y-m-d',$iDateFrom));
            }
        }
        return $aryRange;
    }
    $cateSearch = $dbh->prepare(        
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
                where customer_order.accept_date >= ? and customer_order.accept_date <= ?
            ) sold_commodity on commodity.commodity_name = sold_commodity.com_name
        ) commodity_stats
        where commodity_stats.c_category = ?
        group by commodity_stats.order_date, commodity_stats.c_category
        "
        );
    $comSearch = $dbh->prepare(
        "select 
            commodity_stats.c_name,
            commodity_stats.order_date,
            sum(commodity_stats.c_price * commodity_stats.c_amount) as commodity_sum
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
                where customer_order.accept_date >= ? and customer_order.accept_date <= ?
            ) sold_commodity on commodity.commodity_name = sold_commodity.com_name
        ) commodity_stats
        where commodity_stats.c_name = ?
        group by commodity_stats.order_date, commodity_stats.c_name");
    
    
    $searchType = $_GET['search-type'];
    $label = $_GET['label'];
    $startDate = $_GET['start-date'];
    $endDate =$_GET['end-date'];
    
    if($searchType == 'c_category'){
        $cateSearch->execute(array($startDate, $endDate, $label));
        $rows = $cateSearch->fetchAll(PDO::FETCH_ASSOC);
        $x = createDateRangeArray($startDate, $endDate);
        $y = array_fill(0, count($x), 0);
        foreach($rows as $row){
            $index = array_search($row['order_date'], $x);
            $y[$index] = $row['category_sum'];
        }
        $data = ["x" => $x, "y" => $y, "label" => $label];
        echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

    }else if($searchType == 'c_name'){
        $comSearch->execute(array($startDate, $endDate, $label));
        $rows = $comSearch->fetchAll(PDO::FETCH_ASSOC);
        $x = createDateRangeArray($startDate, $endDate);
        $y = array_fill(0, count($x), 0);
        foreach($rows as $row){
            $index = array_search($row['order_date'], $x);
            $y[$index] = $row['commodity_sum'];
        }
        $data = ["x" => $x, "y" => $y, "label" => $label];
        echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }
