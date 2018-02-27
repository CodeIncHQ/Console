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
// Time:     13:10
// Project:  lib-cli
//
namespace CodeInc\Cli\Exceptions;
use CodeInc\Cli\CommandLineException;
use Throwable;


/**
 * Class RootRequiredException
 *
 * @package CodeInc\CLI\Exce
 * @author Joan Fabrégat <joan@codeinc.fr>
 */
class RootRequiredException extends CommandLineException {
	/**
	 * RootRequiredException constructor.
	 *
	 * @param Throwable|null $previous
	 */
	public function __construct(Throwable $previous = null)
	{
		parent::__construct("This script requires root privileges", $previous);
	}
}