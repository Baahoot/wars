<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if($admin != '1'): ?>
<div id="Page" align="center">Operations: (Coming Soon)</div>
<?php else: ?>
<div id="Page" align="center">Operations: </div>
<?php
$operations_list = mysql_query("SELECT * FROM operation_list WHERE level<=".$level." ORDER BY level DESC");
while($operation = mysql_fetch_array($operations_list)) {
$op_name = $operation['name'];
$op_energy = $operation['energy'];
$op_desc = $operation['desc'];
$op_time_desc = $operation['time_name'];
echo
'<table width="600" align="center" id="operationBlock">
  <tr>
    <td colspan="3">
    <div id="MissionName">
    '.$operation['name'].'
    <div id="OperationTime">
	<div id="MissionMastery">Time Left: '.$op_time_desc.'</div>
    </div>
    </div>
    </td>
  </tr>  
  <tr>
    <td width="242" valign="top" style="border-right: 1px dotted #FFFFFF;">
    <div id="MissionReqTitle">Requirements: </div>
    <div id="MissionReq">
    &#8226; Energy: '.$op_energy.' <br />
	&#8226; Objective: '.$op_desc.'
    </div>
    </td>
    <td width="242" valign="top" style="border-right: 1px dotted #FFFFFF;">
    <div id="MissionPayTitle">Payout: </div>
    <div id="MissionPayout">
    &#8226; Boss Points: '.number_format($operation['payout']).'
    </div>    
    </td>
    <td width="100" align="center">
    <input type="submit" value="Begin" onclick="operation('.$operation['id'].')" id="operationButton" />
    </td>
  </tr>
</table>';
}
?>
<?php endif; ?>
