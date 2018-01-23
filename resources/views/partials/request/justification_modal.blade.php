<div class="modal fade" id="justification-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirmar alteração</h4>
      </div>
      <form class="form-horizontal" method="POST" action="">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="from" value="show">
        <input type="hidden" name="filter" value="">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="justification">Justificativa:</label>
          <textarea class="form-control"
                    rows="5"
                    name="justification"
                    placeholder="Uma justificativa opcional..."></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
