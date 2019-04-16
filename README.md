# Laravel PH: TDD your IoC Container

## Installation
`composer install`

Requires **MailChimp** and **Mailgun** Api Keys, check **MailServiceProvider** to configure your mailing services.

## Description
This demo covers how we leverage **Ioc Container** 
to switch between packages without changing the business logic / actual code implementation ***(Inversion of Control)***.

We use **MailingListInterface** as a common interface for multiple implementations.

## Usage
### Use Mailchimp as your **MailingListService**
#### First: 
Switch implementation, **MailServiceProvider** and use **$this->getMailChimpConcrete()**
#### Next: 
Change test data, **MailListServiceTest** and use **[$listName, $data] = $this->getMailChimpData();** to switch your test data.
#### Finally: 
Run your tests. ```vendor/bin/phpunit --bootstrap=src/app.php```

---

### Use MailGun as your **MailingListService**
#### First: 
Switch implementation, **MailServiceProvider** and use **$this->getMailGunConcrete()**
#### Next: 
Change test data, **MailListServiceTest** and use **[$listName, $data] = $this->getMailGunData();** to switch your test data.
#### Finally: 
Finally, run your tests. ```vendor/bin/phpunit --bootstrap=src/app.php```