/**
DELETE FORM
**/
function deleteModal(url, id, title, token) {
    var modal = '<div id="modal_delete' + id + '">';
        modal +=  '<div class="modal modal_area fade" id="delete_form' + id + '" tabindex="-1" role="dialog" aria-labelledby="delete_' + title + '">';
        modal +=    '<div class="modal-dialog" role="document">';
        modal +=         '<div class="modal-content">';
        modal +=           '<div class="modal-header">';
        modal +=              '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
        modal +=                '<span aria-hidden="true">&times;</span>';
        modal +=              '</button>';
        modal +=              '<h4 class="modal-title" id="delete_' + title + '">Delete Data</h4>';
        modal +=           '</div>';
        modal +=           '<div class="modal-body">';
        modal +=             'Are you sure want to delete <b>' + title + '</b> ?';
        modal +=           '</div>';
        modal +=           '<div class="modal-footer">';
        modal +=            '<form method="POST" action="' + url + '" role="form" accept-charset="utf-8">';
        modal +=              '<input type="hidden" name="_method" value="DELETE">';
        modal +=              '<input type="hidden" name="_token" value="' + token + '">';
        modal +=              '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
        modal +=              '<button type="submit" class="btn btn-danger pull-right">Delete</button>';
        modal +=            '<form>';
        modal +=          '</div>';
        modal +=        '</div>';
        modal +=      '</div>';
        modal +=    '</div>';
        modal +=  '</div>';
  
    var check_data = $('#modal_delete' + id).length;
    if(check_data == 0){
      $('#area_modal' + id).append(modal);
    }
  }
  