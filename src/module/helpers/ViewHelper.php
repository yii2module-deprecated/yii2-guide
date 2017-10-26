<?php

namespace yii2module\guide\module\helpers;

use DomainException;
use Highlight\Highlighter;
use Yii;
use yii\helpers\Url;
use Michelf\MarkdownExtra;
use yii2lab\helpers\yii\Html;

class ViewHelper {

	private static $highlighter;

	public static function collectionToMap($collection) {
		$map = [];
		foreach($collection as $entity) {
			$map[$entity->group][] = $entity;
		}
		return $map;
	}

	public static function markdownToHtml($source) {
		$markdown = new MarkdownExtra();
		$html = $markdown->transform($source);
		$html = static::replaceInternalLink($html);
		$html = static::replaceExternalLink($html);
		$html = static::replaceCode($html);
		$html = static::replaceImg($html);
		$html = static::replaceAlert($html);
		$html = static::replaceSelect($html);
		return $html;
	}

	public static function collectionToItems($collection, $url, $key = 'id') {
		$items = [];
		foreach($collection as $item) {
			if(is_array($key)) {
				$urlArray[$key[0]] = $item->{$key[1]};
			} else {
				$urlArray[$key] = $item->id;
			}
			$items[] = [
				'label' => $item->title,
				'url' => NavigationHelper::genUrl($url, $urlArray),
			];
		}
		return $items;
	}

	private static function replaceInternalLink($html) {
		$pattern = '~<a href="([^.]+).md">([^<]+)?</a>~';
		$callback = function ($matches) {
			$url = NavigationHelper::genUrl(NavigationHelper::URL_ARTICLE_VIEW);
			$url['id'] = $matches[1];
			return '<a href="'.Url::to($url).'">'.$matches[2].'</a>';
		};
		$html = preg_replace_callback($pattern, $callback, $html);
		return $html;
	}

	private static function replaceExternalLink($html) {
		$pattern = '~<a href="(http[^\"]+)">([^<]+)?</a>~';
		$replacement = '<a href="$1" target="_blank">$2</a>';
		$html = preg_replace($pattern, $replacement, $html);
		return $html;
	}

	private static function replaceImg($html) {
		$project_id = Yii::$app->request->getQueryParam('project_id');
		$project = Yii::$app->guide->project->oneById($project_id);
		$pattern = '~<img src="([^"]+)"([^\>]*)>~';
		$html = preg_replace_callback($pattern, function($matches) use($project) {
			$url = $matches[1];
			if(strpos($url, '://') !== false) {
				return $matches[0];
			}
			$fileName = ROOT_DIR . DS . $project->dir . DS . $url;
			$data = Html::getDataUrl($fileName);
			return "<img src=\"{$data}\"{$matches[2]}>";
		}, $html);
		return $html;
	}

	private static function replaceCode($html) {
		$pattern = '~<pre>\s*<code class=\"([\w]+)\">([\s\S]+?)</code>\s*</pre>~';
		$html = preg_replace_callback($pattern, function($matches) {
			$block['language'] = $matches[1];
			$block['content'] = html_entity_decode($matches[2]);
			$html = self::renderCode($block);
			return $html;
		}, $html);
		return $html;
	}

	private static function replaceAlert($html) {
		$pattern = '~<blockquote>\s*<p>\s*(\w+?)\:~';
		$html = preg_replace_callback($pattern, function($matches) {
			return '<blockquote class="'.strtolower($matches[1]).'"><p><b>'.$matches[1].'</b>:';
		}, $html);
		return $html;
	}

	private static function replaceSelect($html) {
		$pattern = '~\[\[(.+?)\]\]~';
		$html = preg_replace_callback($pattern, function($matches) {
			return '<span class="broken-link">'.$matches[1].'</span>';
		}, $html);
		return $html;
	}

	private function renderCode($block)
	{
		if (self::$highlighter === null) {
			self::$highlighter = new Highlighter();
			self::$highlighter->setAutodetectLanguages([
				'apache', 'nginx',
				'bash', 'dockerfile', 'http',
				'css', 'less', 'scss',
				'javascript', 'json', 'markdown',
				'php', 'sql', 'twig', 'xml',
			]);
		}
		try {
			if (isset($block['language'])) {
				$result = self::$highlighter->highlight($block['language'], $block['content']);
				return "<pre><code class=\"hljs {$result->language} language-{$block['language']}\">{$result->value}</code></pre>";
			} else {
				$result = self::$highlighter->highlightAuto($block['content']);
				return "<code class=\"hljs {$result->language}\">{$result->value}</code></pre>";
			}
		} catch (DomainException $e) {
			echo $e;
			return parent::renderCode($block);
		}
	}

}
