<?php
/* @var $this IndexController */

$this->breadcrumbs=array(
	'Index',
);

?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
    <?php
        $items = Item::model()->findAll();
        foreach($items as $item){
            $itemAttributes = $item->getAttributes();
            echo "<a class='favLink' href='javascript:tools.addFav(".$itemAttributes['item_id'].")' item_id='".$itemAttributes['item_id']."'>收藏</a>";
            echo "<a class='favLink' href='javascript:tools.addShare(".$itemAttributes['item_id'].")' item_id='".$itemAttributes['item_id']."'>推荐</a>";
            echo "<hr/>";
        }
    ?>
</p>
