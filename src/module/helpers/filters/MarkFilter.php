<?php

namespace yii2module\guide\module\helpers\filters;

use Yii;
use yii\base\Object;

class MarkFilter extends Object {

	public function run($html) {
		$html = $this->replace($html);
		return $html;
	}

	private function replace($html) {
		$pattern = '~\[\[(.+?)\]\]~';
		$html = preg_replace_callback($pattern, function($matches) {
			return '<span class="broken-link">'.$matches[1].'</span>';
		}, $html);
		return $html;
	}

}
