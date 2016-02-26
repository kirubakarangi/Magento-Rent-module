<?php
$installer = $this;
$installer->startSetup();
 
$installer->addAttribute('catalog_product', 'own_attribute',array(
	'attribute_set'		=> 'Default', // note the addition of this array key
	'group'				=> 'General', // and this one
	'label'				=> 'Own Attribute',
    'type'              => 'varchar',
    'input'             => 'multiselect',
    'backend'           => 'eav/entity_attribute_backend_array',
    'frontend'          => '',
    'source'            => '',
    'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    'visible'           => true,
    'required'          => false,
    'is_user_defined'   => true,
    'searchable'        => false,
    'filterable'        => false,
    'comparable'        => false,
    'option'            => array (
        'value' => array('optionone' => array('Option One'),
						 'optiontwo' => array('Option Two'),
						 'optionthree' => array('Option Three'),
						)
    ),
    'visible_on_front'  => false,
    'visible_in_advanced_search' => false,
    'unique'            => false
));
 
$installer->endSetup();
?>
