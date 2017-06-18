window.onload = function () {
    



    function displayAddressForm() {
        document.getElementById("formAddress").style.display = "block";

        document.getElementById("buttonEditAddress").style.display = "none";

        document.getElementById("buttonDoneEditingAddress").style.display = "block";
    }

    function hideAddressForm() {
        document.getElementById("formAddress").style.display = "none";

        document.getElementById("buttonEditAddress").style.display = "block";

        document.getElementById("buttonDoneEditingAddress").style.display = "none";
    }


};