<?php
$s = "<a data-flickr-embed=\"true\"  href=\"https://www.flickr.com/photos/151625521@N05/36248325400/in/dateposted-public/\" title=\"jet5\"><img src=\"https://farm5.staticflickr.com/4352/36248325400_0f035711ef_o.jpg\" width=\"870\" height=\"588\" alt=\"jet5\"></a><script async src=\"//embedr.flickr.com/assets/client-code.js\" charset=\"utf-8\"></script>";
$x = "<a data-flickr-embed=\"true\"  href=\"https://www.flickr.com/photos/151625521@N05/36248325400/in/dateposted-public/\" title=\"jet5\"><img src=\"https://farm5.staticflickr.com/4352/36248325400_fc82c79844_q.jpg\" width=\"150\" height=\"150\" alt=\"jet5\"></a><script async src=\"//embedr.flickr.com/assets/client-code.js\" charset=\"utf-8\"></script>";

//$z = array();
$z[0] = "<a data-flickr-embed=\"true\"  href=\"https://www.flickr.com/photos/151625521@N05/36635541995/in/dateposted-public/\" title=\"kp1\"><img src=\"https://farm5.staticflickr.com/4369/36635541995_39529e8dec_o.jpg\" width=\"750\" height=\"503\" alt=\"kp1\"></a><script async src=\"//embedr.flickr.com/assets/client-code.js\" charset=\"utf-8\"></script>";
$z[1] = "<a data-flickr-embed=\"true\"  href=\"https://www.flickr.com/photos/151625521@N05/36635541995/in/dateposted-public/\" title=\"kp1\"><img src=\"https://farm5.staticflickr.com/4369/36635541995_18eaebda3f_q.jpg\" width=\"150\" height=\"150\" alt=\"kp1\"></a><script async src=\"//embedr.flickr.com/assets/client-code.js\" charset=\"utf-8\"></script>";
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


//function display_row_of_photos($photo_embed_codes, &$counter_index)
function display_row_of_photos($photo_embed_codes)
{
    $num_of_photos = get_num_of_photos();


//
    $max_ref_height = get_max_ref_height($photo_embed_codes, $num_of_photos, $counter_index);


//
    $photos_to_be_displayed = array();
    
    $j = $counter_index;


    for ($i = 0; $i < $num_of_photos; $i++) {
        //

        echo "href: " . get_attribute_value($photo_embed_codes[$j], "href");
        $href = get_attribute_value($photo_embed_codes[$j], "href");
        echo "<br>";

        echo "title: " . get_attribute_value($photo_embed_codes[$j], "title");
        echo "<br>";

        echo "src: " . get_attribute_value($photo_embed_codes[$j], "src");
        $src = get_attribute_value($photo_embed_codes[$j], "src");
        echo "<br>";

        echo "raw_width: " . get_attribute_value($photo_embed_codes[$j], "width");
        $raw_width = get_attribute_value($photo_embed_codes[$j], "width");
        echo "<br>";

        echo "raw_height: " . get_attribute_value($photo_embed_codes[$j], "height");
        $raw_height = get_attribute_value($photo_embed_codes[$j], "height");
        echo "<br>";

        echo "alt: " . get_attribute_value($photo_embed_codes[$j], "alt");
        echo "<br>";



        //
        $reference_width = get_reference_width($max_ref_height, $raw_width, $raw_height);



        $a_photo_to_be_displayed = array(
            "href" => $href,
            "src" => $src,
            "raw_width" => $raw_width,
            "raw_height" => $raw_height,
            "reference_width" => $reference_width
        );

        //
        var_dump($a_photo_to_be_displayed);



        //
        array_push($photos_to_be_displayed, $a_photo_to_be_displayed);



        //
        ++$counter_index;
    }
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

// Given the aspect ratio of each photo, calculate their widths at
// that maximum reference height.


// Now, all photos in that row container have their raw dimensions.
// So calculate the width percentage that each of them consume.


// Now calculate their dimensions when displayed by multiplying each
// width percentage to the total width of the row container.
}

?>
