<?php
include_once 'init.php';

function getLastInsertionDate()
{
	$log = $GLOBALS['db']->log;
	
	$result = $log->find(array('type'=>'insertion'))->sort(array('date'=>-1))->limit(1);

	foreach ($result as $value) {
		return $value['date']->sec;
	}
}

function formatRow($id, $value)
{
	$result = '';
	if(!isset($value['published']) or !$value['published'])
	{
		if (isset($value['approved']) && $value['approved'])
		{
			$p = "APPROVATO";
			$action = '<a href="#" onclick="return ritira(\''.$id.'\', $(this))">Ritira</a>';
		}
		else
		{
			$p = "NON APPROVATO";
			$action = '<a href="#" onclick="return approva(\''.$id.'\', $(this))">Approva</a>';
		}
	}
	else
	{
		$p='PUBBLICATO';
		$action = "Pubblicato";
	}
	$result.= "<tr id=\"".$id."\">";
	$result.= "<td>"."<a href=$id target=\"_blank\">".$value['data']['title']."</a></td>";
	$result.= "<td>".$value['data']['votanti']."</td>";
	$result.= "<td>".$value['data']['favorevoli']."</td>";
	$result.= "<td>".$value['data']['contrari']."</td>";
	$result.= "<td>".$value['data']['astenuti']."</td>";

	$time = strtotime($value['data']['date']);
	$result.= "<td data-value=".$time.">".date("d-m-Y", $time)."</td>";
	$result.= "<td>".$value['data']['description']."</td>";
	$result.= "<td>".$p."</td>";
	$result.= '<td class=\"action\">'.$action.'</td>';
	$result.= "</tr>"."\n";

	return $result;
}