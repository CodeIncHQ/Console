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
// Time:     12:39
// Project:  serverinstall
//
namespace CodeInc\Cli;
use CodeInc\Cli\Exceptions\ConsoleException;
use CodeInc\Cli\Exceptions\ConsoleEmptyResponseException;
use CodeInc\Cli\Exceptions\ConsoleQuestionException;
use CodeInc\Cli\Exceptions\ConsoleWrongAnwserException;
use Colors\Color;


/**
 * Class Console
 *
 * @package ServerInstall
 * @author Joan Fabrégat <joan@codeinc.fr>
 */
class Console {
	/**
	 * @var bool
	 */
	private $throwExceptions;

	/**
	 * Console constructor.
	 *
	 * @param bool|null $throwExceptions
	 */
	public function __construct(bool $throwExceptions = null)
	{
		$this->throwExceptions = $throwExceptions ?? false;
	}

	/**
	 * Asks a yes/no question
	 *
	 * @param string $question
	 * @return bool
	 * @throws ConsoleException
	 */
	public function askBool(string $question):bool
	{
		try {
			// asking
			$r = strtolower($this->askString("$question (y/n)"));

			// if "yes"
			if ($r == "y" || $r = "yes") {
				return true;
			}

			// if "no"
			else if ($r = "n" || $r = "no") {
				return false;
			}

			// else: exception
			else {
				throw new ConsoleWrongAnwserException($r, ["y", "yes", "n", "no"]);
			}
		}
		catch (ConsoleException $exception) {
			if (!$this->throwExceptions) {
				$this->renderError($exception);
				return $this->askBool($question);
			}
			else {
				throw $exception;
			}
		}
		catch (\Throwable $exception) {
			throw new ConsoleQuestionException($question, $exception);
		}
	}

	/**
	 * Asks a question with a closed list of anwsers. Returns the given anwser or null if the response is empty.
	 *
	 * @param string $question
	 * @param array $options
	 * @param bool|null $allowEmpty default: false
	 * @return string|null
	 * @throws ConsoleException
	 */
	public function askOptions(string $question, array $options, ?bool $allowEmpty = null):?string
	{
		try {
			// building question and asking
			$q = $question." (".implode("/", array_keys($options)).")".PHP_EOL;
			foreach ($options as $key => $value) {
				echo "$key - $value".PHP_EOL;
			}
			$r = readline($q);

			// chechking answer
			if (empty($r)) {
				if ($allowEmpty === true) {
					return null;
				}
				throw new ConsoleEmptyResponseException();
			}
			if (!array_key_exists($r, $options)) {
				throw new ConsoleWrongAnwserException($r, array_keys($options));
			}

			// returning the selected option
			return $r;
		}
		catch (ConsoleException $exception) {
			if (!$this->throwExceptions) {
				$this->renderError($exception);
				return $this->askOptions($question, $options);
			}
			else {
				throw $exception;
			}
		}
		catch (\Throwable $exception) {
			throw new ConsoleQuestionException($question, $exception);
		}
	}

	/**
	 * Asks a question a gets the string anwsers or null if the answer is empty.
	 *
	 * @param string $question
	 * @param bool|null $allowEmpty default: true
	 * @return string|null
	 * @throws ConsoleException
	 */
	public function askString(string $question, ?bool $allowEmpty = null):?string
	{
		try {
			$r = readline($question);
			if ($allowEmpty === false && empty($r)) {
				throw new ConsoleEmptyResponseException();
			}

			return $r ?: null;
		}
		catch (ConsoleException $exception) {
			if (!$this->throwExceptions) {
				$this->renderError($exception);
				return $this->askString($question, $allowEmpty);
			}
			else {
				throw $exception;
			}
		}
		catch (\Throwable $exception) {
			throw new ConsoleQuestionException($question, $exception);
		}
	}

	/**
	 * Redners an error message (bold and red text).
	 *
	 * @param string|\Exception $msg
	 */
	protected function renderError($msg):void
	{
		if ($msg instanceof \Exception) {
			$msg = $msg->getMessage();
		}
		echo (new Color())->__invoke($msg)->red->bold.PHP_EOL;
	}
}