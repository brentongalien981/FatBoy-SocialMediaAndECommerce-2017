<?php

?>
<select id="theSelect" onchange="myFunction(this, '123abc')">
    <option>1</option>
    <option selected>2</option>
</select>

<script>
    function myFunction(current_select_element, invoice_id) {
        window.alert("current_select_element.value: " + current_select_element.value);
        window.alert("invoice_id: " + invoice_id);
    }
</script>

