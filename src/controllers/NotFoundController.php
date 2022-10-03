<?php

namespace Src\Controllers;

use Src\View;

class NotFoundController
{
	public function index()
	{
		return View::render('p404');
	}
}
