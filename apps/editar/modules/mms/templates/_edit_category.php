
<?php use_helper('Object');?>

<div style="height:41px"></div>
<div id="tv_admin_container" style="padding: 4px 20px 20px">
<fieldset id="tv_fieldset_none" class="" style="position:relative">

<div style="text-align: right; padding: 5px 20px">
  <input type="checkbox" checked="checked" onchange="toggle_show_all();"/> Mostrar todas las categorias
</div>


<div style="float: right; padding: 5px 20px" id="cat_update_link_<?php echo $mm->getSerialId()?>">
   <?php echo link_to_remote("Copiar estas categorias a toda la serie", 
       array('update' => 'cat_update_link_' . $mm->getSerialId(), 
             'url' => 'mms/serialcategory?mm_id='. $mm->getId() .'&serial_id=' . $mm->getSerialId(), 
             'confirm' => 'Seguro que desea copiar estas categorias a toda la serie?', 
             'script' => 'true', 'before' => '$("cat_update_link_' . $mm->getSerialId() . '").innerHTML = "loading...";')); ?>
</div>

<dl style="margin: 0px">


   <?php /*$aux = CategoryPeer::buildTreeArray(); foreach(($aux[0][CategoryPeer::TREE_ARRAY_CHILDREN]) as $node): $c = $node[CategoryPeer::TREE_ARRAY_NODE] */?>
   <?php foreach(CategoryPeer::doSelectParents() as $c): $children = $c->getChildren() ?>
   <?php if(!$c->getDisplay()) continue?>
   <div class="form-row">
   <dt><?php echo $c->getName()?>:</dt>
   <dd>
     <div id="category<?php echo $c->getId()?>_mms">

<div style="overflow:hidden;height: 270px"><?php // Altura del espacio para el cajón de categorías?>

<div style="width:400px; float: left; height: 260px" class="category" id="all_category_<?php echo $c->getId()?>">
   <?php /*if(count($node[CategoryPeer::TREE_ARRAY_CHILDREN])): $children = $node[CategoryPeer::TREE_ARRAY_CHILDREN] */?>
   <?php if(count($children)):?>
     <ul class="category_tree" >
       <?php include_partial('list_categories_ajax', array('mm_id' => $mm->getId(), 
                                                      'parent'=> 'root', 
                                                      'block_cat' => $c->getId(),
                                                      'nodes' => $children)) ?>
     </ul>
   <?php endif?>
</div>

<div style="float: left; padding: 220px 5px 0px">
 <a href="#" onclick="if ( $$('.clicked_category_left')[0] != undefined ) { $$('.clicked_category_left')[0].ondblclick() } return false;">&#8592;</a>
 <a href="#" onclick="if ( $$('.clicked_category_right')[0] != undefined ) { $$('.clicked_category_right')[0].ondblclick() } return false;">&#8594;</a>
</div>

<div style="width:400px; height:260px; border: 1px solid #bbb; float: left;" class="category" id="select_category_<?php echo $c->getId()?>">
    <ul class="category_tree" id="select_ul_category_<?php echo $c->getId()?>" >
       <?php foreach($mm->getCategorys($c) as $mmc):?>
       <li class="element" id="select_li_<?php echo $mmc->getId() ?>" >
          <span class="icon">&nbsp;</span>
          <span onclick="$$('.clicked_category_left').invoke('removeClassName', 'clicked_category_left'); this.addClassName('clicked_category_left');" ondblclick="javascript:del_tree_cat(<?php echo $mmc->getId()?>, <?php echo $mm->getId() ?>);" >
          <?php echo $mmc->getCod() ?> - <?php echo $mmc->getName() ?> 
          </span>
       </li>
       <?php endforeach?>
    </ul>
</div>

</div>
     </div>
   </dd>
   </div>
   <?php endforeach?>


</dl>
</fieldset>
</div>

<?php echo javascript_tag('function toggle_tree_cat(element, id, mm_id, cat_id) {
  if (element.parentElement.hasClassName("notload")) {
    element.parentElement.removeClassName("notload");

  new Ajax.Updater("cat_ul_children_" + id, "' . url_for('mms/getchildren') . '/id/"  + id + "/block_cat/" + cat_id + "/mm/" + mm_id, {
      onComplete: function(){ $("all_category_" + cat_id).scrollTop = ((element.positionedOffset()[1]) - 750); }
    });}
else {
    $$(".cat_li_parent_" + id).each(function(e){e.toggleClassName("nodisplay")});
    //element.scrollIntoView();
    $("all_category_" + cat_id).scrollTop = ((element.positionedOffset()[1]) - 750);
  }
  element.parentElement.toggleClassName("expanded").toggleClassName("collapsed");
}

function toggle_show_all()
{
  // SHOW - Quito el punto a los nodos que muestran sus hijos al desocultar
  $$(".expanded.element, .collapsed.element").each(function(e){
    e.removeClassName("element");
  });

  // SHOW & HIDE - Oculto/Muestro elementos finales que no tiene objetos multimedia
  $$(".nomm.element").each(function(e){
    e.toggleClassName("nodisplayall");
  });

  // SHOW & HIDE - Oculto/Muestro elementos todos sus hijos son finales sin objetos multimedia
  $$(".nomm.expanded, .nomm.collapsed").each(function(e){
    if (e.getElementsBySelector("li.nomm").length == e.getElementsBySelector("li").length) {
      e.toggleClassName("nodisplayall");
    }
  });

  // HIDE - Pongo el punto a los nodos que se quedan sin hijos al ocultar
  $$(".nomm").each(function(e){
    p = e.parentElement.parentElement;
    if (p.getElementsBySelector("li.nodisplayall").length == p.getElementsBySelector("li").length) {
      p.addClassName("element");
    }
  });

}

function create_li_in_select(cat, block_cat_id, mm_id) {
  var $ul = $("select_ul_category_" + block_cat_id);
  var li = new Element("li", {"id": "select_li_" + cat.id, "class": "element"});
  var span1 = new Element("span", {"class": "icon"}).update("&nbsp;");
  var span2 = new Element("span", {"onclick":"$$(\'.clicked_category_left\').invoke(\'removeClassName\', \'clicked_category_left\'); this.addClassName(\'clicked_category_left\');", "ondblclick": "del_tree_cat(" + cat.id +", "+ mm_id + ")"}).update(cat.cod+ " - " + cat.name);
  li.insert(span1).insert(span2);
  //Add quit logica.
  $ul.insert(li);
}

function add_tree_cat(cat_id, mm_id, block_cat_id) {
  new Ajax.Request("' . url_for("mms/addCategory") . '/id/" + mm_id,  {
    method: "post",
    parameters: "category=" + cat_id,
    asynchronous: true, 
    evalScripts: true,
    onSuccess: function(response){
        for (var i=0; i<response.responseJSON.added.length; i++) {
            var c = response.responseJSON.added[i];
            inc_num_mm(c.id, 1);
            if (c.group.length!=0 && c.group[1]!=undefined) {
               create_li_in_select(c, c.group[1], mm_id);  
            } 
        }
    }
  });  
}


function del_tree_cat(cat_id, mm_id) {
  // TODO Si ya lo tiene no hacer nada.
  console.log("del_tree_cat info_num_mm_" + cat_id);

  new Ajax.Request("' . url_for("mms/delCategory") . '/id/" + mm_id,  {
    method: "post",
    parameters: "category=" + cat_id,
    asynchronous: true, 
    evalScripts: true,
    onSuccess: function(response){
        for (var i=0; i<response.responseJSON.deleted.length; i++) {
            var c = response.responseJSON.deleted[i];
            var $_element = $("select_li_" + c.id); 
            if ($_element)  $_element.remove(); 
            inc_num_mm(c.id, -1);
        }
    }
  });  
}


function inc_num_mm(cat_id, num)
{
  var aux = $("info_num_mm_" + cat_id);
  if (aux){
    var nn = (parseInt(aux.innerHTML) + num);
    var p = aux.parentElement.parentElement;
    if (nn == 0){
      p.addClassName("nomm");
    } else {
      p.removeClassName("nomm");
    }
    aux.innerHTML = nn;
  }
}

') ?>
