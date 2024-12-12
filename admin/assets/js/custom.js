$(document).ready(function () {

    alertify.set('notifier', 'position', 'top-right');

    function updateTotalPrice(element) {
        const row = element.closest('tr');
        const price = parseFloat(row.querySelector('td:nth-child(3)').textContent);
        const quantity = parseInt(row.querySelector('.quantityInput').value);
        const totalPriceCell = row.querySelector('.totalPrice');
        totalPriceCell.textContent = (price * quantity).toFixed(2);
    }

    $(document).on('click', '.increment', function () {
        var $quantityInput = $(this).closest('.qtyBox').find('.qty');
        var productId = $(this).closest('.qtyBox').find('.prodId').val();
        var currentValue = parseInt($quantityInput.val());

        if (!isNaN(currentValue)) {
            var qtyVal = currentValue + 1;
            $quantityInput.val(qtyVal);
            updateQuantity(productId, qtyVal);
            updateTotalPrice(this);
        }
    });

    $(document).on('click', '.decrement', function () {
        var $quantityInput = $(this).closest('.qtyBox').find('.qty');
        var productId = $(this).closest('.qtyBox').find('.prodId').val();
        var currentValue = parseInt($quantityInput.val());

        if (!isNaN(currentValue) && currentValue > 1) {
            var qtyVal = currentValue - 1;
            $quantityInput.val(qtyVal);
            updateQuantity(productId, qtyVal);
            updateTotalPrice(this);
        } else if (currentValue == 1) {
            // Optionally handle removing the item
            $quantityInput.val(0);
            updateQuantity(productId, 0);
        }
    });

    function updateQuantity(prodId, qty) {
        $.ajax({
            type: "POST",
            url: "orders-code.php",
            data: {
                'productIncDec': true,
                'product_id': prodId,
                'quantity': qty
            },
            success: function (response) {
                var res = JSON.parse(response);
                if (res.status == 200) {
                    alertify.success(res.message);
                } else {
                    alertify.error(res.message);
                }
            }
        });
    }

    // proceed to place order button click
    $(document).on('click', '.proceedToPlace', function () {
        var cphone = $('#cphone').val();
        var payment_mode = $('#payment_mode').val();
        var amountPaid = parseFloat($('#amountPaid').val());
        var totalAmount = parseFloat($('#totalAmount').val().replace(/,/g, ''));
    
        // Check if payment mode is selected
        if (payment_mode == '') {
            swal("Select Payment Mode", "Select your payment mode", "warning");
            return false;
        }
    
        // Validate phone number (must be 11 digits)
        if (cphone == '' || !$.isNumeric(cphone) || cphone.length !== 11) {
            swal("Enter Phone Number", "Enter a valid 11-digit phone number", "warning");
            return false;
        }
    
        // Check if amount paid is greater than or equal to total amount
        if (isNaN(amountPaid) || amountPaid < totalAmount) {
            swal("Insufficient Amount", "The amount paid must be greater than or equal to the total amount", "warning");
            return false;
        }
    
        // Prepare data to send via AJAX
        var data = {
            'proceedToPlaceBtn': true,
            'cphone': cphone,
            'payment_mode': payment_mode,
            'amountPaid': amountPaid,
            'changeAmount': $('#changeAmount').val()
        };
    
        // Send AJAX request to process the order
        $.ajax({
            type: "POST",
            url: "orders-code.php",
            data: data,
            success: function (response) {
                var res = JSON.parse(response);
                if (res.status == 200) {
                    window.location.href = "order-summary"; // Redirect to order summary page
                } else if (res.status == 404) {
                    swal(res.message, res.message, res.status_type, {
                        buttons: {
                            catch: { text: "Add Customer", value: "catch" },
                            cancel: "Cancel"
                        }
                    }).then((value) => {
                        switch(value) {
                            case "catch":
                                $('#c_phone').val(cphone);
                                $('#addCustomerModal').modal('show'); // Show customer modal
                                break;
                            default:
                                break;
                        }
                    });
                } else {
                    swal(res.message, res.message, res.status_type);
                }
            }
        });
    });
    


    // Add Customer to customers table
    $(document).on('click', '.saveCustomer', function () {

        var c_name = $('#c_name').val();
        var c_phone = $('#c_phone').val();
        var c_email = $('#c_email').val();
        var c_address = $('#c_address').val();


        if(c_name != '' && c_phone != '' )
        {
            if($.isNumeric(c_phone)){
                
                var data = {
                    'saveCustomerBtn': true,
                    'name': c_name,
                    'phone': c_phone,
                    'email': c_email,
                    'address': c_address
                };

                $.ajax({
                    type: "POST",
                    url: "orders-code.php",
                    data: data,
                    success: function (response) {
                        var res = JSON.parse(response);

                        if(res.status == 200){
                            swal(res.message, res.message, res.status_type);
                            $('#addCustomerModal').modal('hide');
                            swal(res.message, res.message, res.status_type);
                        }else{
                            swal(res.message, res.message, res.status_type);
                        }

                    }
                });

            }else{
                swal("Enter Valid Phone Number", "","warning");
            }
        }
        else
        {
            swal("Please Fill required fields", "","warning");
        }
    });

    $(document).on('click', '#saveOrder', function () {

        $.ajax({
            type: "POST",
            url: "orders-code.php",
            data: {
                'saveOrder' : true
            },
            success: function (response) {
                var res = JSON.parse(response);

                if(res.status == 200){
                    swal(res.message,res.message,res.status_type);
                    $('#orderPlaceSuccessMessage').text(res.message);
                    $('#orderSuccessModal').modal('show');

                }else{
                    swal(res.message,res.message,res.status_type);
                }
            }
        });

    });

});

function printMyBillingArea() {
         
    var divContents = document.getElementById("myBillingArea").innerHTML;
    var a = window.open('', '');
    a.document.write('<html><title>JiSu E-Bike POS System</title>');
    a.document.write('<body style="font-family: fangsong;">');
    a.document.write(divContents);
    a.document.write('</body></html>');
    a.document.close();
    a.print();    
}

window.jsPDF = window.jspdf.jsPDF;
var docPDF = new jsPDF();

function downloadPDF(invoiceNo){

    var elementHTML = document.querySelector("#myBillingArea");
    docPDF.html( elementHTML, {
        callback: function(){
            docPDF.save(invoiceNo+'.pdf');
        },  
        x: 15,
        y: 15,
        width: 170,
        windowWidth: 650
    });
    document.getElementById('c_phone').addEventListener('input', function () {
        var value = this.value;
    
        value = value.replace(/[^0-9+]/g, '');
    
        if (value.startsWith('+63')) {
            if (value.length > 13) {
                value = value.slice(0, 13);
            }
        } else {
            if (value.length <= 11) {
                value = '+63' + value.replace(/[^0-9]/g, '').slice(0, 11);
            } else {
                value = '+63' + value.slice(0, 11);
            }
        }
    
        if (!value.match(/^\+63\d{11}$/)) {
            value = value.slice(0, 13);
        }
    
        this.value = value;
    });
}