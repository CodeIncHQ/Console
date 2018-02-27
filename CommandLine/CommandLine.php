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
	 * Requires CLI mode.
	 *
	 * @throws CommandLineRequiredException
	 */
	public static function requireCLI():void
	{
		if (!self::isCLI()) {
			throw new CommandLineRequiredException();
		}
	}

	/**
	 * Verifies if the script runs in CLI mode.
	 *
	 * @return bool
	 */
	public static function isCLI():bool
	{
		return php_sapi_name() == "cli";
	}

	/**
	 * Require the root privileges.
	 *
	 * @throws RootRequiredException
	 */
	public static function requireRoot():void
	{
		if (!self::isRoot()) {
			throw new RootRequiredException();
		}
	}

	/**
	 * Verifies if the current user is the "root".
	 *
	 * @uses CommandLine::isUser()
	 * @return bool
	 */
	public static function isRoot():bool
	{
		return self::isUser("root");
	}

	/**
	 * Requires a given user.
	 *
	 * @param string $user
	 * @throws UserRequiredException
	 */
	public static function requireUser(string $user):void
	{
		if (!self::isUser($user)) {
			throw new UserRequiredException($user);
		}
	}

	/**
	 * Verifies if the current user is the given user.
	 *
	 * @param string $user
	 * @return bool
	 */
	public static function isUser(string $user):bool
	{
		return self::getUser() == $user;
	}

	/**
	 * Returns the current user name or null is the user is unknow.
	 *
	 * @return null|string
	 */
	public static function getUser():?string {
		return $_SERVER['USER'] ?? null;
	}
}