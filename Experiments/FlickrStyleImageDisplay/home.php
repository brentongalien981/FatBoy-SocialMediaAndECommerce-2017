<?php
define("CONTAINER_WIDTH", 990);

$s = "<a data-flickr-embed=\"true\"  href=\"https://www.flickr.com/photos/151625521@N05/36248325400/in/dateposted-public/\" title=\"jet5\"><img src=\"https://farm5.staticflickr.com/4352/36248325400_0f035711ef_o.jpg\" width=\"870\" height=\"588\" alt=\"jet5\"></a><script async src=\"//embedr.flickr.com/assets/client-code.js\" charset=\"utf-8\"></script>";
$x = "<a data-flickr-embed=\"true\"  href=\"https://www.flickr.com/photos/151625521@N05/36248325400/in/dateposted-public/\" title=\"jet5\"><img src=\"https://farm5.staticflickr.com/4352/36248325400_fc82c79844_q.jpg\" width=\"150\" height=\"150\" alt=\"jet5\"></a><script async src=\"//embedr.flickr.com/assets/client-code.js\" charset=\"utf-8\"></script>";

//$z = array();
$z[0] = "<a data-flickr-embed=\"true\"  href=\"https://www.flickr.com/photos/151625521@N05/36635541995/in/dateposted-public/\" title=\"kp1\"><img src=\"https://farm5.staticflickr.com/4369/36635541995_39529e8dec_o.jpg\" width=\"750\" height=\"503\" alt=\"kp1\"></a><script async src=\"//embedr.flickr.com/assets/client-code.js\" charset=\"utf-8\"></script>";
$z[1] = "<a data-flickr-embed=\"true\"  href=\"https://www.flickr.com/photos/151625521@N05/36635541995/in/dateposted-public/\" title=\"kp1\"><img src=\"https://farm5.staticflickr.com/4369/36635541995_18eaebda3f_q.jpg\" width=\"150\" height=\"150\" alt=\"kp1\"></a><script async src=\"//embedr.flickr.com/assets/client-code.js\" charset=\"utf-8\"></script>";
$z[2] = "<a data-flickr-embed=\"true\"  href=\"https://www.flickr.com/photos/151625521@N05/36248325990/in/dateposted-public/\" title=\"jet2\"><img src=\"https://farm5.staticflickr.com/4331/36248325990_09a51fdf76_o.jpg\" width=\"1920\" height=\"1080\" alt=\"jet2\"></a><script async src=\"//embedr.flickr.com/assets/client-code.js\" charset=\"utf-8\"></script>";
$z[3] = "<a data-flickr-embed=\"true\"  href=\"https://www.flickr.com/photos/151625521@N05/36597937226/in/dateposted-public/\" title=\"jet1\"><img src=\"https://farm5.staticflickr.com/4370/36597937226_e64d44568d_o.jpg\" width=\"1920\" height=\"1080\" alt=\"jet1\"></a><script async src=\"//embedr.flickr.com/assets/client-code.js\" charset=\"utf-8\"></script>";
$z[4] = "<a data-flickr-embed=\"true\"  href=\"https://www.flickr.com/photos/151625521@N05/36597937276/in/dateposted-public/\" title=\"gun\"><img src=\"https://farm5.staticflickr.com/4403/36597937276_922edb6d5b_o.jpg\" width=\"1500\" height=\"1500\" alt=\"gun\"></a><script async src=\"//embedr.flickr.com/assets/client-code.js\" charset=\"utf-8\"></script>";
$z[5] = "<a data-flickr-embed=\"true\"  href=\"https://www.flickr.com/photos/151625521@N05/36248325400/in/dateposted-public/\" title=\"jet5\"><img src=\"https://farm5.staticflickr.com/4352/36248325400_0f035711ef_o.jpg\" width=\"870\" height=\"588\" alt=\"jet5\"></a><script async src=\"//embedr.flickr.com/assets/client-code.js\" charset=\"utf-8\"></script>";
$z[6] = "<a data-flickr-embed=\"true\"  href=\"https://www.flickr.com/photos/151625521@N05/36506535381/in/dateposted-public/\" title=\"jet4\"><img src=\"https://farm5.staticflickr.com/4393/36506535381_4982df9f49_o.jpg\" width=\"773\" height=\"500\" alt=\"jet4\"></a><script async src=\"//embedr.flickr.com/assets/client-code.js\" charset=\"utf-8\"></script>";
$z[7] = "<a data-flickr-embed=\"true\"  href=\"https://www.flickr.com/photos/151625521@N05/36506535541/in/dateposted-public/\" title=\"jet3\"><img src=\"https://farm5.staticflickr.com/4421/36506535541_acaf688466_o.png\" width=\"540\" height=\"540\" alt=\"jet3\"></a><script async src=\"//embedr.flickr.com/assets/client-code.js\" charset=\"utf-8\"></script>";
$z[8] = "<a data-flickr-embed=\"true\"  href=\"https://www.flickr.com/photos/151625521@N05/35835207223/in/dateposted-public/\" title=\"space5\"><img src=\"https://farm5.staticflickr.com/4331/35835207223_a5a82d80db_o.jpg\" width=\"720\" height=\"450\" alt=\"space5\"></a><script async src=\"//embedr.flickr.com/assets/client-code.js\" charset=\"utf-8\"></script>";
$z[9] = "<a data-flickr-embed=\"true\"  href=\"https://www.flickr.com/photos/151625521@N05/36643940805/in/dateposted-public/\" title=\"space3\"><img src=\"https://farm5.staticflickr.com/4421/36643940805_80475d514b_o.jpg\" width=\"1680\" height=\"1050\" alt=\"space3\"></a><script async src=\"//embedr.flickr.com/assets/client-code.js\" charset=\"utf-8\"></script>";
//$href_value = ;

$counter_index = 0;

//while ($counter_index < count($z)) {
//
//    $photo_embed_codes = $z;
////    display_row_of_photos($photo_embed_codes);
//    echo "shit";
//    $counter_index++;
//}
//return;


while ($counter_index < count($z)) {

    $photo_embed_codes = $z;
    display_row_of_photos($photo_embed_codes, $counter_index);
}


//    echo "<img src='" . "{$src}" . "' width='197' height='197'>";

?>


<!--<a href="--><? //= $href ?><!--"><img src="--><? //= $src ?><!--" width="197" height="197"></a>-->


<!--<a href="--><? //= $href ?><!--" data - flickr - embed="true"><img src="--><? //= $src ?><!--" width="197" height="197"></>-->


<?php
/**
 * @param $attribute
 * @return string
 */
function get_attribute_value($s, $attribute)
{

    $start_index = strpos($s, "$attribute", 0);

    /*
     * For ex:
     *      $start_offset = "href" + "=\"";
     *                    = 4 + 2
     *                    = 6
     */
    $start_offset = strlen($attribute) + 2;
    $start_index += $start_offset;

    $end_index = strpos($s, "\"", $start_index);


    $length = $end_index - $start_index;

    $attribute_value = substr($s, $start_index, $length);

//    echo "<a href='" . $sub_embed_code . "'>link</a>";
    return $attribute_value;
}


function display_row_of_photos($photo_embed_codes, &$counter_index)
{
    $num_of_photos = get_num_of_photos();

    $max_ref_height = get_max_ref_height($photo_embed_codes, $num_of_photos, $counter_index);

    $photos_to_be_displayed = array();

//    $j = $counter_index;


    // Set the attributes of all the photos to be displayed
    // in the row container
    for ($i = 0; $i < $num_of_photos; $i++) {
        // If there's no more available photo_embed_code remaining
        // in the array, then break off the loop.
        if (!isset($photo_embed_codes[$counter_index])) {
            break;
        }


        //
        $a_photo_to_be_displayed = get_the_photo_attrib($photo_embed_codes[$counter_index], $max_ref_height);


        //
        array_push($photos_to_be_displayed, $a_photo_to_be_displayed);


        //
        ++$counter_index;
    }


    // Calculate the total reference width of all the photos.
    $total_reference_width = 0;

    foreach ($photos_to_be_displayed as $photo) {
        $total_reference_width += $photo["reference_width"];
    }


    // Now, all photos in that row container have their raw dimensions.
    // So calculate the width percentage that each of them consume.
    for ($i = 0; $i < count($photos_to_be_displayed); $i++) {
        set_width_percentage($photos_to_be_displayed[$i], $total_reference_width);
    }



//    echo "<div id='ref_container'></div>";

    // Display the <img>
    // Now calculate their dimensions when displayed by multiplying each
    // width percentage to the width of the row container.
    foreach ($photos_to_be_displayed as $p) {
        $w = CONTAINER_WIDTH * $p['width_percentage'];

        // aspect ratio
        $r = $p['raw_width'] / $p['raw_height'];
        $h = $w / $r;


        echo "<img src='" . $p['src'] . "' width='{$w}' height='{$h}'>";
    }

    echo "<br>";
}


/**
 * Now, all photos in that row container have their raw dimensions.
 * So calculate the width percentage that each of them consume.
 * @param $photo
 */
function set_width_percentage(&$photo, $total_reference_width)
{
//    echo "<h3>****************************************</h3>";
    $photo["width_percentage"] = $photo["reference_width"] / $total_reference_width;
//    var_dump($photo);
//    echo "<h3>****************************************</h3>";
}


function get_the_photo_attrib($embed_code, $max_ref_height)
{

    $href = get_attribute_value($embed_code, "href");
    $src = get_attribute_value($embed_code, "src");
    $raw_width = get_attribute_value($embed_code, "width");
    $raw_height = get_attribute_value($embed_code, "height");

    // Given the aspect ratio of each photo, calculate their widths at
    // that maximum reference height.
    $reference_width = get_reference_width($max_ref_height, $raw_width, $raw_height);


    $a_photo_to_be_displayed = array(
        "href" => $href,
        "src" => $src,
        "raw_width" => $raw_width,
        "raw_height" => $raw_height,
        "reference_width" => $reference_width,
        "reference_height" => $max_ref_height
    );

    //
//    var_dump($a_photo_to_be_displayed);

    //
    return $a_photo_to_be_displayed;
}


/**
 * // Given the aspect ratio of each photo, calculate their widths at
 * // that maximum reference height.
 */
function get_reference_width($max_ref_height, $raw_width, $raw_height)
{
    // Aspect ratio
    $r = $raw_width / $raw_height;

    $reference_width = $r * $max_ref_height;

    return $reference_width;

}


/**
 * Of those photos to be displayed in a row, find which has the largest height.
 * Set that as the maximum reference height.
 */
function get_max_ref_height($photo_embed_codes, $num_of_photos, &$counter_index)
{
    $max_height = -1;
    $temp_counter_index = $counter_index;

    for ($i = 0; $i < $num_of_photos; $i++) {

        if (!isset($photo_embed_codes[$temp_counter_index])) {
            break;
        }

        $embed_code = $photo_embed_codes[$temp_counter_index];
        ++$temp_counter_index;

        $h = get_attribute_value($embed_code, "height");

        if ($h >= $max_height) {
            $max_height = $h;
        }
    }

    return $max_height;
}


// get_num_of_photos_for_row_container
function get_num_of_photos()
{
// Generate a random # of how many photos to be shown in this
// row container. (2 to 4 photos).
    return rand(2, 4);
}


function xxxx()
{

// Now calculate their dimensions when displayed by multiplying each
// width percentage to the width of the row container.
}

?>





<style>
    #ref_container {
        background-color: yellow;
        width: 990px;
        height: 500px;
    }
</style>
