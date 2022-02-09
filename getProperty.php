
<?php 
$cid=$_GET["cid"];
if($cid=='1' || $cid=='3' || $cid=='12' || $cid=='18'){

?>
<label>Bedrooms </label><select class="select"  name="property_bedrooms">
<option value="">-- Number of Bedroom --</option>
<?php for($i=1;$i<11;$i++){ ?>
<option value="<?php echo $i?>"><?php echo $i?></option>
<?php } ?>
<option value="11">10+</option></select><br />

<!--<label>Bathrooms </label><select name="property_bathrooms" class="select">
<option value="">-- Number of Bathrooms --</option>
<?php //for($j=1;$j<11;$j++){ ?>
<option value="<?php //echo $j?>"><?php //echo $j?></option>
<?php // } ?>
<option value="11">10+</option></select><br />-->

<label>Floor Number  </label><select class="select" name="property_floor_number">

<option value=""  selected="">-- Floor Number --</option>
						<option value="Under Construction">Under Construction</option>
						<option value="Basement">Basement</option>
						<option value="Ground Floor">Ground Floor</option>
						<option value="Mezzanine Floor">Mezzanine Floor</option>
						<?php for($i=1;$i<41;$i++){ ?>
						<option value="<?php echo $i?>"><?php echo $i?></option>
						<?php } ?>
						<option value="41">More than 40</option></select>
<?php }elseif($cid=='10' || $cid=='4' || $cid=='8' || $cid=='13'){ ?>

<?php } elseif($cid=='11' || $cid=='2'){ ?>
<label>Bedrooms </label><select class="select"  name="property_bedrooms">
<option value="">-- Number of Bedroom --</option>
<?php for($i=1;$i<11;$i++){ ?>
<option value="<?php echo $i?>"><?php echo $i?></option>
<?php } ?>
<option value="11">10+</option></select><br />

<?php } elseif($cid=='5' || $cid=='6'|| $cid=='7' || $cid=='7' || $cid=='14' || $cid=='15' || $cid=='29'){ ?>
<label>Floor Number  </label><select class="select" name="property_floor_number">

<option value=""  selected="">-- Floor Number --</option>
						<option value="Under Construction">Under Construction</option>
						<option value="Basement">Basement</option>
						<option value="Ground Floor">Ground Floor</option>
						<option value="Mezzanine Floor">Mezzanine Floor</option>
						<?php for($i=1;$i<41;$i++){ ?>
						<option value="<?php echo $i?>"><?php echo $i?></option>
						<?php } ?>
						<option value="41">More than 40</option></select>
						<?php } ?>