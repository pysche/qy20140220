<?php Bc_Output::prepareHtml();?>
<script type='text/javascript'>
function settrans () {
  var trans_id = $('#trans_id').val();

  $.bcAjax({
    'url': '<?php echo $this->url(array(
      'module' => $this->MODULE,
      'controller' => $this->cName,
      'action' => 'dosettrans'
      ), null, true);?>',
    'type': 'post',
    'data': {
      'choosed': $('#hidden').val(),
      'trans_id': trans_id
    },
    'history': 'false',
    'success': function () {
      try {
        $('button[data-dismiss="modal"]').trigger('click');
        $('div.tmp-modal, div.modal-backdrop').replaceWith('');
      } catch (e) {}

      $.bcAjax({
        'url': LAST_HASH,
        'history': 'false'
      });
    }
  });
};
</script>
<div class="modal fade tmp-modal" data-role='modal'>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4>批量设定默认配送商</h4>
      </div>
      <div class="modal-body" id='mwelcome_body'>
         <?php
          $keys = array_keys($this->orgs);

          echo $this->formSelect('trans_id', '', array(
            'class' => 'form-control'
            ), Bc_Funcs::array_merge(array('' => '* 请选择 *'), $this->orgs[$keys[1]]));
        ?>
      </div>
      <div class="modal-footer">
        <input type='hidden' id='hidden' value='<?php echo implode(',', $_POST['choosed']);?>' />
        <button id='settrans_save' type="button" class="btn btn-danger" onclick="settrans()">保存</button>
        <button type="button" class="btn btn-success" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>
<?php Bc_Output::doOutput();?>