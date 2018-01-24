<link rel="stylesheet" href="{{ asset('css/style-justification-modal.css')}}">
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
        <div class="container">
          <div class="row">
            <div class="col-md-12">
                <label for="justification" class="justification">Justificativa:</label>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <textarea class="form-control"
                rows="5"
                name="justification"
                placeholder="Uma justificativa opcional..."></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button style="color:#fff;" type="button" class="btn btn-default" data-dismiss="modal">Fecha</button>
          <button style="color:#fff;" type="submit" class="btn btn-primary">Enviar</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
