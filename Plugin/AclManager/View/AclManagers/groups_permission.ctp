<?php echo $this->element('AclManager.pluginsLoad'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        });

        <?php
        echo $this->element('AclManager.scriptSyncAco');
        ?>

        var tableAros = $('#tbl_aros').DataTable({

            "sAjaxSource": "<?php echo Router::url(array('controller' => 'AclManagers', 'action' => 'ajaxListGroupsAcos')) ?>",
            "order": [[ 0, "asc" ]],
            "bPaginate": false,
            "columns": [

                { "data": "AclAco.id",'class':'td_id' },
                { "data": "AclAco.path",'class':'td_name' },
                {
                    "class":          "td_options",
                    "orderable":      false,
                    'sortable':false,
                     "searchable":     false,
                    "data":           null,
                    "defaultContent": ""
                },
                {
                    "class":          "td_inputs",
                    "orderable":      false,
                    'sortable':false,
                     "searchable":     false,
                    "data":           null,
                    render: function ( data, type, row ) {
                        if ( type === 'display' ) {

                            return '<input type="checkbox" name="data[AclAcosAro][acoID][]" class="selectedAcos" value="'+data.AclAco.id+'">';
                        }
                        return data;
                    },
                    className: "dt-body-center"
                }


            ],
                 "fnServerParams": function ( aoData ) {
                    aoData.push( { "name": "admingroup_id", "value": '<?php echo $groupID; ?>' } );
                },

                "fnCreatedRow": function(nRow, aData, iDataIndex){
                    var typeButtonAll = aData.Aco.create;
                    var typeButtonAllIcon = aData.Aco.create;
                    var typeButtonAllMsg = aData.Aco.create;
                    <?php
                    if ($authMode['CRUD']) {
                    ?>
                        if(aData.Aco.create == 1 && aData.Aco.read == 1 && aData.Aco.update == 1 && aData.Aco.delete == 1){
                            typeButtonAll = 1;
                            typeButtonAllIcon = 1;
                            typeButtonAllMsg = 1;
                        }else{
                            typeButtonAll = -1;
                            typeButtonAllIcon = -1;
                            typeButtonAllMsg = -1;
                        }
                    <?php
                    }
                    ?>
                    var buttonAll = $('<button type="button" class="btn btn-'+buttonType(typeButtonAll)+' btn-circle btn-xs"  role="button" data-toggle="tooltip" data-placement="top" title="'+messageType(typeButtonAllMsg)+'"><span class="'+iconType(typeButtonAllIcon)+'" aria-hidden="true"></span></button>').tooltip();

                        buttonAll.on('click',function(e){
                            e.preventDefault;
                            setPermission(aData.AclAco.id,'T');

                            return false;
                        });
                     $('td.td_options', nRow).append(buttonAll);

                    <?php
                    if ($authMode['CRUD']) {
                    ?>

                     $('td.td_options', nRow).append(' ');

                    var buttonCreate = $('<button class="btn btn-'+buttonType(aData.Aco.create)+' btn-xs btn-crud" href="<?php echo  Router::url(array('controller' => 'AclManagers', 'action' => 'ajaxSetPermission')); ?>/c/'+aData.Aco.id+'" role="button" data-toggle="tooltip" data-placement="top" title="<?php echo __('Add Records'); ?>"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>').tooltip();

                        buttonCreate.on('click',function(e){
                            e.preventDefault;
                            setPermission(aData.Aco.id,'C');

                            return false;
                        });
                     $('td.td_options', nRow).append(buttonCreate);
                     $('td.td_options', nRow).append(' ');

                     var buttonRead = $('<button class="btn btn-'+buttonType(aData.Aco.read)+' btn-xs btn-crud" href="<?php echo  Router::url(array('controller' => 'AclManagers', 'action' => 'ajaxSetPermission')); ?>/r/'+aData.Aco.id+'" role="button" data-toggle="tooltip" data-placement="top" title="<?php echo __('Read Records'); ?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button>').tooltip();

                        buttonRead.on('click',function(e){
                            e.preventDefault;
                            setPermission(aData.Aco.id,'R');

                            return false;
                        });
                      $('td.td_options', nRow).append(buttonRead);
                      $('td.td_options', nRow).append(' ');

                      var buttonUpdate = $('<button class="btn btn-'+buttonType(aData.Aco.update)+' btn-xs btn-crud" href="<?php echo  Router::url(array('controller' => 'AclManagers', 'action' => 'ajaxSetPermission')); ?>/u/'+aData.Aco.id+'" role="button" data-toggle="tooltip" data-placement="top" title="<?php echo __('Update Records'); ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>').tooltip();
                        buttonUpdate.on('click',function(e){
                            e.preventDefault;
                            setPermission(aData.Aco.id,'U');

                            return false;
                        });
                     $('td.td_options', nRow).append(buttonUpdate);
                     $('td.td_options', nRow).append(' ');

                     var buttonDelete = $('<button class="btn btn-'+buttonType(aData.Aco.delete)+' btn-xs btn-crud" href="<?php echo  Router::url(array('controller' => 'AclManagers', 'action' => 'ajaxSetPermission')); ?>/d/'+aData.Aco.id+'" role="button" data-toggle="tooltip" data-placement="top" title="<?php echo __('Delete Records'); ?>"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></button>').tooltip();
                        buttonDelete.on('click',function(e){
                            e.preventDefault;
                            setPermission(aData.Aco.id,'D');

                            return false;
                        });
                     $('td.td_options', nRow).append(buttonDelete);
                     $('td.td_options', nRow).append(' ');
                    <?php
                    }
                    ?>
                },


        });

        $("#markAll").click(function() {
            $("input.selectedAcos[type='checkbox']").each(function() {
                this.checked = $('#markAll').prop('checked');
            });
        });

        $('#btnAllowAll').on('click',function(){
            $('#permissionType').val('A');
            showProcessingPermissionMessage();
            setAllPermissions();
        });

        $('#btnDenyAll').on('click',function(){
            $('#permissionType').val('D');
            showProcessingPermissionMessage();
            setAllPermissions();
        });




        function buttonType(valor){
            var tipo = '';

            switch(parseInt(valor)){
                case 0:
                    tipo = 'warning';
                    break;
                case 1:
                    tipo = 'success';
                    break;
                case -1:
                    tipo = 'danger';
                    break;
                default:
                    tipo = 'danger';
            }
            return tipo;
        }

        function iconType(valor){
            switch(parseInt(valor)){
                case 0:
                    tipo = 'glyphicon glyphicon-remove';
                    break;
                case 1:
                    tipo = ' glyphicon glyphicon-ok';
                    break;
                case -1:
                    tipo = ' glyphicon glyphicon-remove';
                    break;
                default:
                    tipo = 'glyphicon glyphicon glyphicon-remove';
            }
            return tipo;
        }


        function messageType(valor){
            switch(parseInt(valor)){
                case 0:
                    tipo = '<?php echo __('Undefined (denied) still'); ?>';
                    break;
                case 1:
                    tipo = ' <?php echo __('Allowed'); ?>';
                    break;
                case -1:
                    tipo = ' <?php echo __('Denied'); ?>';
                    break;
                default:
                    tipo = '<?php echo __('Denied'); ?>';
            }
            return tipo;
        }

        <?php
        echo $this->element('AclManager.scriptSetPermission');
        ?>
    });

</script>
<?php echo $this->element("admins/sidebar"); ?>	
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
				

				<div class="panel panel-default">
					<header class='panel-heading'><?php echo __('Management Permissions').' - '.__('Groups'); ?></header>
					<div class="panel-body">
							<?php
								echo $this->Html->link(
									'<span class="glyphicon glyphicon-menu-left"></span> '.__('Back'),
									array(
										'controller' => 'AclManagers',
										'action' => 'index',
									),
									array(
										'class'=>'btn btn-default',
										'escape'=>false
										)
								).' ';
								echo $this->Form->button('Sync Acos <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> ', array(
										'type' => 'button',
										'class'=>'btn btn-success',
										'escape' => false,
										'id'=>'sync_acos',
								));
								echo ' ';
								$this->AuthMode->getMode();

							echo $this->Form->create('AclAcosAro', array('id'=>'formAclArosAco','class'=>'form-horizontal'));
							?>
							<div class='row'>
								<div class='col-sm-4'>
									<div id='userInformation'>
									<?php
									echo $this->Form->input('name', array(
										'type'=>'text',
										'label'=>__('Group:'),
										'value'=>$groupName,
										'disabled'=>true,
										'class'=>'form-control',
										'before'=>'<div class="form-horizontal"><div class="form-group">',
										'after'=>'</div></div>',
										));
									?>
									</div>
								</div>
							</div>
						<?php

						echo $this->Form->input('aroID', array(
							'type'=>'hidden',
							'value'=>$aroID,
							));

						echo $this->Form->input('permissionType', array(
							'type'=>'hidden',
							'value'=>'',
							'id'=>'permissionType',
							));

							$actionSize = '3%';
						if ($authMode['CRUD']) {
							$actionSize = '14%';
						}
						?>
						</p>
							<table id="tbl_aros" class="table table-responsive table-hover table-bordered  display responsive" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th width='10%' class="all"><?php echo __('id'); ?></th>
										<th class="all"><?php echo __('Access Path'); ?></th>
										<th class="all" width="<?php echo $actionSize; ?>"><span class='glyphicon glyphicon-cog'></span></th>
										<th width="10%">

										<?php
											echo $this->Form->checkbox('markAll', array('hiddenField' => false,'id'=>'markAll')).' ';
											echo $this->Form->button('<span class="glyphicon glyphicon-ok"></span>', array(
												'class'=>'btn btn-success  btn-xs btn-crud',
												'role'=>'button',
												'data-toggle'=>'tooltip',
												'data-placement'=>'top',
												'title'=>__('Allow All'),
												'aria-hidden'=>true,
												'id'=>'btnAllowAll',
												'type'=>'button',
											)).' ';

											echo $this->Form->button('<span class="glyphicon glyphicon-remove"></span>', array(
												'class'=>'btn btn-danger  btn-xs btn-crud',
												'role'=>'button',
												'data-toggle'=>'tooltip',
												'data-placement'=>'top',
												'title'=>__('Deny All'),
												'aria-hidden'=>true,
												'id'=>'btnDenyAll',
												'type'=>'button',
											));
										?>
										</th>
									</tr>
								</thead>
								<!--tfoot section is optional-->
								<tfoot>
								</tfoot>
								<!--tbody section is required-->
								<tbody></tbody>
							</table>
						<?php echo $this->Form->end(); ?>

					</div>
				</div>
			</div><!--/col-lg-12-->
		</div>
	</section>
</section>