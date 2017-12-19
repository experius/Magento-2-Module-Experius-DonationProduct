define([
    "jquery",
    "mage/validation"
], function($, validation) {

    $.widget('mage.donationOptions', {

        _create: function () {
            this.initDonationOptions();
        },

        initDonationOptions: function(){

            var customAmountElement = $('input#donation');

            customAmountElement.on('change', function(elem) {
                if($(elem).val()>0){
                    alert('manual input');
                }

                alert('manual input');
            }.bind(this));
        }

    });

    return $.mage.donationOptions;
});