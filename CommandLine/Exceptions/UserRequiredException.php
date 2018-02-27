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
// Time:     13:11
// Project:  lib-cli
//
namespace CodeInc\CommandLine\Exceptions;
use CodeInc\CommandLine\CommandLineException;
use Throwable;


/**
 * Class UserRequiredException
 *
 * @package CodeInc\CLI\Exce
 * @author Joan Fabrégat <joan@codeinc.fr>
 */
class UserRequiredException extends CommandLineException {
	/**
	 * UserRequiredException constructor.
	 *
	 * @param string $user
	 * @param Throwable|null $previous
	 */
	public function __construct(string $user, Throwable $previous = null)
	{
		parent::__construct("This script requires the user account \"$user\"", $previous);
	}
}