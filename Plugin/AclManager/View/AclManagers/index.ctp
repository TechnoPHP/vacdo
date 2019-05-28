<?php echo $this->element('AclManager.pluginsLoad'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        <?php
        echo $this->element('AclManager.scriptSyncAco');
        ?>

        <!-- ------------------------------------- -->

            $('#tbl_groups').dataTable({

                "sAjaxSource": "<?php echo Router::url(array('controller' => 'AclManagers', 'action' => 'ajaxListGroups')) ?>",
                "columns": [

                    { "data": "Admingroup.id",'class':'td_id' },
                    { "data": "Admingroup.name",'class':'td_name' },
                    {
                        "class":          "td_options",
                        "orderable":      false,
                        'sortable':false,
                         "searchable":     false,
                        "data":           null,
                        "defaultContent": ""
                    },

                ],


                    "fnCreatedRow": function(nRow, aData, iDataIndex){

                        var buttonPermission = $('<a class="btn btn-primary btn-xs" href="<?php echo Router::url(array('controller' => 'AclManagers', 'action' => 'groupsPermission')); ?>/'+aData.Admingroup.id+'" role="button"><?php echo __('Permissions'); ?></a>');
                         $('td.td_options', nRow).append(buttonPermission);

                         if(aData.Admingroup.permissions > 0 ){
                            var badge = $('<span class="badge" data-toggle="tooltip" data-placement="top" title="<?php echo __('This group has members with specific permissions!'); ?>">'+aData.Admingroup.permissions+'</span>').tooltip().on('click',function(){

                                $('#dFilter').val(aData.Admingroup.name).trigger("change");
                                $('#usersGroupsTab a[href="#users"]').tab('show');

                            }).css( 'cursor', 'pointer' );
                            $('td.td_name', nRow).append(badge);
                         }


                    },
            });

            $('#tbl_users').dataTable({

                "sAjaxSource": "<?php echo Router::url(array('controller' => 'AclManagers', 'action' => 'ajaxListUsers')) ?>",
                "columns": [

                    { "data": "Admin.id",'class':'td_id' },
                    { "data": "Admin.email_address",'class':'td_name' },
                    { "data": "Admingroup.name",'class':'td_group' },
                    {
                        "class":          "td_options",
                        "orderable":      false,
                        'sortable':false,
                         "searchable":     false,
                        "data":           null,
                        "defaultContent": ""
                    },

                ],


                    "fnCreatedRow": function(nRow, aData, iDataIndex){

                        var buttonPermission = $('<a class="btn btn-primary btn-xs" href="<?php echo Router::url(array('controller' => 'AclManagers', 'action' => 'usersPermission')); ?>/'+aData.Admin.id+'" role="button"><?php echo __('Permissions'); ?></a>');
                         $('td.td_options', nRow).append(buttonPermission);


                         if(aData.Admin.permissions > 0 ){
                            var badge = $('<span class="badge" data-toggle="tooltip" data-placement="top" title="<?php echo __('This User has specific permissions!'); ?>">'+aData.Admin.permissions+'</span>').tooltip();
                            $('td.td_name', nRow).append(badge);
                         }



                    },
                    "initComplete": function () {
                                var api = this.api();

                                var column = api.column( 2 );
                                var select = $('<label><?php echo __('Group'); ?>:</label> <select id="dFilter" class="form-control input-sm"><option value=""></option></select>')
                                    .appendTo( $('#custom-filter') )
                                    .on( 'change', function () {
                                        var val = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()
                                        );

                                        column
                                            .search( val ? '^'+val+'$' : '', true, false )
                                            .draw();
                                    } );

                                column.data().unique().sort().each( function ( d, j ) {
                                    $(select).closest('select').append( '<option value="'+d+'">'+d+'</option>' )

                                } );

                            }
            });
    });

</script>
<?php echo $this->element("admins/sidebar"); ?>
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<header class='panel-heading'><?php echo __('Management Permissions') ?></header>
					<div class="panel-body">
						<?php
							echo $this->Form->button('Sync Acos <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>', array(
									'type' => 'button',
									'class'=>'btn btn-success',
									'escape' => false,
									'id'=>'sync_acos',
							));
						?>
						<?php $this->AuthMode->getMode(); ?>
						<div id='usersGroupsTab' style='padding-top:20px;' role="tabpanel">

							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#groups" aria-controls="groups" role="tab" data-toggle="tab"><?php echo __('Groups'); ?></a></li>
							<li role="presentation"><a href="#users" aria-controls="users" role="tab" data-toggle="tab"><?php echo __('Users'); ?></a></li>
							</ul>

							<!-- Tab panes -->
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="groups">
								<!-- ------------------------------------------------ -->
									<div class='div-data-tables'>

										<table id="tbl_groups" class="table table-responsive table-hover table-bordered  display responsive" cellspacing="0" width="100%">
											<thead>
												<tr>
													<th width='10%' class="all"><?php echo __('id'); ?></th>
													<th class="all"><?php echo __('Name'); ?></th>
													<th class="all" width="5%"><?php echo __('Options') ?></th>
												</tr>
											</thead>
											<!--tfoot section is optional-->
											<tfoot>
											</tfoot>
											<!--tbody section is required-->
											<tbody></tbody>
										</table>
									</div>
								<!-- fim tab groups -->
								</div>
								<div role="tabpanel" class="tab-pane" id="users">
								<!-- ------------------------------------------------ -->
									<div class='div-data-tables'>
										<div class='row'>
											<div class='col-sm-4'></div>
											<div class='col-sm-4'></div>
											<div class='col-sm-4'><div id='custom-filter'></div></div>
										</div>
										<table id="tbl_users" class="table table-responsive table-hover table-bordered  display responsive" cellspacing="0" width="100%">
											<thead>
												<tr>
													<th width='10%' class="all"><?php echo __('id'); ?></th>
													<th class="all"><?php echo __('User'); ?></th>
													<th class="all"><?php echo __('Group'); ?></th>
													<th class="all" width="5%"><span><?php echo __('Options'); ?></span></th>
												</tr>
											</thead>
											<!--tfoot section is optional-->
											<tfoot>
											</tfoot>
											<!--tbody section is required-->
											<tbody></tbody>
										</table>
									</div>
								<!-- fim tab groups -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div><!--/col-lg-12-->
		</div>
	</section>
</section>