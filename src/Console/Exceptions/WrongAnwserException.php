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
// Time:     13:20
// Project:  lib-cli
//
namespace CodeInc\CLI\Console\Exceptions;
use Throwable;


/**
 * Class WrongAnwserException
 *
 * @package CodeInc\CLI\Console\Exceptions
 * @author Joan Fabrégat <joan@codeinc.fr>
 */
class WrongAnwserException extends ConsoleException {
	/**
	 * WrongAnwserException constructor.
	 *
	 * @param string $anwser
	 * @param array|null $options
	 * @param Throwable|null $previous
	 */
	public function __construct(string $anwser, array $options = null, Throwable $previous = null) {
		$message = "Unable to understand the anwser \"$anwser\"";
		if ($options) {
			$message .= " (possible anwsers: ".implode(", ", $options).")";
		}
		parent::__construct($message, $previous);
	}
}