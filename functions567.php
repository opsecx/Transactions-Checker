<?php

	function strip_all($in)
	{
		$in = trim($in);
		$in = stripslashes($in);
		$in = htmlspecialchars($in);
		return $in;
	}

	function validate_tnam1($in)
	{
		if (empty($in))
		{
			return false;
		}
		strip_all($in);
		if (strlen($in) <> 45)
		{
			return false;
		}
		$reg_tnam1 = '/tnam1[a-zA-Z0-9]{40}$/i';
		return preg_match($reg_tnam1, $in);
	}

	function validate_integer($in)
	{
		if (empty($in))
		{
			return false;
		}
		strip_all($in);
		if (strlen($in) > 25)
		{
			return false;
		}
		$reg_int = '/\d+$/i';
		return preg_match($reg_int, $in);
	}

	function validate_proposal_id($in)
	{
		return validate_integer($in);
	}

	function validate_double($in)
	{
		if (empty($in))
		{
			return false;
		}
		$in = strip_all($in);
		if (strlen($in) > 25)
		{
			return false;
		}
		$reg_double = '/^\d*\.?\d+$/i';
		return preg_match($reg_double, $in);
	}

	function hyperlink_address($in, $mode_arg)
	{
		$in = strip_all($in);
		$mode_arg = strip_all($mode_arg);
		if (validate_tnam1($in) == false)
		{
			die('wrong internal parameter call');
		}
		$uri = strip_all($_SERVER['REQUEST_URI']);
		$parts = explode('?', $uri);
		$uri = array_shift($parts);
		$servername = strip_all($_SERVER['HTTP_HOST']);
		$name = getNameFromAddress($in);
		$newlink = '//' . $servername . $uri . '?address=' . $in . '&mode=' . $mode_arg;
		$returnstring = '<a href="' . $newlink . '" style="text-decoration: none">' . $name . '</a>';
		return $returnstring;
	}

	function hyperlink_proposal($in, $mode_arg)
	{
		$uri = strip_all($_SERVER['REQUEST_URI']);
		$parts = explode('?', $uri);
		$uri = array_shift($parts);
		$servername = strip_all($_SERVER['HTTP_HOST']);
		$newlink = '//' . $servername . $uri . '?proposal_id=' . $in;
		$returnstring = '<a href="' . $newlink . '">' . $in . '</a>';
		return $returnstring;
	}

	// Initialize an empty hash map
	$addressToName = [];

	function loadPlayerData()
	{
		global $addressToName;

		$filename = 'players.csv';
		$file = fopen($filename, 'r');

		if ($file === false)
		{
			die("Error opening file: $filename");
		}

		// Read each line from the CSV file
		while (($row = fgetcsv($file)) !== false) {
			// Assuming the CSV has two columns: address and name
			$name = $row[0];
			$address = $row[1];

			// Add the address and name to the hash map
			$addressToName[$address] = $name;
		}

		// Close the file
		fclose($file);
	}

	// Returns the moniker associated with the specified Namada address, or returns the address if not found
	function getNameFromAddress($address)
	{
		global $addressToName;

		if (isset($addressToName[$address]))
		{
			return $addressToName[$address];
		}
		else
		{
			return $address;
		}
	}