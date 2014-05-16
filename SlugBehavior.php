<?php App::uses('ModelBehavior', 'Model/Behavior');
/* 
 * @name : SlugBehavior
 * @author : Lartak
 * @url Github : https://github.com/Lartak
 * @url Behavior : https://github.com/Lartak/SlugBehavior-for-CakePHP
 * @url Documentation du Behavior : http://lartak.github.io/SlugBehavior-for-CakePHP
*/
class SlugBehavior extends ModelBehavior {

	public function setup(Model $Model, $settings = array()) {
		if(!isset($this->settings[$Model->alias])){
			$this->settings[$Model->alias] = array(
				'fieldName'	=>	'name', // Nom du champ à sluggifier (name par defaut)
				'fieldSlug'	=>	'slug', // Nom du champ reçevant le slug (slug par défaut)
				'separator'	=>	'-', // Séparateur ([-] par défaut)
				'lowercase'	=>	true // Majuscules non autorisée par défaut (définir à false pour autoriser les majuscules)
			);
		}
		$this->settings[$Model->alias] = array_merge($this->settings[$Model->alias], (array)$settings);
	}

	public function beforeSave(Model $Model, $options = array()) {
		$fieldName = $this->settings[$Model->alias]['fieldName'];
		$fieldSlug = $this->settings[$Model->alias]['fieldSlug'];
		$separator = $this->settings[$Model->alias]['separator'];
		
		if ($this->settings[$Model->alias]['lowercase'] == true) {
			$slug = strtolower(Inflector::slug($Model->data[$Model->alias][$fieldName], $this->settings[$Model->alias]['separator']));
		} else {
			$slug = Inflector::slug($Model->data[$Model->alias][$fieldName], $this->settings[$Model->alias]['separator']);
		}
		
		if (isset($Model->data[$Model->alias][$fieldName]) && (!isset($Model->data[$Model->alias][$fieldSlug]) || empty($Model->data[$Model->alias][$fieldSlug]) || $Model->data[$Model->alias][$fieldSlug] != $slug)) {
			$Model->data[$Model->alias][$fieldSlug] = $slug; 
		}
	}
	
/*	public function getSlugs(Model $Model, $results, $primary = false) {
		$this->loadModel($Model->alias);
		$options = array('fields' => array($this->settings[$Model->alias]['fieldSlug']));
		return $this->{$Model->alias}->find('all', $options);
	}*/
}
