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
namespace CodeInc\CLI;
use CodeInc\CLI\Exceptions\RootRequiredException;
use CodeInc\CLI\Exceptions\CLIRequiredException;
use CodeInc\CLI\Exceptions\UserRequiredException;


/**
 * Class CLI
 *
 * @package CodeInc\CLI
 * @author Joan Fabrégat <joan@codeinc.fr>
 */
class CLI {
	/**
	 * Require CLI mode.
	 *
	 * @throws CLIRequiredException
	 */
	public static function requireCLI() {
		if (php_sapi_name() != "cli") {
			throw new CLIRequiredException();
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