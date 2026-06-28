# Light Symfony Bundle

## About

TODO: make description

## Install

Add the code into `composer.json`:

```json
    "repositories": [
        {
            "type": "vcs",
            "url": "corvet/light-symfony-bundle.git"
        }
    ],
    
    "corvet/light-symfony-bundle": "dev-main",
```

Run install:

```bash
composer update corvet/light-symfony-bundle
```

Add code to `assets/stimulus_bootstrap.js`:

```javascript
import LightSymfonyRegistrator from '@corvet/light-symfony-bundle/registrator.js';

LightSymfonyRegistrator.doRegister(app);
```
