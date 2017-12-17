<?php

namespace yii2module\guide\module\helpers\filters;

use yii\base\BaseObject;

class MarkFilter extends BaseObject {

	public function run($html) {
		$html = $this->replace($html);
		return $html;
	}

	private function replace($html) {
		$pattern = '~\[\[(.+?)\]\]~';
		$html = preg_replace_callback($pattern, function($matches) {
			$className = $matches[1];
			$arr = explode('::', $className);
			if(count($arr) == 2) {
				$className = $arr[0];
				$method = $arr[1];
			}
			$pageName = str_replace('\\', '-', $className);
			$pageName = strtolower($pageName);
			$link = 'http://www.yiiframework.com/doc-2.0/'.$pageName.'.html'/* . (!empty($method) ? '#' . $method . '-detail' : '')*/;
			$labelHtml = '<a class="text-danger broken-link" href="'.$link.'" target="_blank">'.$className . (!empty($method) ? '::' . $method : '') .'</a>';
			return $labelHtml;
		}, $html);
		return $html;
	}

}
