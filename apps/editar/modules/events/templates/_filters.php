<!-- Filter -->
<div class="tv_admin_filters">
<?php echo form_remote_tag(array('update' => 'list_events', 'url' => 'events/list', 'script' => 'true' ), 'id=filter_events') ?>
  <fieldset>
    <h2><?php echo __('Buscar')?></h2>

    <div class="form-row">
      <label for="name"><?php echo __('Name:')?></label>
      <div class="content">
        <?php echo input_tag('filters[name]', null) ?>
      </div>
    </div>


    <div class="form-row">
      <label for="date"><?php echo __('Fecha:') ?></label>
      <div class="content">
        <?php echo input_date_range_tag('filters[date]',  null, array ('rich' => true, 'calendar_button_img' => '/images/admin/buttons/date.png', 'before'=>__('Desde:'), 'middle'=>__(' <br />Hasta: ') )) ?>
      </div>
    </div>

  </fieldset>

  <ul class="tv_admin_actions">
    <li>
      <?php echo button_to_remote(__('reset'), array('before' => '$("filter_events").reset();', 'update' => 'list_events', 'url' => 'events/list?filter=filter ', 'script' => 'true'), 'class=tv_admin_action_reset_filter') ?>
    </li>
    <li>
      <?php echo submit_tag(__('filtrar'), 'name=filter class=tv_admin_action_filter') ?>
    </li>
  </ul>
</form>
</div>
