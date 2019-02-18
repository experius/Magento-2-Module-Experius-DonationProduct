define([
    "jquery",
    'mage/translate',
    'ko',
    "mage/storage",
    "mage/validation",
    "uiComponent",
    "Magento_Ui/js/modal/modal"
], function ($, $t, ko, storage, validation, Component, modal) {

    $.widget('mage.donation', {

        _create: function () {
            this.initDonationModal();
        },

        initDonationModal: function () {

            var self = this;

            var options = {
                type: 'popup',
                title: 'Donation',
                responsive: true,
                innerScroll: true,
                modalClass: 'experius-modal-popup',
                buttons: []
            }

            var popupContainer = $(this.options.popupContainer);
            var pImage = $('.charity-image', popupContainer);
            var pDescription = $('.charity-description', popupContainer);
            var pForm = $('.charity-form', popupContainer);
            var pInput = $('#custom-amount-input-' + this.options.identifier);
            var pMinLabel = $('.experius-donation-minimal-amount-label');
            var popup = modal(options, popupContainer);

            this.addFormValidation();

            $('html').on('click', this.options.productSelector, function () {
                var charity = jQuery(this);
                if (charity.data('productid') != '') {
                    var title           = charity.data('title'),
                        description     = charity.data('description'),
                        imageurl        = charity.data('imageurl'),
                        addtocarturl    = charity.data('addtocarturl');
                        htmlvalidation  = charity.data('htmlvalidation');
                        minimalamount  = charity.data('minimal-amount');

                    self.resetRadioButtons();

                    pImage.attr('src', imageurl).attr('alt', title);
                    pDescription.html(description);
                    pForm.attr('action', addtocarturl);
                    pImage.attr('src', imageurl);
                    pInput.removeClass();
                    pInput.addClass(htmlvalidation);
                    pMinLabel.text(pMinLabel.text().replace("%2", minimalamount));

                    $('.experius-donation-modal')
                        .modal(options)
                        .modal('openModal');

                    $('.experius-modal-popup .modal-title').text(title);
                }
            });

            $('html').on('change', this.options.inputRadioSelector, function () {
                pInput.removeClass('required');
                pInput.validation().valid();
            });

            $('html').on('change', '#custom-amount-input-' + this.options.identifier, function () {
                pInput.validation().valid();
            });

            if (this.options.ajaxCart) {
                $(this.options.addToCartFormId).submit(function (e) {
                    $.ajax({
                        type: "POST",
                        url: jQuery(this.options.addToCartFormId).attr('action'),
                        data: jQuery(this.options.addToCartFormId).serialize(),
                        showLoader: true
                    });
                    e.preventDefault();
                });
            }
        },

        resetRadioButtons: function () {
            $(this.options.inputRadioSelector).attr('checked', false);
        },

        addFormValidation: function () {
            var addtoCartForm = $(this.options.addToCartFormId);
            addtoCartForm.mage('validation', {});
        }

    });

    return $.mage.donation;
});