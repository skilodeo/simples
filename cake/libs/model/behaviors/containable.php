<?php
/* SVN FILE: $Id: containable.php 7662 2008-09-25 16:49:56Z mark_story $ */
/**
 * Behavior for binding management.
 *
 * Behavior to simplify manipulating a model's bindings when doing a find operation
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *							  1785 E. Sahara Avenue, Suite 490-204
 *							  Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright	   Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package		 cake
 * @subpackage	  cake.cake.console.libs
 * @since		   CakePHP(tm) v 1.2.0.5669
 * @version		 $Revision: 7662 $
 * @modifiedby	  $LastChangedBy: mark_story $
 * @lastmodified	$Date: 2008-09-25 11:49:56 -0500 (Thu, 25 Sep 2008) $
 * @license		 http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Behavior to allow for dynamic and atomic manipulation of a Model's associations used for a find call. Most useful for limiting
 * the amount of associations and data returned.
 *
 * @package		cake
 * @subpackage	cake.cake.console.libs
 */
class ContainableBehavior extends ModelBehavior {
/**
 * Types of relationships available for models
 *
 * @var array
 * @access private
 */
	var $types = array('belongsTo', 'hasOne', 'hasMany', 'hasAndBelongsToMany');
/**
 * Runtime configuration for this behavior
 *
 * @var array
 * @access private
 */
	var $runtime = array();
/**
 * Initiate behavior for the model using specified settings. Available settings:
 *
 * - recursive: (boolean, optional) set to true to allow containable to automatically
 * 				determine the recursiveness level needed to fetch specified models,
 * 				and set the model recursiveness to this level. setting it to false
 * 				disables this feature. DEFAULTS TO: true
 *
 * - notices:	(boolean, optional) issues E_NOTICES for bindings referenced in a
 * 				containable call that are not valid. DEFAULTS TO: true
 *
 * - autoFields: (boolean, optional) auto-add needed fields to fetch requested
 * 				bindings. DEFAULTS TO: true
 *
 * @param object $Model Model using the behavior
 * @param array $settings Settings to override for model.
 * @access public
 */
	function setup(&$Model, $settings = array()) {
		if (!isset($this->settings[$Model->alias])) {
			$this->settings[$Model->alias] = array('recursive' => true, 'notices' => true, 'autoFields' => true);
		}
		if (!is_array($settings)) {
			$settings = array();
		}
		$this->settings[$Model->alias] = array_merge($this->settings[$Model->alias], $settings);
	}
/**
 * Runs before a find() operation. Used to allow 'contain' setting
 * as part of the find call, like this:
 *
 * Model->find('all', array('contain' => array('Model1', 'Model2')));
 *
 * Model->find('all', array('contain' => array(
 * 	'Model1' => array('Model11', 'Model12'),
 * 	'Model2',
 * 	'Model3' => array(
 * 		'Model31' => 'Model311',
 * 		'Model32',
 * 		'Model33' => array('Model331', 'Model332')
 * )));
 *
 * @param object $Model	Model using the behavior
 * @param array $query Query parameters as set by cake
 * @return array
 * @access public
 */
	function beforeFind(&$Model, $query) {
		$reset = (isset($query['reset']) ? $query['reset'] : true);
		$noContain = ((isset($this->runtime[$Model->alias]['contain']) && empty($this->runtime[$Model->alias]['contain'])) || (isset($query['contain']) && empty($query['contain'])));
		$contain = array();
		if (isset($this->runtime[$Model->alias]['contain'])) {
			$contain = $this->runtime[$Model->alias]['contain'];
			unset($this->runtime[$Model->alias]['contain']);
		}
		if (isset($query['contain'])) {
			$contain = array_merge($contain, (array)$query['contain']);
		}
		if ($noContain || !$contain || in_array($contain, array(null, false), true) || (isset($contain[0]) && $contain[0] === null)) {
			if ($noContain) {
				$query['recursive'] = -1;
			}
			return $query;
		}
		if ((isset($contain[0]) && is_bool($contain[0])) || is_bool(end($contain))) {
			$reset = is_bool(end($contain))
				? array_pop($contain)
				: array_shift($contain);
		}
		$containments = $this->containments($Model, $contain);
		$map = $this->containmentsMap($containments);

		$mandatory = array();
		foreach ($containments['models'] as $name => $model) {
			$instance =& $model['instance'];
			$needed = $this->fieldDependencies($instance, $map, false);
			if (!empty($needed)) {
				$mandatory = array_merge($mandatory, $needed);
			}
			if ($contain) {
				$backupBindings = array();
				foreach($this->types as $relation) {
					$backupBindings[$relation] = $instance->{$relation};
				}
				foreach ($this->types as $type) {
					$unbind = array();
					foreach ($instance->{$type} as $assoc => $options) {
						if (!isset($model['keep'][$assoc])) {
							$unbind[] = $assoc;
						}
					}
					if (!empty($unbind)) {
						if (!$reset && empty($instance->__backOriginalAssociation)) {
							$instance->__backOriginalAssociation = $backupBindings;
						} else if ($reset && empty($instance->__backContainableAssociation)) {
							$instance->__backContainableAssociation = $backupBindings;
						}
						$instance->unbindModel(array($type => $unbind), $reset);
					}
					foreach ($instance->{$type} as $assoc => $options) {
						if (isset($model['keep'][$assoc]) && !empty($model['keep'][$assoc])) {
							if (isset($model['keep'][$assoc]['fields'])) {
								$model['keep'][$assoc]['fields'] = $this->fieldDependencies($containments['models'][$assoc]['instance'], $map, $model['keep'][$assoc]['fields']);
							}
							if (!$reset && empty($instance->__backOriginalAssociation)) {
								$instance->__backOriginalAssociation = $backupBindings;
							} else if ($reset) {
								$instance->__backAssociation[$type] = $instance->{$type};
							}
							$instance->{$type}[$assoc] = array_merge($instance->{$type}[$assoc], $model['keep'][$assoc]);
						}
						if (!$reset) {
							$instance->__backInnerAssociation[] = $assoc;
						}
					}
				}
			}
		}

		if ($this->settings[$Model->alias]['recursive']) {
			$query['recursive'] = (isset($query['recursive'])) ? $query['recursive'] : $containments['depth'];
		}

		$autoFields = ($this->settings[$Model->alias]['autoFields']
					&& !in_array($Model->findQueryType, array('list', 'count'))
					&& !empty($query['fields']));
		if (!$autoFields) {
			return $query;
		}

		$query['fields'] = (array)$query['fields'];
		if (!empty($Model->belongsTo)) {
			foreach($Model->belongsTo as $assoc => $data) {
				if (!empty($data['fields'])) {
					foreach((array) $data['fields'] as $field) {
						$query['fields'][] = (strpos($field, '.') === false ? $assoc . '.' : '') . $field;
					}
				}
			}
		}
		if (!empty($mandatory[$Model->alias])) {
			foreach($mandatory[$Model->alias] as $field) {
				if ($field == '--primaryKey--') {
					$field = $Model->primaryKey;
				} else if (preg_match('/^.+\.\-\-[^-]+\-\-$/', $field)) {
					list($modelName, $field) = explode('.', $field);
					$field = $modelName . '.' . (($field === '--primaryKey--') ? $Model->$modelName->primaryKey : $field);
				}
				$query['fields'][] = $field;
			}
		}
		$query['fields'] = array_unique($query['fields']);
		return $query;
	}
/**
 * Resets original associations on models that may have receive multiple,
 * subsequent unbindings.
 *
 * @param object $Model Model on which we are resetting
 * @param array $results Results of the find operation
 * @param bool $primary true if this is the primary model that issued the find operation, false otherwise
 * @access public
 */
	function afterFind(&$Model, $results, $primary) {
		if (!empty($Model->__backContainableAssociation)) {
			foreach($Model->__backContainableAssociation as $relation => $bindings) {
				$Model->{$relation} = $bindings;
				unset($Model->__backContainableAssociation);
			}
		}
	}
/**
 * Unbinds all relations from a model except the specified ones. Calling this function without
 * parameters unbinds all related models.
 *
 * @param object $Model Model on which binding restriction is being applied
 * @return void
 * @access public
 */
	function contain(&$Model) {
		$args = func_get_args();
		$contain = call_user_func_array('am', array_slice($args, 1));
		$this->runtime[$Model->alias]['contain'] = $contain;
	}
/**
 * Permanently restore the original binding settings of given model, useful
 * for restoring the bindings after using 'reset' => false as part of the
 * contain call.
 *
 * @param object $Model Model on which to reset bindings
 * @return void
 * @access public
 */
	function resetBindings(&$Model) {
		if (!empty($Model->__backOriginalAssociation)) {
			$Model->__backAssociation = $Model->__backOriginalAssociation;
			unset($Model->__backOriginalAssociation);
		}
		$Model->resetAssociations();
		if (!empty($Model->__backInnerAssociation)) {
			$assocs = $Model->__backInnerAssociation;
			unset($Model->__backInnerAssociation);
			foreach($assocs as $currentModel) {
				$this->resetBindings($Model->$currentModel);
			}
		}
	}
/**
 * Process containments for model.
 *
 * @param object $Model Model on which binding restriction is being applied
 * @param array $contain Parameters to use for restricting this model
 * @param array $containments Current set of containments
 * @param bool $throwErrors Wether unexisting bindings show throw errors
 * @return array Containments
 * @access public
 */
	function containments(&$Model, $contain, $containments = array(), $throwErrors = null) {
		$options = array('className', 'joinTable', 'with', 'foreignKey', 'associationForeignKey', 'conditions', 'fields', 'order', 'limit', 'offset', 'unique', 'finderQuery', 'deleteQuery', 'insertQuery');
		$keep = array();
		$depth = array();
		if ($throwErrors === null) {
			$throwErrors = (empty($this->settings[$Model->alias]) ? true : $this->settings[$Model->alias]['notices']);
		}
		foreach ((array)$contain as $name => $children) {
			if (is_numeric($name)) {
				$name = $children;
				$children = array();
			}
			if (preg_match('/(?<!\.)\(/', $name)) {
				$name = str_replace('(', '.(', $name);
			}
			if (strpos($name, '.') !== false) {
				$chain = explode('.', $name);
				$name = array_shift($chain);
				$children = array(join('.', $chain) => $children);
			}

			$children = (array)$children;
			foreach ($children as $key => $val) {
				if (is_string($key) && is_string($val) && !in_array($key, $options, true)) {
					$children[$key] = (array) $val;
				}
			}

			$keys = array_keys($children);
			if ($keys && isset($children[0])) {
				$keys = array_merge(array_values($children), $keys);
			}

			foreach ($keys as $i => $key) {
				if (is_array($key)) {
					continue;
				}
				$optionKey = in_array($key, $options, true);
				if (!$optionKey && is_string($key) && preg_match('/^[a-z(]/', $key) && (!isset($Model->{$key}) || !is_object($Model->{$key}))) {
					$option = 'fields';
					$val = array($key);
					if ($key{0} == '(') {
						$val = preg_split('/\s*,\s*/', substr(substr($key, 1), 0, -1));
					} elseif (preg_match('/ASC|DESC$/', $key)) {
						$option = 'order';
						$val = $Model->{$name}->alias.'.'.$key;
					} elseif (preg_match('/[ =!]/', $key)) {
						$option = 'conditions';
						$val = $Model->{$name}->alias.'.'.$key;
					}
					$children[$option] = isset($children[$option]) ? array_merge((array) $children[$option], (array) $val) : $val;
					$newChildren = null;
					if (!empty($name) && !empty($children[$key])) {
						$newChildren = $children[$key];
					}
					unset($children[$key], $children[$i]);
					$key = $option;
					$optionKey = true;
					if (!empty($newChildren)) {
						$children = Set::merge($children, $newChildren);
					}
				}
				if ($optionKey && isset($children[$key])) {
					if (!empty($keep[$name][$key]) && is_array($keep[$name][$key])) {
						$keep[$name][$key] = array_merge((isset($keep[$name][$key]) ? $keep[$name][$key] : array()), (array) $children[$key]);
					} else {
						$keep[$name][$key] = $children[$key];
					}
					unset($children[$key]);
				}
			}

			if (!isset($Model->{$name}) || !is_object($Model->{$name})) {
				if ($throwErrors) {
					trigger_error(sprintf(__('Model "%s" is not associated with model "%s"', true), $Model->alias, $name), E_USER_WARNING);
				}
				continue;
			}

			$containments = $this->containments($Model->{$name}, $children, $containments);
			$depths[] = $containments['depth'] + 1;
			if (!isset($keep[$name])) {
				$keep[$name] = array();
			}
		}

		if (!isset($containments['models'][$Model->alias])) {
			$containments['models'][$Model->alias] = array('keep' => array(),'instance' => &$Model);
		}

		$containments['models'][$Model->alias]['keep'] = array_merge($containments['models'][$Model->alias]['keep'], $keep);
		$containments['depth'] = empty($depths) ? 0 : max($depths);
		return $containments;
	}
/**
 * Calculate needed fields to fetch the required bindings for the given model.
 *
 * @param object $Model Model
 * @param array $map Map of relations for given model
 * @param mixed $fields If array, fields to initially load, if false use $Model as primary model
 * @return array Fields
 * @access public
 */
	function fieldDependencies(&$Model, $map, $fields = array()) {
		if ($fields === false) {
			foreach($map as $parent => $children) {
				foreach($children as $type => $bindings) {
					foreach($bindings as $dependency) {
						if ($type == 'hasAndBelongsToMany') {
							$fields[$parent][] = '--primaryKey--';
						} else if ($type == 'belongsTo') {
							$fields[$parent][] = $dependency . '.--primaryKey--';
						}
					}
				}
			}
			return $fields;
		}
		if (empty($map[$Model->alias])) {
			return $fields;
		}
		foreach($map[$Model->alias] as $type => $bindings) {
			foreach($bindings as $dependency) {
				$innerFields = array();
				switch($type) {
					case 'belongsTo':
						$fields[] = $Model->{$type}[$dependency]['foreignKey'];
						break;
					case 'hasOne':
					case 'hasMany':
						$innerFields[] = $Model->$dependency->primaryKey;
						$fields[] = $Model->primaryKey;
						break;
				}
				if (!empty($innerFields) && !empty($Model->{$type}[$dependency]['fields'])) {
					$Model->{$type}[$dependency]['fields'] = array_unique(array_merge($Model->{$type}[$dependency]['fields'], $innerFields));
				}
			}
		}
		return array_unique($fields);
	}
/**
 * Build the map of containments
 *
 * @param array $containments Containments
 * @return array Built containments
 * @access public
 */
	function containmentsMap($containments) {
		$map = array();
		foreach ($containments['models'] as $name => $model) {
			$instance =& $model['instance'];
			foreach ($this->types as $type) {
				foreach ($instance->{$type} as $assoc => $options) {
					if (isset($model['keep'][$assoc])) {
						$map[$name][$type] = isset($map[$name][$type]) ? array_merge($map[$name][$type], (array)$assoc) : (array)$assoc;
					}
				}
			}
		}
		return $map;
	}
}
?>