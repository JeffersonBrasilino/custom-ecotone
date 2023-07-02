<!--- BEGIN HEADER -->
# Changelog

All notable changes to this project will be documented in this file.
<!--- END HEADER -->

## [0.7.0](https://gitlab.fretebras.com.br/fretepago/payments/core/compare/v0.6.0...v0.7.0) (2023-06-24)

### Features

* :sparkles: domain errors ([6e83b7](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/6e83b78ef45950883149c1e4020da3182cf35d80))
* :sparkles: new application errors ([883208](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/883208eb2ff00a62520d45a61d4689bec224a9f3))
* :wastebasket: infrastructure errors ([764dd6](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/764dd6490aeb0f14664687db804dcd56e32e83f9))


---

## [0.7.0](https://gitlab.fretebras.com.br/fretepago/payments/core/compare/v0.6.0...v0.7.0) (2023-06-19)

### Features

* :sparkles: add get all metadata to metadata store ([e96d8b](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/e96d8b2dfb940a9c074165efcb48989976761ede))
* Added publish to third application message ([226326](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/2263269988fdd0c585cfaa82e026896ca8d25701))
* :boom: add new exception subclasses and change exception constructors ([641162](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/641162ba5d35bbb5d69830fcbb4107250b004ca4), [cd9e1a](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/cd9e1af072ebd380221e090a156186605f0e2775))
* :sparkles: add class event store to allow storing and retrieving domain events ([f8c351](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/f8c3511fc74242f235479dd6ddf1623d5724005b), [4ff031](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/4ff0311d4b69612b050405c1bd1993884daed84f))

### Bug Fixes

* Adjusted media converters not found error ([6a8fe7](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/6a8fe77573d9312d47e639eeccc25e79ed36bb0e))

### Code Refactoring

* :coffin: remove unused interface and classes ([a6ef23](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/a6ef2379f52924e7608248333f3a48eb0c7195fd))
* :fire: remove wip tests ([6f13c9](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/6f13c9080c0910d5c8da95dfc33b64102817dbae), [08fef1](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/08fef1397b44fffa5edafde6b40594bab4c3c461))
* :recycle: application contracts ([13306e](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/13306ed260f3cdd4ac2b81cff029e1674c758b16), [570544](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/570544fc6997b27e1b4d0c27763c0cc275cf70e4))
* :recycle: refactor and rename ([420279](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/420279388cb542ad09503323df83af737a79f984))

### Tests

* :white_check_mark: add unit test for Application classes ([897cf7](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/897cf723635201262c02179743cffbeadd969797), [ad7d4d](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/ad7d4d6612716a7caf681113aa1c1cc74010042b))
* :white_check_mark: add unit tests for domain classes. ([019784](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/01978472d1b9f56065a8ca747ba6b9968062fa1f), [b68139](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/b681391a94ee54943adbae7faf1c52cf9e06de56))

### Chores

* :arrow_up: update deps ([a9ace9](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/a9ace91d486308a0de76d0f49d5dc15ed66a34f0), [4103ae](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/4103ae7c62cf6c6e675c26e77b9db3291d1d5fc2), [5c2559](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/5c25595ee28e478dfa9c07e11951ce0760d8a9b3))
* :heavy_minus_sign: remove unnecessary dependency ([66ff27](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/66ff2714d2402a2474cd6f284c506326151d7778))


---

## [0.6.0](https://gitlab.fretebras.com.br/fretepago/payments/core/compare/v0.5.0...v0.6.0) (2023-06-15)

### Features

* :sparkles: add class event store to allow storing and retrieving domain events ([4ff031](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/4ff0311d4b69612b050405c1bd1993884daed84f))

### Code Refactoring

* :fire: remove wip tests ([08fef1](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/08fef1397b44fffa5edafde6b40594bab4c3c461))
* :recycle: application contracts ([570544](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/570544fc6997b27e1b4d0c27763c0cc275cf70e4))

### Tests

* :white_check_mark: add unit test for Application classes ([ad7d4d](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/ad7d4d6612716a7caf681113aa1c1cc74010042b))
* :white_check_mark: add unit tests for domain classes. ([b68139](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/b681391a94ee54943adbae7faf1c52cf9e06de56))

### Chores

* :arrow_up: update deps ([5c2559](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/5c25595ee28e478dfa9c07e11951ce0760d8a9b3))


---

## [0.5.0](https://gitlab.fretebras.com.br/fretepago/payments/core/compare/v0.4.0...v0.5.0) (2023-06-13)

### Features

* Add optional validator phone ([0501b4](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/0501b47d252f24cc579a67b2d5f03384afa83eb9), [cb4a7b](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/cb4a7b554d8dd16ca294dfba037af4b625329196))
* :boom: add new exception subclasses and change exception constructors ([cd9e1a](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/cd9e1af072ebd380221e090a156186605f0e2775))
* Create new validators optionals ([99b2eb](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/99b2eb97e77714ac11b811ff5380e12f343b547f), [d6470a](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/d6470a8e835fc8880e7fe849b9bf22717e70b589))
* Optional validators ([541e45](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/541e450849429a51ba0c26dbce65ebf674d0e5b8))

### Bug Fixes

* Added buildMessage function ([7ff2f6](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/7ff2f636a84b3654aa4cf54112489572adf20b81))
* Changed access modifier in function createEvent ([8072c8](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/8072c8d1e2a5ee0699364a099d12c60e28d360d8), [e378c5](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/e378c5483ef82b446ad6b519c486c56c20078476))
* Change value default isValid ([a3b9ef](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/a3b9efc0a3c63f58e471042d904c55bf8f29ddd6), [c2381f](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/c2381fc736b158002408c4fcf74e5f3713fce51c))
* Remove array type from return ([d6f2a4](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/d6f2a4d06700364ac3533dcf75ec3003150e9dcd), [bfd75a](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/bfd75aca01a56aa4fcf664c7dd4cc010833582ca))
* Returned access modifier in function createEvent ([67ef8f](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/67ef8f8f7ea04b7deabbea8f074561beb2216bf6), [2adaa0](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/2adaa07e72e70cf40e012261b3baf0253beea544), [699d0e](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/699d0ece4a9f926d09c8563d51935dc7cd7357ea))


---

## [0.4.0](https://gitlab.fretebras.com.br/fretepago/payments/core/compare/v0.3.0...v0.4.0) (2023-06-07)

### Features

* Add optional validator phone ([cb4a7b](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/cb4a7b554d8dd16ca294dfba037af4b625329196))
* Create new validators optionals ([d6470a](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/d6470a8e835fc8880e7fe849b9bf22717e70b589))
* Optional validators ([541e45](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/541e450849429a51ba0c26dbce65ebf674d0e5b8))

### Bug Fixes

* Changed access modifier in function createEvent ([e378c5](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/e378c5483ef82b446ad6b519c486c56c20078476))
* Change value default isValid ([c2381f](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/c2381fc736b158002408c4fcf74e5f3713fce51c))
* Init errorMessage in class constructor ([b95d5a](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/b95d5a1481d9373ee48f29091b7fb8ea2d6d85ce))
* Remove array type from return ([bfd75a](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/bfd75aca01a56aa4fcf664c7dd4cc010833582ca))
* Returned access modifier in function createEvent ([2adaa0](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/2adaa07e72e70cf40e012261b3baf0253beea544), [699d0e](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/699d0ece4a9f926d09c8563d51935dc7cd7357ea))

### Code Refactoring

* Added parameter id ([752458](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/752458ab1e7f6c0f764430c7030a11ad16b725e0))


---

## [0.3.0](https://gitlab.fretebras.com.br/fretepago/payments/core/compare/v0.2.1...v0.3.0) (2023-05-29)

### Features

* Added consume/produce messages in kafka partitions ([195aaa](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/195aaacb7dab0df00521a37a90454e89846db094))

### Bug Fixes

* :ambulance: fix error message structure ([98045d](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/98045ded6d1390ae6cde2cfed8a0cef244ff485f))
* Modifying primitive validations for new validation structure ([c59d2c](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/c59d2c72e43742adf4255218a6c0bd693abb6c54))
* New validation regex pattern for phones ([a13f38](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/a13f38aee2198a6e92c0e79074b5b265880c5ef4))
* Removed Interfacess Repositories and change type parameter in IMessageDispatcher ([589402](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/589402c1af714c8b14ab04c60c51ed6ddabaeb65))

### Styles

* :rotating_light: run lint-fix ([0af970](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/0af97099ac89f1f043a049375647fac089acaba0))

### Chores

* :arrow_up: install missing libs ([033bf9](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/033bf964816a411a28dad67dda7855e5d9f36298))


---

## [0.2.1](https://gitlab.fretebras.com.br/fretepago/payments/core/compare/v0.2.0...v0.2.1) (2023-05-26)

### Features

* Added kafka driver for ecotone ([28692c](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/28692c69c0bc7540e58c919ebc2077f6b25dd95f), [7681c2](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/7681c25feba288c675bb134ce866751de830637b))

### Bug Fixes

* Adjust namespaces ([a86abd](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/a86abdc5f94703ae8979befb511fd76de0aba745), [e3726e](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/e3726edd899e2377846e260d858715138d014d6f))

### Tests

* :white_check_mark: cargo scenario for validate collection ([1e0c37](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/1e0c377ded87da9305e898fa6801f9fe2c2ba7a1))


---

## [0.2.0](https://gitlab.fretebras.com.br/fretepago/payments/core/compare/v0.1.0...v0.2.0) (2023-05-26)

### Features

* Added kafka driver for ecotone ([7681c2](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/7681c25feba288c675bb134ce866751de830637b))

### Bug Fixes

* Adjust namespaces ([e3726e](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/e3726edd899e2377846e260d858715138d014d6f))

### Tests

* :white_check_mark: cargo scenario for validate collection ([1e0c37](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/1e0c377ded87da9305e898fa6801f9fe2c2ba7a1))


---

## [0.0.1](https://gitlab.fretebras.com.br/fretepago/payments/core/compare/c844643a6d4955874cbc0ae3952c4fc0001e6694...v0.0.1) (2023-05-25)

### Features

* Action factory ([39532e](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/39532e213d0a0c195fcf3e3a9acf9e13d3b7b489))
* Added functions execute factories and buildEnum ([76cfda](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/76cfdae96cc656e89ae6a429211fcd787e03824d))
* Added new functional errors ([68c1b3](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/68c1b3a907db449cf62d85d842becaa14f0e033e))
* Added parameter in reset function ([91675f](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/91675fc70a8c2d0861e9980db2a813cc8aba64e2))
* Add Infrastructure Error class ([601732](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/601732fc7db677dd9e4c9e3ac05bf597faa09fca))
* Create boolean validator ([9182ef](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/9182ef20905ab44e577a3abeaa729ffa68b7a8bf))
* Created function createEvent ([f34e76](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/f34e7672313c8eca86796fb416046e7ed60431d8))
* Custom message headers ([000ce1](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/000ce160d9a68590cc409c5a3d0423d2aff1551d))
* Http client ([66e579](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/66e5796cacafb68780a65a310ddb9c763a977aa8))
* Implement Validators ([8ec8e3](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/8ec8e3329da85ad9e452c329a02cf094c788b917))
* Project ([7d0936](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/7d0936f81dfc33dc2fb714c91b1005a419ffe4ad))
* Validate when value is a collection ([c769ae](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/c769ae79b3e51003e8a23c20711c221530bd39da))

### Bug Fixes

* Adjust gitignore unit tests running and added action signature in actions factory ([ad185c](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/ad185c304926649df28bb3a0195a2db32aee7a63))
* Changed action factory create signature ([7a19c4](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/7a19c4bd6d13785120e59ab1968608858bf245f6))
* Changed core structure ([35405c](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/35405c5752e9c2965ee8f3e23033001a632d9a9e))
* 🚑️ collection validation with errors ([f31917](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/f31917b08187ccc48f1a1be8b9a8e17cbd11b943))
* Fix BaseArrayObject default constructor parameter ([9d2b26](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/9d2b2673935aedd9ca883eb9a9681a1dd44fb0ed))
* Fixing namespace ([dcc9b9](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/dcc9b9edbf153d16115a7fbca1a7f2c85db5f0e9))
* Phone number validator ([ce0ce4](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/ce0ce40d9f29f62767e0da2cb9dd617cb96ab2fd))
* Tests namespaces ([abd2c8](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/abd2c8a863d63dfe4a2ceebaed043e6e41cb3f4d))

### Code Refactoring

* Changed interface repository ([5659c1](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/5659c147b668ab0740bcd27d4c3ec8f767578aa7))
* Correct namespace ([834402](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/834402b5323c73de51507e31b13d3f017be87292))
* Linting and vscode settings ([3a1516](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/3a15160593518d3c6acabddde26a3b224b463246))
* :recycle: define id as required ([39e993](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/39e9935ec6541f8543ec98e4d4f32ef8fe6e4ad3))
* Removed abstratRepositories and change validation in Entity ([2e44cd](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/2e44cdd3ebbe9a764a885a3299fabf35d54fba4a))

### Tests

* Action factory ([4be87f](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/4be87fb9a13a12ee31cab0c9496f3692c581f342))

### Chores

* Configure auto changelog ([ac0f1e](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/ac0f1ed3aba1be94a66ba41d4293917552df6813))
* :memo: restore original project name ([2ba6d4](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/2ba6d40145f416eed740a707407194c20273d210))
* Prepare to auto changelog ([078363](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/0783639c4d48fc1c027379bebee7fd97550e4697))
* Update dependencies ([63e5f9](https://gitlab.fretebras.com.br/fretepago/payments/core/commit/63e5f9b0eef5d785b7939272d548b934152ade8a))


---

