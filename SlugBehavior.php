<?php
class SlugBehavior extends ModelBehavior{

	public function setup(Model $Model, $settings = array()){
		if(!isset($this->settings[$Model->alias])){
			$this->settings[$Model->alias] = array(
				'fieldName'	=>	'name',
				'fieldSlug'	=>	'slug',
				'separator'	=>	'-'
			);
		}
		$this->settings[$Model->alias] = array_merge(
			$this->settings[$Model->alias],
			$settings
		);
	}

	public function beforeSave(Model $Model, $options = array()){
		$fieldName = $this->settings[$Model->alias]['fieldName'];
		$fieldSlug = $this->settings[$Model->alias]['fieldSlug'];
		if(
			isset($Model->data[$Model->alias][$fieldName]) &&
			(
				!isset($Model->data[$Model->alias][$fieldSlug]) ||
				empty($Model->data[$Model->alias][$fieldSlug]) ||
				$Model->data[$Model->alias][$fieldSlug] != strtolower(Inflector::slug($Model->data[$Model->alias][$fieldName]))
			)
		){
			$Model->data[$Model->alias][$fieldSlug] = strtolower(
				Inflector::slug(
					$Model->data[$Model->alias][$fieldName],
					$this->settings[$Model->alias]['separator']
				)
			);
		}
	}
}