<?php
// TODO:SECTION: General js scripts that needs <php> tags.
?>
<script>
    function get_csrf_token() {
        return "<?php echo sessionize_csrf_token(); ?>";
    }

    function get_local_url() {
        return "http://localhost/myPersonalProjects/FatBoy";
    }
</script>



<script src="<?php echo LOCAL . "/public/_scripts/general.js"; ?>">
</script>

<script src="<?php echo LOCAL . "/public/_scripts/main_script.js"; ?>"></script>
<script src="<?php echo LOCAL . "/public/_scripts/main_script2.js"; ?>"></script>

<script src="<?php echo LOCAL . "/public/_scripts/main_script_part2.js"; ?>"></script>