# metrique/google-product-taxonomy-php

A PHP library providing Google Product Category data.

![License](https://img.shields.io/github/license/metrique/google-product-taxonomy-php.svg)

## What is Google Product Category Data?

Google Product Category data is a library containing a copy of Google's continuously evolving product taxonomy. Providing high-quality, on-topic titles and descriptions, as well as accurate pricing, brand and GTIN information will help make sure that your products are correctly categorised.

> *-- [Google product category](https://support.google.com/merchants/answer/6324436?hl=en-GB)*

## Installing

``` sh
composer require metrique/google-product-category-php
```

## Using

Quick guide:

``` php
$data = (new Metrique\Taxonomy)->lookupId(1);
$data = (new Metrique\Taxonomy)->lookupCategory('Animals & Pet Supplies > Live Animals');
$data = (new Metrique\Taxonomy)->search('Pet Supplies');
```

Data sample:

``` php
[
    [
        'id' => 1,
        'category' => 'Animals & Pet Supplies',
    ],
    [
        'id' => 3237,
        'category' => 'Animals & Pet Supplies > Live Animals',
    ],
    [
        'id' => 2,
        'category' => 'Animals & Pet Supplies > Pet Supplies',
    ],
    [
        'id' => 3,
        'category' => 'Animals & Pet Supplies > Pet Supplies > Bird Supplies',
    ],
]
```

Updating:

This will import the latest plaintext taxonomy data from Google, and convert it to a php array in the temp folder.

``` sh
composer import-taxonomy
```

## Contributing

Feel free to submit a pull request or create an issue.

## License

metrique/google-product-taxonomy is licensed under the MIT license.

## Source(s)

* [Google product category](https://support.google.com/merchants/answer/6324436?hl=en-GB) by [Google](http://www.google.com)
