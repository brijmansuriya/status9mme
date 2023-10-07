<?php
function search($pin_url) {
    $curl = curl_init($pin_url);
    curl_setopt($curl, CURLOPT_URL, $pin_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($curl);
    curl_close($curl);
    return $res;
}
echo "Pinterest Image Downloader";
?>
<title>Pinterest Image Downloader</title>
<form method="POST">
    <input type="text" name="url" placeholder=" https://in.pinterest.com/pin/658299670523298984/" value="<?php if(isset($_POST['url'])){echo $_POST['url'];} ?>">
    <input type="submit" name="submit">
    <?php
    if (isset($_POST['submit'])) {
        if (empty($_POST['url'])) {
            echo "<br />Please input the URL";
        }
        else {
            $ser_pint = search($_POST['url']);
            $pint_im = explode('href="https://i.', $ser_pint);
            if (isset($pint_im[1])) {
                $pint_im2 = explode('" as="image"/>', $pint_im[1]);
?>
</form>
<div class="preview">
    Preview Image
    <br />
    <img width="300px" src="<?php echo "https://i.$pint_im2[0]"?>">
</div>
<div class="download">
    <a href="<?php echo "https://i.$pint_im2[0]"?>" target="_blank">Download the Original Size</a>
</div>
<?php
            } else {
                echo "<br />Please input the correct URL.";
            }
        } 
    }

?>