<?php
$title = 'Upload grant';
includeTemplate('style/include/header.php', compact('title'));

require_once("progress.php");
$up = newUploadProgress();
uploadProgressHdr($up);
?>

<form enctype="multipart/form-data" method="post"
      onsubmit="document.getElementById('submit').disabled = true;"
      action="<?php echo "$masterPath?g=$id"; ?>" >
  <ul>

<?php
  if(!empty($_FILES["file"]) && !empty($_FILES["file"]["name"]))
  {
    echo "<li id=\"error_message\"><label>Upload failed:</label> ";
    switch($_FILES["file"]["error"])
    {
    case UPLOAD_ERR_INI_SIZE:
    case UPLOAD_ERR_FORM_SIZE:
      echo "file too big";
      break;

    case UPLOAD_ERR_PARTIAL:
    case UPLOAD_ERR_NO_FILE:
      echo "upload interrupted";
      break;

    default:
      echo "internal error";
    }
    echo "</li>";
  }
?>

    <li>
      <?php
        $error = (isset($_POST["submit"]) && empty($_FILES["file"]["name"]));
        $class = "description" . ($error? " required": "");
      ?>
      <label class="<?php echo $class; ?>">Upload a File</label>
      <div>
        <input type="hidden" name="max_file_size" value="<?php echo $iMaxSize; ?>"/>
        <?php uploadProgressField($up); ?>
	<input name="file" class="element file" type="file"/>
      </div>
      <p class="guidelines"><small>
	  Choose which file to upload. You can upload up to
          <?php echo humanSize($iMaxSize); ?>.
      </small></p>
    </li>

    <li class="buttons">
      <input type="hidden" name="submit" value="1"/>
      <input id="submit" type="submit" value="Upload"/>
      <?php uploadProgressHtml($up); ?>
    </li>
  </ul>
</form>

<div id="footer">
  <?php echo $banner; ?>
</div>

<?php
includeTemplate('style/include/footer.php');
?>
