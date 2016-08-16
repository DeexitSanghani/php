<?php
class Database 
{//
	var $_DB;
	var $_dbName;
	var $_dbHost;
	var $_dbUser;
	var $_dbPass;
	var $_lastHandle=false;

	///////// Constructor /////////
	function Database($DB='mysql', $dbHost=false, $dbName=false, $dbUser=false, $dbPass=false) 
	{
		$this->_DB = $DB?$DB:'mysql';
		$this->_dbName = $dbName?$dbName:$GLOBALS['dbName'];
		$this->_dbHost = $dbHost?$dbHost:$GLOBALS['dbHost'];
		$this->_dbUser = $dbUser?$dbUser:$GLOBALS['dbUser'];
		$this->_dbPass = $dbPass?$dbPass:$GLOBALS['dbPass'];
		switch ($this->_DB) {
		case 'mysql':
			@mysql_connect($this->_dbHost, $this->_dbUser, $this->_dbPass)
 				or die("Database connection error!");
			@mysql_select_db($this->_dbName)
 				or die("Could not locate database!");
 			break;
 		default: die("Database system unknown!");
		}
	}

	///////////// Performs a generic SQL query./////////
	function Query($query)
	{
	//print $this->_DB;
		switch ($this->_DB) {
			case 'mysql':
			    
				//print "<hr size=1 noshade>".$query."<hr size=1 noshade>";
				$handle = mysql_query($query);
				if(!$handle)
				{die(mysql_error());}
				break;
		}
		if($this->ErrorNo() > 0) 
		{
		   echo $query;
			print("<hr />Database Error: ".$this->Error()."><br><pre >");
			print_r(debug_backtrace());
			die("</pre><hr />");
			
		};
		$this->_lastHandle = $handle;
		return $handle;
	}

	
	///////////// Gets next row of a query. Returns false when finished.////////////////////////
	function GetRow($handle=false) 
	{
		if ($handle) $handle = $this->_lastHandle;
		switch ($this->_DB) 
		{
			case 'mysql':
				$row = mysql_fetch_assoc($handle);
				break;
		}
		return $row;
	}

	
	
	////////////// Returns the database error for a specific query.//////////////////
	function Error($handle=false) 
	{
		switch ($this->_DB) 
		{
			case 'mysql':
				$err = ($handle)?mysql_error($handle):mysql_error();
				break;
		}
		return $err;
	}

	/////////////////// Returns the database error  for a specific query ////////
	function ErrorNo($handle=false) 
	{
		switch ($this->_DB) 
		{
			case 'mysql':
				$err_no = ($handle)?mysql_errno($handle):mysql_errno();
				break;
		}
		return $err_no;
	}

	//////////////// Returns all the info from a query /////////////////////
	function GetAllRows($handle=false) 
	{
		if ($handle) $handle = $this->_lastHandle;
		$ret = array();
		switch ($this->_DB) 
		{
			case 'mysql':
				while ($row = mysql_fetch_assoc($handle)) 
				{
					$ret[] = $row;
				}
				break;
		}
		return $ret;
	}
	
	

///////////////// Inserts a row into database //////////////
	function Insert($data, $table) 
	{
		$names = "";
		$values = "";
		foreach ($data as $name=>$value) 
		{
			$names .= "`$name`, ";
			if(strtoupper($value) != "NULL")
				$values .= "'".addslashes($value)."', ";
			else
				$values .= addslashes($value).", ";
		}
		$names = substr($names, 0, strlen($names)-2);
		$values = substr($values, 0, strlen($values)-2);
                $query = "INSERT INTO `$table` ($names) VALUES ($values)";
		//print $query."<br>";
                //die($query);
		return $this->Query($query);
	}
	
	

	/////////////////////// Updates the database ////////////
	function Update($data, $table, $conditions=false)
	{
		$query = "UPDATE `$table` SET ";
		foreach ($data as $name=>$value) 
		{
			if(strtoupper($value) != "NULL")
				$query .= "`$name` = '".addslashes($value)."', ";
			else
				$query .= "`$name` = ".addslashes($value).", ";
			
		}
		$query = substr($query, 0, strlen($query)-2);
		if ($conditions) $query .= " WHERE $conditions";
		//print $query."<br>";die;
		return $this->Query($query);
	}



        // Delete from the database
        function Delete($table, $conditions=false) 
		{
                $query = "DELETE FROM `$table`";
                if ($conditions) $query .= " WHERE $conditions";
				//print $query;die;
                return $this->Query($query);
        }

      

	function LastInsert($table)
	{
		$query="select LAST_INSERT_ID() from `$table`";
		$res=$this->Query($query);
		list($lastid)=mysql_fetch_row($res);
		$this->Free($res);
		return $lastid;
	}
	
	function CountRow($table,$where)
	{
		$query="select * from `$table` $where";
		$res=$this->Query($query);
		
		
		return mysql_num_rows($res);
	}
	
	function CheckRecord($table,$field,$where)
	{
		 $query="select $field from `$table` $where";
		//echo "<br/>";
		$res=$this->Query($query);
		if(mysql_num_rows($res)>0){
			list($id)=mysql_fetch_row($res);
		}else{
			$id=mysql_num_rows($res);
		}
		
		return $id;
	}

	function MAX($fld, $table)
	{
		$query = "SELECT MAX(`$fld`) maxVal FROM `$table`";
		$res = $this->Query($query);
		$rslt = mysql_fetch_assoc($res);
		$max = $rslt["maxVal"];
		$this->Free($res);
		return $max;
	}
	
        function Free($res)
        {
            mysql_free_result($res);
        }

	
	//get Database Name
	function getDBName()
	{
		return $this->_dbName;
	}
 }
?>
