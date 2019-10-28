# Chain Builder
This php package provides a set of classes to create a chain of method as string from array elements and respecting given rules/options.
(supports GET and POST with use simply string 'GET' and 'POST').

## Main Classes
1. Builder: This class receives the rules to follow and tries to build a chain string.
2. Options: Extend this class to define options to give to builder.
3. Collector: (Singleton) This class is a store of chains. Everyone chain will have his name and his properties.

## How to use it
Open test/chain.php

## Documentation
Coming soon.

## Execute the chain
You can use the ChainExecutor package. They has been designed to use together.

#### Developed by Daniele Tulone