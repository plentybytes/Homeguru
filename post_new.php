<?php
	/*
	 * Script:    DataTables server-side script for PHP and MySQL
	 * Copyright: 2010 - Allan Jardine
	 * License:   GPL v2 or BSD (3-point)
	 */
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
	$aColumns = array( 'property_address', 'property_total_price', 'property_avg_price');
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "p_Id";
	
	/* DB table to use */
	$sTable = "Property_sold_info";
	
	
/*$sql_details = array(
    'user' => 'homeguru12',
    'pass' => 'Home@123',
    'db'   => 'homeguru12',
    'host' => 'homeguru12.db.8477334.hostedresource.com'
);*/
	/* Database connection information */
	$gaSql['user']       = "homeguru12";
	$gaSql['password']   = "Home@123";
	$gaSql['db']         = "homeguru12";
	$gaSql['server']     = "homeguru12.db.8477334.hostedresource.com";
	
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
	 * no need to edit below this line
	 */ 
	
	/* 
	 * MySQL connection
	 */
	$con =  mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) or
		die( 'Could not open connection to server' );
	
	mysql_select_db( $gaSql['db'], $con ) or 
		die( 'Could not select database '. $gaSql['db'] );
	
	
	/* 
	 * Paging
	 */
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
			mysql_real_escape_string( $_GET['iDisplayLength'] );
	}
	//Limit 0, 20
	
	
	/*
	 * Ordering
	 */
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
				 	".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}
	}
	
	
	/* 
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
	$sWhere = "";
	if ( $_GET['sSearch'] != "" )
	{
		// $sWhere = "WHERE postal_code != 'NULL' AND ( ";
		/*for ( $i=1 ; $i<count($aColumns) ; $i++ )
		{
		// $i=0;
		// $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' OR ";
		}
		// $sWhere = substr_replace( $sWhere, "", -3);
		// $sWhere .= "GROUP BY Property_sold_info.street".')';
		$i=0;*/
		$sHaving = " HAVING ( "."property_address"." LIKE '%".mysql_real_escape_string($_GET['sSearch'])."%' )";
		
	} //else{ $sWhere = " WHERE Property_sold_info.street " ." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.1])."%' )" ;}
	
	
	/* Individual column filtering */
	/*for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
		}
	}*/
	
	
	/*
	 * SQL queries
	 * Get data to display  SELECT CONCAT(street,'<br />',GROUP_CONCAT(postal_code)) FROM `Property_sold_info` GROUP BY street LIMIT 100
	 */	//SELECT distinct user.user_first_name AS user_first_name , cities.name AS user_address,area.postcode AS postcode FROM 	//user INNER JOIN cities ON user.state_id = cities.state_id INNER JOIN area WHERE user.user_type_agent='YES'	//".str_replace(" , ", " ", implode(", ", $aColumns))."
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS CONCAT(Property_sold_info.street,',',Property_sold_info.city,',', Property_sold_info.district,'<br/>',GROUP_CONCAT(Property_sold_info.postal_code)) AS property_address, CAST(AVG( Property_sold_info.sold_price ) AS DECIMAL(12,2)) AS property_avg_price, CAST(Property_sold_info.sold_price AS DECIMAL(12,2)) AS property_total_price
		FROM Property_sold_info
		$sWhere" . " GROUP BY Property_sold_info.street " .
		"$sHaving
		$sOrder
		$sLimit
	";
	//PRINT($sQuery);
	$rResult = mysqli_query( $sQuery, $con ) or die(mysqli_error()); 
	
	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = mysqli_query( $sQuery, $con ) or die(mysqli_error());
	$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
	";
	$rResultTotal = mysqli_query( $sQuery, $con ) or die(mysqli_error());
	$aResultTotal = mysql_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	
	
	/*
	 * Output
	 */
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
	
	while ( $aRow = mysql_fetch_array( $rResult ) )
	{
		$row = array();
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( $aColumns[$i] == "version" )
			{
				/* Special output formatting for 'version' column */
				$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
			}
			else if ( $aColumns[$i] != ' ' )
			{
				/* General output */
				$row[] = $aRow[ $aColumns[$i] ];
			}
		}
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
?>