define(['jquery', 'uiComponent', 'ko'], function ($, Component, ko) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'Magento_Catalog/templates/product/view/addtocart'
            },
            initialize: function () {
                this._super();
                this.quantity = ko.observable("1");
            },

            increaseQuantity: function () {
                var qty = parseInt(this.quantity());
                qty = qty + 1;
                this.quantity(qty);
            },

            decreaseQuantity: function () {
                var qty = parseInt(this.quantity());
                if (qty > 0) {
                    qty = qty - 1;
                }
                this.quantity(qty);
            }
        });
    }
);
