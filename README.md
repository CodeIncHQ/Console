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
if ($console->askBool("Do you like chocolate?")) {
	echo "true";
}
else {
	echo "false";
}

/*
 * Asks a questions expecting a string as an answer
 */
echo $console->askString("What is your city?");

/*
 * Asks a questions with a closed list of anwsers
 */
$colors = ["green", "red", "blue", "purple", "orange", "yellow"];
echo $console->askOptions("What is your favorite color?", $colors);
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