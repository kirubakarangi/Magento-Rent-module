<?php
class Rent_Catalog_Model_Mysql4_Setup extends Mage_Sales_Model_Mysql4_Setup {
	public function addAttribute($entityTypeId, $code, array $attr) {
        $entityTypeId = $this->getEntityTypeId($entityTypeId);
        $data = array(
            'entity_type_id'            => $entityTypeId,
            'attribute_code'            => $code,
            'backend_model'             => $this->_getValue($attr, 'backend', ''),
            'backend_type'              => $this->_getValue($attr, 'type', 'varchar'),
            'backend_table'             => $this->_getValue($attr, 'table', ''),
            'frontend_model'            => $this->_getValue($attr, 'frontend', ''),
            'frontend_input'            => $this->_getValue($attr, 'input', 'text'),
            'frontend_input_renderer'   => $this->_getValue($attr, 'input_renderer', ''),
            'frontend_label'            => $this->_getValue($attr, 'label', ''),
            'frontend_class'            => $this->_getValue($attr, 'frontend_class', ''),
            'source_model'              => $this->_getValue($attr, 'source', ''),
            'is_global'                 => $this->_getValue($attr, 'global', 1),
            'is_visible'                => $this->_getValue($attr, 'visible', 1),
            'is_required'               => $this->_getValue($attr, 'required', 1),
            'is_user_defined'           => $this->_getValue($attr, 'user_defined', 0),
            'default_value'             => $this->_getValue($attr, 'default', ''),
            'is_searchable'             => $this->_getValue($attr, 'searchable', 0),
            'is_filterable'             => $this->_getValue($attr, 'filterable', 0),
            'is_comparable'             => $this->_getValue($attr, 'comparable', 0),
            'is_visible_on_front'       => $this->_getValue($attr, 'visible_on_front', 0),
            'is_html_allowed_on_front'  => $this->_getValue($attr, 'is_html_allowed_on_front', 0),
            'is_visible_in_advanced_search'=> $this->_getValue($attr, 'visible_in_advanced_search', 0),
            'is_used_for_price_rules'   => $this->_getValue($attr, 'used_for_price_rules', 1),
            'is_filterable_in_search'   => $this->_getValue($attr, 'filterable_in_search', 0),
            'used_in_product_listing'   => $this->_getValue($attr, 'used_in_product_listing', 0),
            'used_for_sort_by'          => $this->_getValue($attr, 'used_for_sort_by', 0),
            'is_unique'                 => $this->_getValue($attr, 'unique', 0),
            'apply_to'                  => $this->_getValue($attr, 'apply_to', ''),
            'is_configurable'           => $this->_getValue($attr, 'is_configurable', 1),
            'note'                      => $this->_getValue($attr, 'note', ''),
            'position'                  => $this->_getValue($attr, 'position', 0),
        );
 
        $sortOrder = isset($attr['sort_order']) ? $attr['sort_order'] : null;
 
        if ($id = $this->getAttribute($entityTypeId, $code, 'attribute_id')) {
            $this->updateAttribute($entityTypeId, $id, $data, null, $sortOrder);
        } else {
            $this->_insertAttribute($data);
        }
 
        if (!empty($attr['group'])) {
            $sets = $this->_conn->fetchAll('select * from '.$this->getTable('eav/attribute_set').' where entity_type_id=?', $entityTypeId);
            foreach ($sets as $set) {
            	if ($attr['attribute_set'] == $set['attribute_set_name']) {
            		$this->addAttributeGroup($entityTypeId, $set['attribute_set_id'], $attr['group']);
                	$this->addAttributeToSet($entityTypeId, $set['attribute_set_id'], $attr['group'], $code, $sortOrder);
            	}
            }
        }
        if (empty($attr['is_user_defined'])) {
            $sets = $this->_conn->fetchAll('select * from '.$this->getTable('eav/attribute_set').' where entity_type_id=?', $entityTypeId);
            foreach ($sets as $set) {
            	if (!empty($attr['attribute_set'])) {
            		if ($attr['attribute_set'] == $set['attribute_set_name']) {
            			$this->addAttributeToSet($entityTypeId, $set['attribute_set_id'], $attr['group'], $code, $sortOrder);
            		}
            	}
            	else {
            		$this->addAttributeToSet($entityTypeId, $set['attribute_set_id'], $this->_generalGroupName, $code, $sortOrder);
            	}
            }
        }
 
        if (isset($attr['option']) && is_array($attr['option'])) {
            $option = $attr['option'];
            $option['attribute_id'] = $this->getAttributeId($entityTypeId, $code);
            $this->addAttributeOption($option);
        }
 
        return $this;
    }	
}
?>
