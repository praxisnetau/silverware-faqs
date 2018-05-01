# SilverWare FAQs Module

[![Latest Stable Version](https://poser.pugx.org/silverware/faqs/v/stable)](https://packagist.org/packages/silverware/faqs)
[![Latest Unstable Version](https://poser.pugx.org/silverware/faqs/v/unstable)](https://packagist.org/packages/silverware/faqs)
[![License](https://poser.pugx.org/silverware/faqs/license)](https://packagist.org/packages/silverware/faqs)

Provides an FAQ page for [SilverWare][silverware] apps, divided into a series of categories and questions + answers.

## Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Issues](#issues)
- [Contribution](#contribution)
- [Maintainers](#maintainers)
- [License](#license)

## Requirements

- [SilverWare][silverware]

## Installation

Installation is via [Composer][composer]:

```
$ composer require silverware/faqs
```

## Usage

The module provides three pages ready for use within the CMS:

- `FAQPage`
- `FAQCategory`
- `FAQ`

Create a `FAQPage` as the top-level of your FAQs section. Under the `FAQPage` you
may add `FAQCategory` pages as children to divide the page into a series
of categories. Then, as children of `FAQCategory`, add your `FAQ` pages for individual
questions and answers.

## Issues

Please use the [GitHub issue tracker][issues] for bug reports and feature requests.

## Contribution

Your contributions are gladly welcomed to help make this project better.
Please see [contributing](CONTRIBUTING.md) for more information.

## Maintainers

[![Colin Tucker](https://avatars3.githubusercontent.com/u/1853705?s=144)](https://github.com/colintucker) | [![Praxis Interactive](https://avatars2.githubusercontent.com/u/1782612?s=144)](https://www.praxis.net.au)
---|---
[Colin Tucker](https://github.com/colintucker) | [Praxis Interactive](https://www.praxis.net.au)

## License

[BSD-3-Clause](LICENSE.md) &copy; Praxis Interactive

[silverware]: https://github.com/praxisnetau/silverware
[composer]: https://getcomposer.org
[issues]: https://github.com/praxisnetau/silverware-faqs/issues
