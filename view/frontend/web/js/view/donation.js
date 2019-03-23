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
            var pMinLabel = $('.experius-donation-minimal-amount-label-' + this.options.identifier);
            var popup = modal(options, popupContainer);

            this.addFormValidation();

            if (this.options.ajaxCart) {
                this.initAjaxCart();
            }

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
                    self.clearMessages();

                    pImage.attr('src', imageurl).attr('alt', title);
                    pDescription.html(description);
                    pForm.attr('action', addtocarturl);
                    pImage.attr('src', imageurl);
                    pInput.removeClass();
                    pInput.addClass(htmlvalidation);
                    pMinLabel.text(minimalamount);

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

        },

        initAjaxCart: function() {
            var self = this;
            $(this.options.addToCartFormId).submit(function (e) {

                if(!$(self.options.addToCartFormId).valid()) {
                    return;
                }

                $.ajax({
                    type: "POST",
                    url: jQuery(self.options.addToCartFormId).attr('action'),
                    data: jQuery(self.options.addToCartFormId).serialize(),
                    showLoader: true,
                    success: function(response) {
                        self.clearMessages();
                        if (response.success) {
                            self.addMessage(response.success, 'success');
                        }
                        if (response.error) {
                            self.addMessage(response.error, 'error');
                        }
                        if(response.success && self.options.setAjaxRefreshOnSuccess) {
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                    }
                });
                e.preventDefault();
            });
        },

        clearMessages: function() {
            $(this.options.addToCartFormId + ' .message').remove();
        },

        addMessage: function(message, type) {
            if (this.options.setAjaxRefreshOnSuccess) {
                message = message + ' ' + this.options.setAjaxRefreshOnSuccessMsg
            }
            var messageHtml = '<div class="message">' +
                '<div class="message '+ type +'">' + message + '</div>' +
                '</div>';
            $(this.options.addToCartFormId).prepend(messageHtml);
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