define([
    "jquery",
    'mage/translate',
    'ko',
    "mage/storage",
    "mage/validation",
    "uiComponent",
    "Magento_Ui/js/modal/modal"
], function($, $t, ko, storage, validation, Component, modal) {

    $.widget('mage.donation', {

        _create: function () {
            console.log('test ui');
            this.initDonationModal();
        },

        initDonationModal: function(){

            var options = {
                type: 'popup',
                title: 'Donation',
                responsive: true,
                innerScroll: true,
                modalClass: 'experius-modal-popup',
                buttons: []
            }

            var popupContainer = $( this.options.popupContainer);
            var pImage = $('.charity-image', popupContainer);
            var pDescription = $('.charity-description', popupContainer);
            var pForm = $('.charity-form', popupContainer);
            var popup = modal(options, popupContainer);

            $('html').on('click', this.options.productSelector, function(){
                var charity = jQuery(this);
                if(charity.data('productid') != ''){
                    var title           = charity.data('title'),
                        description     = charity.data('description'),
                        imageurl        = charity.data('imageurl'),
                        addtocarturl    = charity.data('addtocarturl');

                    pImage.attr('src', imageurl).attr('alt', title);
                    pDescription.html(description);
                    pForm.attr('action', addtocarturl);
                    pImage.attr('src', imageurl);

                    $('.experius-donation-modal')
                        .modal(options)
                        .modal('openModal');

                    $('.experius-modal-popup .modal-title').text(title);
                }
            });

            if(this.options.ajaxCart) {
                $(this.options.addToCartFormId).submit(function(e) {
                    $.ajax({
                        type: "POST",
                        url: jQuery(this.options.addToCartFormId).attr('action'),
                        data: jQuery(this.options.addToCartFormId).serialize(),
                        showLoader: true
                    });
                    e.preventDefault();
                });
            }
        }

    });

    return $.mage.donation;
});