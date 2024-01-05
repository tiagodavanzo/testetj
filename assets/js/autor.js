$(document).ready(function() {

	$('#authors').DataTable({
		
		processing: true,
		responsive: true,
		ajax: {
			'url': 'source/datatable/authors.php',
			'type': 'POST',
			'data': function ( d ) {
				d.action = 'getall';
			}
		},
		order: [[ 1, "asc" ]],
		scrollX: true,
		scrollY: '350px',
		paging: false,
		autoWidth: false,
		lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, 'Todos']],
		language: { url: 'assets/vendors/DataTables/DataTables-1.10.16/js/Portuguese-Brasil.json', 'decimal': ',', 'thousands': '.'},
		columns: [
			{ data: "ID"},
			{ data: "NOME"},
			{ data: "UPDATE"},
			{ data: "DELETE"}
		],
		columnDefs: [
			{ className: "text-center", targets: [0,2,3] },
			{ orderable: false, targets: [2,3]}
		],
		dom: 
        "<'row'<'col-sm-12 col-md-6'f><'col-sm-12 col-md-6'l>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
	});

});

var validator = $("#frmAuthor").validate({
	rules: {
		txtName: {
			required: true
		}
	},
	messages: {
        txtName: {
            required: "Informe o nome do autor."
        }
    },
	errorClass: "help-block error"/*,
	highlight: function(e) {
		$(e).closest(".form-group.row").addClass("has-error")
	},
	unhighlight: function(e) {
		$(e).closest(".form-group.row").removeClass("has-error")
	}*/
});

function Get(id)
{
	LoadTab(1, 'Atualizar')
	Loading()
	$.post('source/datatable/authors.php', { 'action': 'get', 'id': id },
		function(data){

			data = jQuery.parseJSON(data);

			$('#hdId').val(data.id)
			$('#info').html(`Id: ${data.id}<br />`)
			$('#txtName').val(data.name)

			$(".loading").html('')
		}
	);
}

function Author()
{
	if($("#frmAuthor").valid()){
		Loading()

		let action = ''
		if($('#btnOK').text() == 'Cadastrar') action = 'create'
		else if($('#btnOK').text() == 'Atualizar') action = 'update'

		let id = $('#hdId').val()
		let name = $('#txtName').val()

		$.post('source/datatable/authors.php', { 'action': action, 'id': id, 'name': name },
			function(data){
				
				data = jQuery.parseJSON(data);

				alert(data.msg);

				LoadTab(0, 'Cadastrar')
				$('#authors').DataTable().ajax.reload();
			}
		);
	}
}

function Delete(id)
{
	if(confirm('Tem certeza que deseja excluir este autor?'))
	{
		$.post('source/datatable/authors.php', { 'action': 'delete', 'id': id },
			function(data){
				
				data = jQuery.parseJSON(data);

				alert(data.msg);

				$('#authors').DataTable().ajax.reload();
			}
		);
	}
}

function Loading()
{
	$(".loading").html('<div class="col-xs-1" align="center"><img id="loading" src="assets/img/load.gif"> Processando</div>');
}

function ShowAll(idDataTable)
{
	$(idDataTable).DataTable().ajax.reload();	
}

function clickTab(idDataTable)
{
	setTimeout(function() {adjustColumn(idDataTable)}, 0);
}

function adjustColumn(idDataTable)
{
	$(idDataTable).DataTable().draw();
}

function LoadTab(aba, acao)
{
	$(`#tabs li:eq(${aba}) a`).tab('show')
	$(".loading").html('')
	$('#hdId,#txtName').val('')
	$('#info').html('')
	$('#btnOK').text(acao)
	validator.resetForm()
}