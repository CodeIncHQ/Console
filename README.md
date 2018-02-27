# Code Inc.'s command line interface library

## Usage

### `CommandLine` class

The `CommandLine` class provides simple utility static methods

```php
<?php
use CodeInc\CommandLine\CommandLine;

CommandLine::requireCLI(); // requires the CLI mode
CommandLine::requireRoot(); // requires the root user
CommandLine::requireUser("username"); // requires a given user
```

### `Console` class

The `Console` class allows you to interact with the user through the console. 

```php
<?php
use CodeInc\CommandLine\Console;

// the parameter specifies if the class should throw exceptions
$console = new Console(true);

/*
 * Asks a Yes / No question and returns a boolean
 */
// returns true or false
$console->askBool("Do you like chocolate?"); 

/*
 * Asks a questions expecting a string as an answer
 */
// returns the response or null if no response is provided
echo $console->askString("What is your city?"); 

// returns the response or throws an exception if no response is provided
echo $console->askString("What is your city?", false); 

/*
 * Asks a questions with a closed list of anwsers
 */
$colors = ["green", "red", "blue", "purple", "orange", "yellow"];

// returns chosen color or throws an exception if no response is provided
echo $console->askOptions("What is your favorite color?", $colors); 

// returns chosen color or null if no response is provided
echo $console->askOptions("What is your favorite color?", $colors, true); 
```

### `Arguments` class

The `Arguments` class is intended to help accessing the script arguments and parameters.

```php
<?php
use CodeInc\CommandLine\Arguments;

// for the request 'myScript.php --param1=val1 --param2 -aDG'
$arguments = new Arguments();
$arguments->hasParameter("a"); // returns true
$arguments->hasParameter("D"); // returns true
$arguments->hasParameter("G"); // returns true
$arguments->hasParameter("z"); // returns false
$arguments->getArgumentValue("param1"); // returns 'val1'
$arguments->getArgumentValue("param2"); // returns null
$arguments->getArgumentValue("param3"); // returns false
$arguments->hasArgument("param2"); // returns true
```