<h1>Magento 2 Module Experius DonationProduct (RC1.0)</h1>

Demo website: https://donationproduct.experius.nl

<h2>Installation</h2>

Add the module to your composer.json
```composer require experius/module-donationproduct "~1.0.0"```

Run the Magento Setup Upgrade
```bin/magento setup:upgrade```

<h2>Frontend</h2>

- This module adds a new product type "Donation Product" to your Magento 2 installation.
- A customer can add this donation product to the cart with a self chosen amount.

The donation products can be viewed on several location in your Magento 2 webshop
- Homepage
- Sidebar
- Cart
- Checkout

When clicked on a charity of the customers choice a popup will open with the charities details and a add to cart button. 

You can also create a regular category with all the donation products with a regular product detail page.

Off course it is possible to implement this block on any location by a Magento frontend developer,

A "Donation Product" has a lot in common with a "Virtual Product". It has no stock, weight and doesn't need a shipping method or address to be set in the checkout.

<h4>Donation Popup</h4>
<p align="center">
  <img src="https://raw.githubusercontent.com/experius/Magento-2-Module-Experius-DonationProduct/master/Docs/Screenshots/donation-modal.png" width="50%" title="Product Page">
</p>

<h4>Product Page</h4>
<p align="center">
  <img src="https://raw.githubusercontent.com/experius/Magento-2-Module-Experius-DonationProduct/master/Docs/Screenshots/product-page.png" width="50%" title="Product Page">
</p>

<h4>Cart Page</h4>
<p align="center">
  <img src="https://raw.githubusercontent.com/experius/Magento-2-Module-Experius-DonationProduct/master/Docs/Screenshots/cart.png" width="50%" title="Cart Page">
</p>

<h4>Category Page</h4>
<p align="center">
  <img src="https://raw.githubusercontent.com/experius/Magento-2-Module-Experius-DonationProduct/master/Docs/Screenshots/category-view.png" width="50%" title="Product Page">
</p>

<h4>Sidebar Block</h4>
<p align="center">
  <img src="https://raw.githubusercontent.com/experius/Magento-2-Module-Experius-DonationProduct/master/Docs/Screenshots/donation-sidebar.png" title="Product Page">
</p>

<h4>Full Size Block</h4>
<p align="center">
  <img src="https://raw.githubusercontent.com/experius/Magento-2-Module-Experius-DonationProduct/master/Docs/Screenshots/donation-full-size.png" width="50%" title="Product Page">
</p>

<h2>Backend</h2>

<h4>Product Type</h4>

Add a new product with type 'Donation Product'

<p align="center">
  <img src="https://raw.githubusercontent.com/experius/Magento-2-Module-Experius-DonationProduct/master/Docs/Screenshots/product-type-donation.png" width="50%" title="Product Type">
</p>

<h4>Edit Product</h4>

You can configure the minimum donation amount.

<p align="center">
  <img src="https://raw.githubusercontent.com/experius/Magento-2-Module-Experius-DonationProduct/master/Docs/Screenshots/product-setting.png" width="50%" title="Product Setting">
</p>

<h4>Report</h4>

Reports > Sales > Donations

A report table is made to store every single "Donation Product" sale. You can make an export, sum up the amount per charity and transfer the money.

<p align="center">
  <img src="https://raw.githubusercontent.com/experius/Magento-2-Module-Experius-DonationProduct/master/Docs/Screenshots/report.png" width="50%" title="Report">
</p>
<p align="center">
  <img src="https://raw.githubusercontent.com/experius/Magento-2-Module-Experius-DonationProduct/master/Docs/Screenshots/report-grid.png" width="100%" title="Report Grid">
</p>

<h4>Settings</h4>

Stores > Settings > Configuration > Catalog > Donation Product

There is a setting to enable or disable the complete module.
There are settings to enable and disable the visibility of blocks on several locations in your webshop.

<p align="center">
  <img src="https://raw.githubusercontent.com/experius/Magento-2-Module-Experius-DonationProduct/master/Docs/Screenshots/settings.png" width="50%" title="Settings">
</p>
