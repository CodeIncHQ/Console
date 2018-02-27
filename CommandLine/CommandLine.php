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
use CodeInc\CommandLine\Exceptions\RootRequiredException;
use CodeInc\CommandLine\Exceptions\CommandLineRequiredException;
use CodeInc\CommandLine\Exceptions\UserRequiredException;


/**
 * Class CommandLine
 *
 * @package CodeInc\CommandLine
 * @author Joan Fabrégat <joan@codeinc.fr>
 */
class CommandLine {
	/**
	 * Require CLI mode.
	 *
	 * @throws CommandLineRequiredException
	 */
	public static function requireCLI() {
		if (php_sapi_name() != "cli") {
			throw new CommandLineRequiredException();
		}
	}

	/**
	 * Require the root privileges.
	 *
	 * @throws RootRequiredException
	 */
	public static function requireRoot() {
		if ($_SERVER['USER'] != "root") {
			throw new RootRequiredException();
		}
	}

	/**
	 * Requires a given user.
	 *
	 * @param string $user
	 * @throws UserRequiredException
	 */
	public static function requireUser(string $user) {
		if ($_SERVER['USER'] != $user) {
			throw new UserRequiredException($user);
		}
	}
}