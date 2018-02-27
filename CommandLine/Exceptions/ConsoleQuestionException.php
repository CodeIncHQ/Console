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
// Time:     13:22
// Project:  lib-cli
//
namespace CodeInc\CommandLine\Exceptions;
use Throwable;


/**
 * Class ConsoleQuestionException
 *
 * @package CodeInc\CommandLine\Exceptions
 * @author Joan Fabrégat <joan@codeinc.fr>
 */
class ConsoleQuestionException extends ConsoleException {
	/**
	 * QuestionException constructor.
	 *
	 * @param string $question
	 * @param Throwable $previous
	 */
	public function __construct(string $question, Throwable $previous)
	{
		parent::__construct("Error while asking the user \"$question\"", $previous);
	}
}