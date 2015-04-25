<?php session_start() ?>
<?php require 'connect.php' ?>
<body>
<div align="center "id="SubPage">Images</div>
<div align="Center" id="SettingsBlock">
<div id="SettingsName">Add Image: <span id="AddImage"></span></div>
<div align="left">
<span class="FormText">Image URL: </span>
<input type="text" value="<?php echo $image ?>" id="new_image" />
<input type="submit" value="Add" onClick="AddImage()" />
</div>
</div>
<div align="center" style="width: 600px;">
<div align="left" id="UserImages"><?php include 'image.php' ?></div>
</div>
