## PServerCMS Donate setup

This guide will show you an example setup for paymentwall and superreward.

### PingBackUrls

You can find all pingback-url in the [README](https://github.com/kokspflanze/PaymentAPI#pingbackurls) of the PaymentAPI

### Config

 Go to the `config/autoload` directory and create `payment.local.php` with the following content.
 
```php
<?php
return [
    'payment-api' => [
        'payment-wall' => [
            /**
             * SecretKey
             */
            'secret-key' => 'YOUR SECRETKEY, PLEASE REPLACE ME',
        ],
        'super-reward' => [
            /**
             * SecretKey
             */
            'secret-key' => 'YOUR SECRETKEY, PLEASE REPLACE ME'
        ],
    ],
];
```
 
 Don´t forget to set the secret-key, if you don´t use one of them, than set just use a '' as secret-key.
 
 You can test this secret-key with the pingback test of the payment-provider, in the adminpanel you can see the log, if you have problems.
 
### Overwrite the current Donate-Template
 
 Go to the `module/Customize/view` directory and create `p-server-core` and `donate`. (result: module/Customize/view/p-server-core/donate)
 
 In the donate directory you have to create a `index.twig` file, with following content.
 
```php
 {% extends 'layout/layout' %}
 
 {% block title %}
    {{ translate('Donate') }}
 {% endblock title %}
 
 {% block content %}
	<h2>SuperReward</h2>
	<hr />
    <iframe src="https://wall.superrewards.com/super/offers?h=XXXXXX&uid={{ user.getId() }}" frameborder="0" width="100%" height="400" scrolling="no"></iframe>
 
	<h2>Paymentwall</h2>
	<hr />
    <iframe src="https://api.paymentwall.com/api/ps/?key=XXXXXX&uid={{ user.getId() }}&widget=XXXXXX&email={{ user.getEmail() }}&history[registration_date]={{ user.getCreated.getTimestamp }}" width="100%" height="800" frameborder="0"></iframe>
 {% endblock content %}
```

these is just an example how the widget looks, you have to replace the `XXXXXX` parts.

If this is done you can see the Donate widget.