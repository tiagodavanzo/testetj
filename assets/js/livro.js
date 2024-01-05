$(document).ready(function() {

	$('#books').DataTable({
		
		processing: true,
		responsive: true,
		ajax: {
			'url': 'source/datatable/books.php',
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
			{ data: "TITLE"},
			{ data: "PUBLISHER"},
			{ data: "EDITION"},
			{ data: "YEAR"},
			{ data: "PRICE"},
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

var validator = $("#frmBook").validate({
	rules: {
		txtTitle: {
			required: true
		},
		txtPublisher: {
			required: true
		},
		txtEdition: {
			required: true
		},
		txtYear: {
			required: true
		},
		txtPrice: {
			required: true
		}
	},
	messages: {
        txtTitle: {
            required: "Informe o título."
        },
		txtPublisher: {
            required: "Informe a editora."
        },
		txtEdition: {
            required: "Informe a edição."
        },
		txtYear: {
            required: "Informe o ano de publicação."
        },
		txtPrice: {
            required: "Informe o preço."
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
	$.post('source/datatable/books.php', { 'action': 'get', 'id': id },
		function(data){

			data = jQuery.parseJSON(data);

			$('#hdId').val(data.id)
			$('#info').html(`Id: ${data.id}<br />`)
			$('#txtTitle').val(data.title)
			$('#txtPublisher').val(data.publisher)
			$('#txtEdition').val(data.edition)
			$('#txtYear').val(data.year)
			$('#txtPrice').val(data.price)

			$(".loading").html('')
		}
	);
}

function Book()
{
	if($("#frmBook").valid()){
		Loading()

		let action = ''
		if($('#btnOK').text() == 'Cadastrar') action = 'create'
		else if($('#btnOK').text() == 'Atualizar') action = 'update'

		let id = $('#hdId').val()
		let title = $('#txtTitle').val()
		let publisher = $('#txtPublisher').val()
		let edition = $('#txtEdition').val()
		let year = $('#txtYear').val()
		let price = $('#txtPrice').val()

		$.post('source/datatable/books.php', { 'action': action, 'id': id, 'title': title, 'publisher': publisher, 'edition': edition, 'year': year, 'price': price },
			function(data){
				
				data = jQuery.parseJSON(data);

				alert(data.msg);

				LoadTab(0, 'Cadastrar')
				$('#books').DataTable().ajax.reload();
			}
		);
	}
}

function Delete(id)
{
	if(confirm('Tem certeza que deseja excluir este livro?'))
	{
		$.post('source/datatable/books.php', { 'action': 'delete', 'id': id },
			function(data){
				
				data = jQuery.parseJSON(data);

				alert(data.msg);

				$('#books').DataTable().ajax.reload();
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
	$('#hdId,#txtTitle,#txtPublisher,#txtEdition,#txtYear,#txtPrice').val('')
	$('#info').html('')
	$('#btnOK').text(acao)
	validator.resetForm()
}