# How to show icons in ranking

if you go to the ranking page and select a character you should see on the button smth like

![ScreenShot](https://github.com/kokspflanze/pserverCMSFull/blob/master/doc/images/RANKING_DEFAULT.png)

## Copy your icons

First of all you have to copy your own icons to the `public` directory. They must be on the same postion like in the path written, expected the public directory, that is added automatically.
 
## Overwrite the template

The item show part is splittet in some view-helper, to make it so much customisable as possible.

### just as information about how it works

workflow:
 - [`pServerRankingInventoryView`](https://github.com/kokspflanze/PServerRanking/blob/master/view/p-server-ranking/character/index.twig#L47) to show the inventory
 - [`pServerRankingItemDetails`](https://github.com/kokspflanze/PServerRanking/blob/master/view/helper/inventory-view.phtml#L10) to show the item-details
 - [`getIconPath`](https://github.com/kokspflanze/PServerRanking/blob/master/view/helper/item-details.phtml#L2) to get the icon path (no view-helper)
 
you can overwrite each view-helper with your own template, so it is possible to show more as such the item-level and the icon, without creating backward compatibility problems, if you update (thats not 100% guarantee, everytime there can be internal changes)
 
### create a template

go to `modules/Customize/view` and create a directory `helper` and in that directory create a file with the name `item-details.phtml`.

the main content should be 

```php
<?php if ($this->item) : ?>
<img src="<?= $this->basePath() . $this->item->getRefItem()->getIconPath() ?>" />
<?php endif; ?>
```

sure you can also change that to smth else, here you can find the [original](https://github.com/kokspflanze/PServerRanking/blob/master/view/helper/item-details.phtml) file.

### overwrite the exist template

go to `modules/Customize/config` and open the `module.config.php` file.

here you have to add in the `template_map` part following.

```php
'helper/pServerRankingItemDetails' => __DIR__ . '/../view/helper/item-details.phtml',
```

as result the file should looks smth like.

```php
<?php
return [
    'view_manager' => [
        'template_map' => [
            'helper/pServerRankingItemDetails' => __DIR__ . '/../view/helper/item-details.phtml',
        ],
        'template_path_stack' => [
            'Customize' => __DIR__ . '/../view',
        ],
    ],
];
```

please dont copy that example, otherwise you can destroy current changes.

see also [how to get the template alias?](https://github.com/kokspflanze/pserverCMSFull/blob/master/doc/general-setup/CUSTOMIZE.md#how-to-get-the-template-alias)
