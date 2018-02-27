<?php
//
// +---------------------------------------------------------------------+
// | CODE INC. SOURCE CODE - CONFIDENTIAL                                |
// +---------------------------------------------------------------------+
// | Copyright (c) 2017 - Code Inc. SAS - All Rights Reserved.           |
// | Visit https://www.codeinc.fr for more information about licensing.  |
// +---------------------------------------------------------------------+
// | NOTICE:  All information contained herein is, and remains the       |
// | property of Code Inc. SAS. The intellectual and technical concepts  |
// | contained herein are proprietary to Code Inc. SAS are protected by  |
// | trade secret or copyright law. Dissemination of this information or |
// | reproduction of this material  is strictly forbidden unless prior   |
// | written permission is obtained from Code Inc. SAS.                  |
// +---------------------------------------------------------------------+
//
// Author:   Joan Fabrégat <joan@codeinc.fr>
// Date:     19/12/2017
// Time:     13:08
// Project:  lib-cli
//
namespace CodeInc\CommandLine;
use CodeInc\ArrayAccess\ArrayAccessTrait;
use CodeInc\CommandLine\Exceptions;


/**
 * Class Arguments
 *
 * @package CodeInc\CommandLine
 * @author Joan Fabrégat <joan@codeinc.fr>
 */
class Arguments implements \ArrayAccess, \IteratorAggregate {
	use ArrayAccessTrait;

	/**
	 * RAW script arguments.
	 *
	 * @var array
	 */
	private $input;

	/**
	 * Parsed arguments.
	 *
	 * @var array
	 */
	private $arguments = [];

	/**
	 * Parsed parameters.
	 *
	 * @var array
	 */
	private $parameters = [];

	/**
	 * Args constructor.
	 *
	 * @throws Exceptions\CommandLineRequiredException
	 */
	public function __construct() {
		CommandLine::requireCLI();
		$this->input = $GLOBALS['argv'];
		$this->parse();
	}

	/**
	 * Parses the arguments
	 */
	private function parse():void
	{
		$continueNext = false;
		foreach ($this->input as $key => $entry) {
			if ($key > 0) {
				if ($continueNext) {
					$continueNext = false;
					continue;
				}

				if (preg_match('/^--([a-z0-9_]+)(=(.+))?$/ui', $entry, $matches)) {
					$this->arguments[$matches[1]] = $matches[3] ?? null;
				}
				else if (preg_match('/^-([a-z0-9_]{1})$/ui', $entry, $matches)) {
					if (isset($this->input[$key + 1]) && !preg_match('/^-.+/ui', $this->input[$key + 1])) {
						$this->arguments[$matches[1]] = $this->input[$key + 1];
						$continueNext = true;
					}
					else {
						$this->arguments[$matches[1]] = null;
					}
				}
				else if (preg_match('/^-([a-z0-9_]+)$/ui', $entry, $matches)) {
					for ($i = 0; $i < strlen($matches[1]); $i++) {
						$this->arguments[$matches[1][$i]] = null;
					}
				}
				else {
					$this->parameters[] = $entry;
				}
			}
		}
	}

	/**
	 * Returns the list of parameters.
	 *
	 * @return array
	 */
	public function getParameters():array
	{
		return $this->parameters;
	}

	/**
	 * Count parameters.
	 *
	 * @return int
	 */
	public function countParameters():int
	{
		return count($this->parameters);
	}

	/**
	 * Verifies if the script has been called with a least one parameter.
	 *
	 * @return bool
	 */
	public function hasParameters():bool
	{
		return !empty($this->parameters);
	}

	/**
	 * Returns the parsed arguments in an assoc array with their values.
	 *
	 * @return array
	 */
	public function getArguments():array
	{
		return $this->arguments;
	}

	/**
	 * Count arguments.
	 *
	 * @return int
	 */
	public function countArguments():int
	{
		return count($this->arguments);
	}

	/**
	 * Verifies if the script has been called with a least one argument.
	 *
	 * @return bool
	 */
	public function hasArguments():bool
	{
		return !empty($this->arguments);
	}

	/**
	 * Returns the raw input.
	 *
	 * @return array
	 */
	public function getInput():array
	{
		return $this->input;
	}

	/**
	 * Returns a parameter's value using its number or FALSE if the script does'nt have such a parameter.
	 *
	 * @param int $number
	 * @return string|null
	 */
	public function getParameterValue(int $number):?string
	{
		if (array_key_exists($number, $this->parameters)) {
			return $this->parameters[$number];
		}
		return null;
	}

	/**
	 * Returns a parameter's number in the scripts parameters or FALSE if the script does'nt have such a parameter.
	 *
	 * @param string $parameter
	 * @return int|null
	 */
	public function getParameterNumber(string $parameter):?int
	{
		return array_search($parameter, $this->parameters) ?: null;
	}

	/**
	 * Verifies if the script has a parameter.
	 *
	 * @param string $parameter
	 * @return bool
	 */
	public function hasParameter(string $parameter):bool
	{
		return in_array($parameter, $this->parameters);
	}

	/**
	 * Verifies if the script has an argument.
	 *
	 * @param string|array $argument The name (string) or the names (array) of the argument
	 * @return bool
	 */
	public function hasArgument($argument):bool
	{
		if (is_array($argument)) {
			foreach ($argument as $value) {
				if ($this->hasArgument($value)) {
					return true;
				}
			}
			return false;
		}
		else {
			return array_key_exists($argument, $this->arguments);
		}
	}

	/**
	 * Returns the scripts argument's value, NULL if the argument has no value or FALSE of the script
	 * does'nt have this argument.
	 *
	 * @param string|array $argument The name (string) or the names (array) of the argument
	 * @return string|null|false
	 */
	public function getArgumentValue($argument)
	{
		if (is_array($argument)) {
			foreach ($argument as $value) {
				if (array_key_exists($value, $this->arguments)) {
					return $this->arguments[$value];
				}
			}
		}
		elseif ($this->hasArgument($argument)) {
			return $this->arguments[$argument];
		}
		return false;
	}

	/**
	 * Returns the interator.
	 *
	 * @return \ArrayIterator
	 */
	public function getIterator():\ArrayIterator
	{
		return new \ArrayIterator($this->arguments);
	}

	/**
	 * Returns the arguments array.
	 *
	 * @return array
	 */
	protected function getAccessibleArray():array
	{
		return $this->arguments;
	}
}