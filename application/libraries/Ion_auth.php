<?php 
foreach($allResults as $key=>$value){
?>
<TR>
<?php

if (in_array("IPO3_1", $value)) {
?>
<TD WIDTH="30" ALIGN="CENTER"><input type="checkbox" name="sp1" value="IPO3_1" DISABLED></TD>
<?php
} else {
?>
<TD WIDTH="30" ALIGN="CENTER"><input type="checkbox" name="sp1" value="IPO3_1" ></TD>
<?php
}
?>
<TD WIDTH="210" ALIGN="LEFT">IPO3 - 1st</TD>
<TD WIDTH="40" ALIGN="CENTER">$120</TD>
<TD WIDTH="270" ALIGN="CENTER"><?php echo $allResults[0][name]; ?></TD> 
</TR>
<?php } ?>