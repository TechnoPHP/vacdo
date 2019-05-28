<?php
$category = $data['Articlecategory'];
if (!$category['active']) { // You can do anything here depending on the record content
    return;
}
echo "<span><i class='glyphicon glyphicon-minus'></i></span>".$this->Html->link($category['name'], array('controller'=>'articles','action'=> 'filter','category' => Inflector::slug($category['name'],'-'),'articlecategoryid'=>$category['id']),array("escape"=>false));
?>