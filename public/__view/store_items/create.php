<div id="a-product-details-table-container">

    <h3 id="product-action-title">xXx</h3>

    <h4>Product's Basic Info</h4>

    <table id="a-product-basic-info-table">
        <tbody>

        <tr>
            <td colspan="2" id="error_product_id" class="error_msg">Product's Id error comment</td>
        </tr>
        <tr>
            <td class="product-details-table-label">Product Id</td>
            <td class="product-details-table-data">
                <input id="product-id" disabled>
            </td>
        </tr>

        <tr>
            <td colspan="2" id="error_product_name" class="error_msg">Product Name's error comment</td>
        </tr>
        <tr>
            <td class="product-details-table-label">Product Name</td>
            <td class="product-details-table-data">
                <input id="product-name" placeholder="Your product's name">
            </td>
        </tr>



        <tr>
            <td colspan="2" id="error_product_price" class="error_msg">Product Price's error comment</td>
        </tr>
        <tr>
            <td class="product-details-table-label">Price</td>
            <td class="product-details-table-data">
                <input id="product-price" type="number" min="0.01" step="0.01" value="0.01">
            </td>
        </tr>



        <tr>
            <td colspan="2" id="error_product_quantity" class="error_msg">Product's quantity error comment</td>
        </tr>
        <tr>
            <td class="product-details-table-label">Quantity</td>
            <td class="product-details-table-data">
                <input id="product-quantity" type="number" min="1" value="1">
            </td>
        </tr>



        <tr>
            <td colspan="2" id="error_product_description" class="error_msg">Product's description error comment</td>
        </tr>
        <tr>
            <td class="product-details-table-label">Description</td>
            <td class="product-details-table-data">
                <textarea id="product-description" rows="" cols=""></textarea>
            </td>
        </tr>



        <tr>
            <td colspan="2" id="error_product_photo_src" class="error_msg">Product's image source error comment</td>
        </tr>
        <tr>
            <td class="product-details-table-label">Photo Web Address</td>
            <td class="product-details-table-data">
                <textarea id="product-photo-src" rows="" cols=""></textarea>
            </td>
        </tr>
        </tbody>
    </table>





    <h4>Product's Dimensions and Mass When Boxed For Shipping</h4>

    <table id="a-product-dimension-details-table">
        <tbody>
        <tr>
            <td colspan="2" id="error_product_mass" class="error_msg">Product Mass' error comment</td>
        </tr>
        <tr>
            <td class="product-details-table-label">Mass in ounces (oz)</td>
            <td class="product-details-table-data">
                <input id="product-mass" type="number" min="0.01" step="0.01" value="0.01">
            </td>
        </tr>



        <tr>
            <td colspan="2" id="error_product_length" class="error_msg">Product's length error comment</td>
        </tr>
        <tr>
            <td class="product-details-table-label">Lenght in inches (in)</td>
            <td class="product-details-table-data">
                <input id="product-length" type="number" min="0.01" step="0.01" value="0.01">
            </td>
        </tr>



        <tr>
            <td colspan="2" id="error_product_width" class="error_msg">Product's width error comment</td>
        </tr>
        <tr>
            <td class="product-details-table-label">Width in inches (in)</td>
            <td class="product-details-table-data">
                <input id="product-width" type="number" min="0.01" step="0.01" value="0.01">
            </td>
        </tr>



        <tr>
            <td colspan="2" id="error_product_height" class="error_msg">Product's height error comment</td>
        </tr>
        <tr>
            <td class="product-details-table-label">Height in inches (in)</td>
            <td class="product-details-table-data">
                <input id="product-height" type="number" min="0.01" step="0.01" value="0.01">
            </td>
        </tr>



        <tr>
            <td colspan="2">
                <button id="create-product-record-btn">Add Product</button>
                <button id="update-product-record-btn">Update Product</button>
                <button class="cancel-add-product-btn">Cancel</button>
            </td>
        </tr>

        </tbody>
    </table>

</div>